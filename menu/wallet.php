<?php //>

return [

    'wallets' => ['icon' => 'fas fa-wallet', 'ranking' => 2200, 'parent' => null],

        'currency' => ['icon' => 'fas fa-dollar-sign', 'ranking' => 100, 'parent' => 'wallets', 'group' => true, 'tag' => 'query'],

            'currency/' => ['parent' => 'currency', 'tag' => 'query'],

            'currency/delete' => ['parent' => 'currency', 'tag' => 'system'],

            'currency/insert' => ['parent' => 'currency', 'tag' => 'system'],

            'currency/new' => ['parent' => 'currency', 'tag' => 'system'],

            'currency/update' => ['parent' => 'currency', 'tag' => 'update'],

        'wallet' => ['icon' => 'fas fa-wallet', 'ranking' => 200, 'parent' => 'wallets', 'group' => true, 'tag' => 'query'],

            'wallet/delete' => ['parent' => 'wallet', 'tag' => 'system'],

            'wallet/insert' => ['parent' => 'wallet', 'tag' => 'system'],

            'wallet/new' => ['parent' => 'wallet', 'tag' => 'system'],

            'wallet/log' => ['parent' => 'wallet', 'pattern' => 'wallet/{{ id }}/log', 'group' => true, 'tag' => 'query'],

                'wallet/log/' => ['parent' => 'wallet/log', 'tag' => 'query'],

                'wallet/log/insert' => ['parent' => 'wallet/log', 'tag' => 'insert'],

                'wallet/log/new' => ['parent' => 'wallet/log', 'tag' => 'insert'],

            'wallet/frozen' => ['parent' => 'wallet', 'pattern' => 'wallet/{{ id }}/frozen', 'group' => true, 'tag' => 'query'],

                'wallet/frozen/' => ['parent' => 'wallet/frozen', 'tag' => 'query'],

                'wallet/frozen/insert' => ['parent' => 'wallet/frozen', 'tag' => 'insert'],

                'wallet/frozen/new' => ['parent' => 'wallet/frozen', 'tag' => 'insert'],

];
