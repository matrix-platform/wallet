<?php //>

return new class('FrozenLog') extends matrix\web\backend\InsertController {

    protected function init() {
        $table = $this->table();

        $table->the_date->required(false);
        $table->type->required(false);
    }

    protected function process($form) {
        $wallet = model('Wallet')->get(@$form['wallet_id']);

        if (!$wallet) {
            return ['error' => 'error.data-not-found'];
        }

        $precision = model('Currency')->get($wallet['currency_id'])['precision'];

        if (!preg_match("/^-?\d+(\.\d{1,{$precision}}0*)?$/", $form['amount'])) {
            return ['error' => 'error.invalid-frozen-log-amount'];
        }

        $amount = floatval($form['amount']);

        if (!$amount || $amount > $wallet['balance'] || -$amount > $wallet['frozen']) {
            return ['error' => 'error.invalid-frozen-log-amount'];
        }

        $wallet['frozen'] = round($wallet['frozen'] + $amount, $precision);
        $wallet['balance'] = round($wallet['balance'] - $amount, $precision);

        $wallet = model('Wallet')->update($wallet);

        if (!$wallet) {
            return ['error' => 'error.insert-failed'];
        }

        $log = model('WalletLog')->insert([
            'wallet_id' => $wallet['id'],
            'the_date' => date(cfg('system.date')),
            'type' => 2,
            'amount' => -$amount,
            'balance' => $wallet['balance'],
            'remark' => @$form['remark'],
        ]);

        if (!$log) {
            return ['error' => 'error.insert-failed'];
        }

        return parent::process([
            'wallet_id' => $wallet['id'],
            'the_date' => $log['the_date'],
            'type' => $log['type'],
            'amount' => $amount,
            'remark' => $log['remark'],
        ]);
    }

};
