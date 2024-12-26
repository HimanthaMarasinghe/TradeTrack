<?php

class DistributorM extends Model
{

    protected $table = 'distributors';
    protected $readTable = 'distributors s INNER JOIN users u ON s.dis_phone = u.phone';
    protected $fillable = ['dis_phone', 'dis_busines_name', 'man_phone'];

}