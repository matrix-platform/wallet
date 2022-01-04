<?php //>

use matrix\db\column\Double;
use matrix\db\column\Integer;
use matrix\db\Table;

$tbl = new Table('base_wallet');

$tbl->add('member_id', Integer::class)
    ->associate('member', 'Member')
    ->readonly(true)
    ->required(true);

$tbl->add('currency_id', Integer::class)
    ->associate('currency', 'Currency')
    ->readonly(true)
    ->required(true);

$tbl->add('frozen', Double::class)
    ->default(0)
    ->required(true);

$tbl->add('balance', Double::class)
    ->default(0)
    ->required(true);

$tbl->id->composite('log', 'WalletLog');
$tbl->id->composite('frozen', 'FrozenLog');

return $tbl;
