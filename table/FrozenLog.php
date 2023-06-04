<?php //>

use matrix\db\column\CreateTime;
use matrix\db\column\Date;
use matrix\db\column\Double;
use matrix\db\column\Integer;
use matrix\db\column\Text;
use matrix\db\column\Textarea;
use matrix\db\Table;

$tbl = new Table('base_frozen_log');

$tbl->add('wallet_id', Integer::class)
    ->associate('wallet', 'Wallet', true)
    ->readonly(true)
    ->required(true);

$tbl->add('the_date', Date::class)
    ->readonly(true)
    ->required(true);

$tbl->add('type', Integer::class)
    ->formStyle('select')
    ->options(load_options('wallet-log-type'))
    ->readonly(true)
    ->required(true);

$tbl->add('amount', Double::class)
    ->readonly(true)
    ->required(true);

$tbl->add('target_id', Integer::class)
    ->readonly(true);

$tbl->add('remark', Textarea::class)
    ->readonly(true);

$tbl->add('snapshot', Text::class)
    ->invisible(true)
    ->readonly(true);

$tbl->add('create_time', CreateTime::class)
    ->required(true);

return $tbl;
