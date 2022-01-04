<?php //>

return new class('WalletLog') extends matrix\web\backend\BlankController {

    protected function init() {
        $this->columns([
            'amount',
            'remark',
        ]);
    }

};
