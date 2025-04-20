<?php

class soOtherExpences extends Model
{
    protected $table = 'so_other_expences';
    protected $fillable = ['id', 'date', 'time', 'cashDrawer', 'type', 'amount', 'so_phone'];

    public function totalForMonth($year, $month, $phone) {
        $query = "SELECT SUM(amount) as total FROM $this->table WHERE YEAR(date) = :year AND MONTH(date) = :month AND so_phone = :so_phone";
        return $this->query($query, ['year' => $year, 'month' => $month, 'so_phone' => $phone])[0]['total'];
    }
}