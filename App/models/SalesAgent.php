<?php

class SalesAgent extends Model
{

    protected $table = 'sales_agents';
    protected $readTable = 'sales_agents s INNER JOIN users u ON s.sa_phone = u.phone';
    protected $fillable = ['sa_phone', 'sa_busines_name', 'su_phone'];

}