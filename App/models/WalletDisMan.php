<?php

class WalletDisMan extends Model
{

    protected $table = 'wallet_dis_man';
    protected $fillable = ['man_phone', 'dis_phone', 'wallet'];

    public function updateDisManWallet($dis_phone, $man_phone, $ammount, $con = null){

        $sql = "INSERT INTO $this->table (`man_phone`, `dis_phone`, `wallet`) 
                VALUES (:man_phone, :dis_phone, :ammount)
                ON DUPLICATE KEY UPDATE
                wallet = wallet + VALUES(wallet)";
        return $this->query($sql, ['ammount' => $ammount, 'man_phone' => $man_phone, 'dis_phone' => $dis_phone], $con);
    }

    public function walletBalance($dis_phone){
        $queryParam = ['dis_phone' => $dis_phone, 'man_phone' => $_SESSION['manufacturer']['phone']];
        $sql = "SELECT wallet FROM wallet_dis_man WHERE dis_phone = :dis_phone AND 'man_phone' = :man_phone" ;

        $result = $this->query($sql, $queryParam);
    }

}