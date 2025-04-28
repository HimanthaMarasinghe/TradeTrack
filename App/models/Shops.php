<?php

class Shops extends Model
{

    protected $table = 'shops';
    protected $readTable = 'shops s INNER JOIN users u ON s.so_phone = u.phone';
    protected $fillable = ['so_phone', 'shop_name', 'shop_address', 'cash_drawer_balance', 'non_registerd_creditors', 'shop_pic_format'];

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

    public function updateCreditors($so_phone, $amount, $con)
    {
        $query = "UPDATE $this->table SET non_registerd_creditors = non_registerd_creditors + :amount WHERE so_phone = :so_phone";
        $data = [
            'amount' => $amount,
            'so_phone' => $so_phone
        ];
        $this->query($query, $data, $con);
    }

    public function allShops($search = null, $location = null, $offset = 0)
    {
        $query = "SELECT 
                    s.so_phone, 
                    s.shop_pic_format,
                    s.shop_name, 
                    s.shop_address, 
                    u.first_name,
                    u.last_name
                FROM 
                    $this->readTable 
                WHERE 
                        shop_name LIKE :search 
                    OR 
                        shop_address LIKE :search 
                    OR
                        CONCAT(u.first_name, ' ', u.last_name) LIKE :search
                LIMIT 10 OFFSET $offset";
        $data = ['search' => "%$search%"];
        return $this->query($query, $data);
    }

    public function searchShops($search, $loyalty) {
        $queryParam = ['search' => "%$search%"]; 

        $sql = "SELECT * FROM shops s 
                INNER JOIN users u ON s.so_phone = u.phone 

                WHERE 
                (s.so_phone = :search
                OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search
                OR s.shop_name LIKE :search
                OR s.shop_address LIKE :search)";

        if($loyalty == 1){
            $sql .= " AND s.so_phone IN (
                SELECT DISTINCT so_phone FROM shop_orders
                WHERE dis_phone = :dis_phone
            )";

            $queryParam['dis_phone'] = $_SESSION['distributor']['phone'];

        }

        
        return $this->query($sql, $queryParam);
    }
    

    public function getShopsData($search = null, $location = null, $offset = 0)
    {
        // Use the allShops method to fetch the data from the Shops table
        return $this->allShops($search, $location, $offset);
    }

    public function getCashDrawerBalance($so_phone) {
        $sql = "SELECT cash_drawer_balance FROM $this->table WHERE so_phone = :so_phone";
        return $this->query($sql, ['so_phone' => $so_phone])[0]['cash_drawer_balance'];
    }


}