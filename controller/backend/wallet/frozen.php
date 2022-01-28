<?php //>

return new class('FrozenLog') extends matrix\web\backend\ListController {

    protected function init() {
        $this->defaultPage(PHP_INT_MAX);
    }

};
