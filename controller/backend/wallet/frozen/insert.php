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

        $amount = floatval($form['amount']);

        if (!$amount || $amount > $wallet['balance'] || -$amount > $wallet['frozen']) {
            return ['error' => 'error.invalid-frozen-log-amount'];
        }

        $wallet['frozen'] += $amount;
        $wallet['balance'] -= $amount;

        $wallet = model('Wallet')->update($wallet);

        if ($wallet) {
            $log = model('WalletLog')->insert([
                'wallet_id' => $wallet['id'],
                'the_date' => date(cfg('system.date')),
                'type' => 2,
                'amount' => -$amount,
                'balance' => $wallet['balance'],
                'remark' => @$form['remark'],
            ]);

            $form['the_date'] = $log['the_date'];
            $form['type'] = 2;

            return parent::process($form);
        }

        return ['error' => 'error.insert-failed'];
    }

};
