<?php //>

namespace matrix\wallet;

trait WalletHelper {

    private function getWallet($member, $currency) {
        $conditions = [
            'member_id' => $member['id'],
            'currency_id' => $currency['id'],
        ];

        $model = model('Wallet');

        return $model->find($conditions) ?: $model->insert($conditions);
    }

}
