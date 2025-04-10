<?php

class soCashDrawerFlow extends Model
{
    protected $table = 'so_cash_drawer_flow';
    protected $fillable = ['so_phone', 'date', 'time', 'amount', 'type'];
}