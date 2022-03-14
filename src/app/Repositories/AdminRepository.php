<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use File;
use Hash;
class AdminRepository implements AdminRepositoryInterface 
{
    public function loginAdmin($username,$password){
        $user = Admin::where("username",$username)->first();
        if($user && Hash::check($password,$user->password)){
            return $user;
        }
        return null;
    }
    public function getAdminById($adminId){
        return Admin::find($adminId);
    }
    
}