<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function login_user($username, $password)
    {
        return $this->db->table('tbl_user')->where([
            'username' => $username,
            'password' => $password
        ])->get()->getRowArray();
    }
}