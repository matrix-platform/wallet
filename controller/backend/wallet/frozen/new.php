<?php //>

return new class('FrozenLog') extends matrix\web\backend\BlankController {

    protected function init() {
        $this->columns([
            'amount',
            'remark',
        ]);
    }

};
