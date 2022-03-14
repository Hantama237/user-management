<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\Profile;
use File;

class ProfileRepository implements ProfileRepositoryInterface 
{
    public function getProfileById($profileId){
        return Profile::find($profileId);
    }
    public function createProfile($profileData){
        return Profile::create($profileData);
    }
    public function updateProfile($profileId, $newData){
        return Profile::where("id",$profileId)->update($newData);
    }
    public function deleteProfile($profileId){
        $profile = Profile::find($profileId);
        if(File::exists(public_path('assets/images/profile/'.$profile->picture))){
            File::delete(public_path('assets/images/profile/'.$profile->picture));
        }
        $profile->delete();
    }

}