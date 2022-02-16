<?php //>

return new class('Currency') extends matrix\web\backend\ListController {

    protected function init() {
        $this->columns([
            'title',
            'code',
            'symbol',
            'icon',
            'precision',
        ]);
    }

};
