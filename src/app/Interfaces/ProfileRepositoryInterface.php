<?php

namespace App\Interfaces;

interface ProfileRepositoryInterface 
{
    public function getProfileById($profileId);
    public function updateProfile($profileId, $newData);
    public function createProfile($data);
    public function deleteProfile($profileId);
}