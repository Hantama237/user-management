<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Hash;
class UserRepository implements UserRepositoryInterface 
{
    public function loginUser($email,$password){
        $user = User::where("email",$email)->first();
        if($user && Hash::check($password,$user->password)){
            return $user;
        }
        return null;
    }
    
    public function getAllUsers(){
        return User::all();
    }
    public function getAllVerifiedUsers(){
        return User::where("verified_at","!=",null)->first();
    }
    public function getUserById($userId){
        return User::find($userId);
    }
    public function deleteUser($userId){
        User::destroy($userId);
    }
    public function updateUser($userId, $newData){
        return User::find($userId)->update($newData);
    }
    public function createUser($userData){
        return User::create($userData);
    }

    public function getProfileByUserId($userId){
        return User::find($userId)->profile;
    }
}