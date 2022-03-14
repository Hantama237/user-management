<?php

namespace App\Interfaces;

interface AdminRepositoryInterface 
{
    public function loginAdmin($username,$password);
    // public function getAllAdmin();
   
    public function getAdminById($adminId);
    // public function deleteAdmin($userId);
    // public function updateAdmin($userId, $newData);
    // public function createAdmin($userData);
}