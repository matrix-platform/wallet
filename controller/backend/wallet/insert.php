<?php //>

return new class('Wallet') extends matrix\web\backend\InsertController {

    protected function process($form) {
        if (model('Wallet')->count(['member_id' => $form['member_id'], 'currency_id' => $form['currency_id']])) {
            return ['error' => 'error.wallet-exists'];
        }

        return parent::process($form);
    }

};
