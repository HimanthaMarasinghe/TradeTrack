<?php

class SaOtherExpenses extends Model
{

    protected $table = 'sa_other_expenses';
    protected $fillable = ['expense_id','sa_phone', 'amount', 'date', 'description'];

}