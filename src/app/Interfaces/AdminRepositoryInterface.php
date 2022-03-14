<?php

namespace App\Interfaces;

interface AdminRepositoryInterface 
{
    public function loginAdmin($username,$password);

    public function getAdminById($adminId);

}