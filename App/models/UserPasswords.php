<?php

class UserPasswords extends Model
{

    protected $table = 'user_passwords';
    protected $fillable = ['phone', 'password'];

}