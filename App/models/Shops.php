<?php

class Shops extends Model
{

    protected $table = 'shops';
    protected $readTable = 'shops s INNER JOIN users u ON s.so_phone = u.phone';
    protected $fillable = ['so_phone', 'shop_name', 'shop_address', 'cash_drawer_balance', 'bank_balance', 'shop_pic_format'];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['name']))
        {
            $this->errors['name'] = "Name is required.";
        }

        if(empty($this->errors))
            return true;

        return false;
    }

    public function updateCashDrawer($so_phone, $amount, $con)
    {
        $query = "UPDATE $this->table SET cash_drawer_balance = cash_drawer_balance + :amount WHERE so_phone = :so_phone";
        $data = [
            'amount' => $amount,
            'so_phone' => $so_phone
        ];
        $this->query($query, $data, $con);
    }
}