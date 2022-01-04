<?php //>

return new class('Wallet') extends matrix\web\backend\BlankController {

    protected function init() {
        $this->columns([
            'member_id',
            'currency_id',
        ]);
    }

};
