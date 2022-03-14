<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function loginUser($email,$password);
    public function getAllUsers();
    public function getAllVerifiedUsers();
    public function getUserById($userId);
    public function deleteUser($userId);
    public function updateUser($userId, $newData);
    public function createUser($userData);

    public function getProfileByUserId($userId);
}