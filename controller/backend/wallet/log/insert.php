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

        $amount = floatval($form['amount']);

        if (!$amount) {
            return ['error' => 'error.invalid-wallet-log-amount'];
        }

        $wallet['balance'] += $amount;

        $wallet = model('Wallet')->update($wallet);

        if ($wallet) {
            $form['the_date'] = date(cfg('system.date'));
            $form['type'] = 1;
            $form['balance'] = $wallet['balance'];

            return parent::process($form);
        }

        return ['error' => 'error.insert-failed'];
    }

};
