<?php

class Bills extends Model
{

    protected $table = 'bills';
    protected $fillable = ['bill_id', 'cus_phone', 'so_phone'];

}