<?php //>

use matrix\db\column\DisableTime;
use matrix\db\column\EnableTime;
use matrix\db\column\Image;
use matrix\db\column\Integer;
use matrix\db\column\Ranking;
use matrix\db\column\Text;
use matrix\db\Table;

$tbl = new Table('base_currency');

$tbl->add('title', Text::class)
    ->multilingual(MULTILINGUAL)
    ->required(true);

$tbl->add('code', Text::class)
    ->required(true)
    ->unique(true);

$tbl->add('symbol', Text::class);

$tbl->add('icon', Image::class);

$tbl->add('precision', Integer::class)
    ->required(true);

$tbl->add('enable_time', EnableTime::class);

$tbl->add('disable_time', DisableTime::class);

$tbl->add('ranking', Ranking::class);

return $tbl;
