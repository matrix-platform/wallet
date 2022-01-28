<?php //>

return new class('WalletLog') extends matrix\web\backend\ListController {

    protected function init() {
        $this->defaultPage(PHP_INT_MAX);
    }

};
