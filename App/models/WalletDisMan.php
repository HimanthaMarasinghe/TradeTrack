<?php

class WalletDisMan extends Model
{

    protected $table = 'wallet_dis_man';
    protected $fillable = ['man_phone', 'dis_phone', 'wallet'];

    public function updateDisManWallet($dis_phone, $man_phone, $ammount) {

        $sql = "INSERT INTO $this->table (`man_phone`, `dis_phone`, `wallet`) 
                VALUES (:man_phone, :dis_phone, :ammount)
                ON DUPLICATE KEY UPDATE
                wallet = wallet + VALUES(wallet)";
        return $this->query($sql, ['ammount' => $ammount, 'man_phone' => $man_phone, 'dis_phone' => $dis_phone]);
    }

}