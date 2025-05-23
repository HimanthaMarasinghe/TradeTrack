<?php

class WalletSoDis extends Model
{

    protected $table = 'wallet_so_dis';
    protected $fillable = ['so_phone', 'dis_phone', 'wallet'];

    public function updateWallet($dis_phone, $so_phone, $amount, $con) {

        $sql = "INSERT INTO $this->table (`so_phone`, `dis_phone`, `wallet`) 
                VALUES (:so_phone, :dis_phone, :amount)
                ON DUPLICATE KEY UPDATE
                wallet = wallet + VALUES(wallet)";
        return $this->query($sql, ['amount' => $amount, 'so_phone' => $so_phone, 'dis_phone' => $dis_phone], $con);
    }

}