<?php

class WalletSoDis extends Model
{

    protected $table = 'wallet_so_dis';
    protected $fillable = ['so_phone', 'dis_phone', 'wallet'];

    public function updateWallet($dis_phone, $so_phone, $amount) {
        $sql = "UPDATE $this->table SET wallet = wallet + :amount WHERE dis_phone = :dis_phone AND so_phone = :so_phone";
        return $this->query($sql, ['amount' => $amount, 'so_phone' => $so_phone, 'dis_phone' => $dis_phone]);
    }

}