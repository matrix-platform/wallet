<?php //>

return new class('Wallet') extends matrix\web\backend\ListController {

    protected function init() {
        $table = $this->table();

        $table->add('username', 'member.username');
        $table->add('currency_title', 'currency.title');
        $table->add('log_count', 'log.count');
        $table->add('frozen_count', 'frozen.count');

        $this->columns([
            'username',
            'currency_title',
            'frozen',
            'balance',
            'log_count',
            'frozen_count',
        ]);
    }

};
