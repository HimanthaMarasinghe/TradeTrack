<?php

class User extends Model
{

    protected $table = 'users';
    protected $fillable = ['phone', 'first_name','last_name', 'address', 'password', 'pic_format', 'role'];

}