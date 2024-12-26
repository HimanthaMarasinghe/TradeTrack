<?php

class Manufacturers extends Model
{

    protected $table = 'manufacturers';
    protected $readTable = 'manufacturers s INNER JOIN users u ON s.man_phone = u.phone';
    protected $fillable = ['man_phone', 'company_name', 'company_address'];

}