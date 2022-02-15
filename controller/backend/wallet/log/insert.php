<?php //>

return new class('WalletLog') extends matrix\web\backend\InsertController {

    protected function init() {
        $table = $this->table();

        $table->the_date->required(false);
        $table->type->required(false);
        $table->balance->required(false);
    }

    protected function process($form) {
        $wallet = model('Wallet')->get(@$form['wallet_id']);

        if (!$wallet) {
            return ['error' => 'error.data-not-found'];
        }

        $precision = model('Currency')->get($wallet['currency_id'])['precision'];

        if (!preg_match("/^-?\d+(\.\d{1,{$precision}}0*)?$/", $form['amount'])) {
            return ['error' => 'error.invalid-wallet-log-amount'];
        }

        $amount = floatval($form['amount']);

        if (!$amount) {
            return ['error' => 'error.invalid-wallet-log-amount'];
        }

        $wallet['balance'] = round($wallet['balance'] + $amount, $precision);

        if ($wallet['balance'] < $wallet['frozen']) {
            return ['error' => 'error.invalid-wallet-log-amount'];
        }

        $wallet = model('Wallet')->update($wallet);

        if (!$wallet) {
            return ['error' => 'error.insert-failed'];
        }

        return parent::process([
            'wallet_id' => $wallet['id'],
            'the_date' => date(cfg('system.date')),
            'type' => 1,
            'amount' => $amount,
            'balance' => $wallet['balance'],
            'remark' => @$form['remark'],
        ]);
    }

};
