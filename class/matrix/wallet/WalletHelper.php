<?php //>

namespace matrix\wallet;

trait WalletHelper {

    protected function getWallet($member, $currency) {
        $conditions = [
            'member_id' => $member['id'],
            'currency_id' => $currency['id'],
        ];

        $model = model('Wallet');

        return $model->find($conditions) ?: $model->insert($conditions);
    }

    private function freeze($type, $member, $currency, $amount, $remark, $snapshot, $target_id = null) {
        $wallet = $this->getWallet($member, $currency);
        $wallet['frozen'] = round($wallet['frozen'] + $amount, $currency['precision']);

        if ($wallet['balance'] < $wallet['frozen'] || $wallet['frozen'] < 0) {
            return false;
        }

        $wallet = model('Wallet')->update($wallet);

        if ($wallet) {
            $log = model('FrozenLog')->insert([
                'wallet_id' => $wallet['id'],
                'the_date' => date(cfg('system.date')),
                'type' => $type,
                'amount' => $amount,
                'target_id' => $target_id,
                'remark' => $remark,
                'snapshot' => $snapshot,
            ]);

            if ($log) {
                return $wallet;
            }
        }

        return null;
    }

    private function manipulate($type, $member, $currency, $amount, $remark, $snapshot, $target_id = null) {
        $wallet = $this->getWallet($member, $currency);
        $wallet['balance'] = round($wallet['balance'] + $amount, $currency['precision']);

        if ($wallet['balance'] < $wallet['frozen']) {
            return false;
        }

        $wallet = model('Wallet')->update($wallet);

        if ($wallet) {
            $log = model('WalletLog')->insert([
                'wallet_id' => $wallet['id'],
                'the_date' => date(cfg('system.date')),
                'type' => $type,
                'amount' => $amount,
                'balance' => $wallet['balance'],
                'target_id' => $target_id,
                'remark' => $remark,
                'snapshot' => $snapshot,
            ]);

            if ($log) {
                return $wallet;
            }
        }

        return null;
    }

}
