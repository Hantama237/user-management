<?php

namespace App\Http\Controllers;

use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use File;

class ProfileController extends Controller
{
    private $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository) 
    {
        $this->profileRepository = $profileRepository;
    }
    public function create(Request $req, UserRepositoryInterface $userRepository, AdminRepositoryInterface $adminRepository){
        $validator = Validator::make($req->all(), [
            "picture"=>"required|image|max:1000",
            "info"=>"required|string|max:255",
            "date_of_birth"=>"required|date",
            "profileable_id"=>"required|exists:user"
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $data = $validator->valid();
        if(isset($data["picture"])){
            $imageName = time().'.'.$req->picture->extension();  
            $req->picture->move(public_path('assets/images/profile/'), $imageName);
            $data["picture"] = $imageName;
        }
        $data["profileable_type"]=\App\Models\User::class;
        return response()->json(
            [
                'data' => $this->profileRepository->createProfile($data)
            ],
            Response::HTTP_CREATED
        );
    }
    public function update($id,Request $req){
        $validator = Validator::make($req->all(), [
            "picture"=>"image|max:1000",
            "name"=>"string|max:255",
            "gender"=>"in:male,female",
            "nationality"=>"in:America,Russia,Ukraine,China",
            "date_of_birth"=>"date",
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $data = $validator->valid();
        if($req->file("picture")){
            $imageName = time().'.'.$req->picture->extension();  
            $req->picture->move(public_path('assets/images/profile/'), $imageName);
            $profile = $this->profileRepository->getProfileById($id);
            if(File::exists(public_path('assets/images/profile/'.$profile->picture))){
                File::delete(public_path('assets/images/profile/'.$profile->picture));
            }
            $data["picture"] = $imageName;
        }
        
        return response()->json([
            'data' => $this->profileRepository->updateProfile($id, $data)
        ]);
    }

    
}
