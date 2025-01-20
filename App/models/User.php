<?php

class User extends Model
{

    protected $table = 'users';
    protected $fillable = ['phone', 'first_name','last_name', 'address', 'pic_format', 'role'];

}