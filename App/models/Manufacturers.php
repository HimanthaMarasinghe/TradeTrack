<?php

class Manufacturers extends Model
{

    protected $table = 'manufacturers';
    protected $readTable = 'manufacturers s INNER JOIN users u ON s.su_phone = u.phone';
    protected $fillable = ['su_phone', 'company_name', 'company_address'];

}