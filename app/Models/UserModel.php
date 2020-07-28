<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $allowedFields = ['first_name', 'last_name', 'email', 'username', 'password'];
}