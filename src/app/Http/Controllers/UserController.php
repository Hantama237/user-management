<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ProfileRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userRepository;
    private $profileRepository;

    public function __construct(UserRepositoryInterface $userRepository, ProfileRepositoryInterface $profileRepository) 
    {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
    }
    
    public function index(){
        return response()->json([
            'data' => $this->userRepository->getAllUsers()
        ]);
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(), [
            "email"=>"required|email",
            "password"=>"required|string|max:255"
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        return response()->json(
            [
                'data' => $this->userRepository->createUser($validator->valid())
            ],
            Response::HTTP_CREATED
        );
    }
    public function show($id, Request $req){
        return response()->json([
            'data' => $this->userRepository->getUserById($id)
        ]);
    }
    public function update($id, Request $req){
        $validator = Validator::make($req->all(), [
            "email"=>"email",
            "password"=>"string|max:255"
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'data' => $this->userRepository->updateUser($id, $validator->valid())
        ]);
    }
    public function delete($id, Request $req){
        $profile = $this->userRepository->getProfileByUserId($id);
        $this->profileRepository->deleteProfile($profile->id);
        $this->userRepository->deleteUser($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }   

    public function showUserWithProfile($id,Request $req){
        $user = $this->userRepository->getUserById($id);
        if(!$user){
            return response()->json(['data'=>$user]);
        }
        $profile = $user->profile;
        return response()->json([
            'data' => $user
        ]);
    }
    public function createUserWithProfile(Request $req){
        $validator = Validator::make($req->all(), [
            "email"=>"required|email|unique:users",
            "password"=>"required|confirmed|string|max:255",

            "picture"=>"required|image|max:1000",
            "name"=>"required|max:255",
            "gender"=>"required|in:male,female",
            "nationality"=>"required|in:America,Russia,Ukraine,China",
            "date_of_birth"=>"required|date",
        ]);
        if($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $data = $validator->valid();
        
        $user = $this->userRepository->createUser([
            "email"=>$data["email"],
            "password"=>$data["password"]
        ]);
        if($user){
            if($req->file("picture")){
                $imageName = time().'.'.$req->picture->extension();  
                $req->picture->move(public_path('assets/images/profile/'), $imageName);
                $data["picture"] = $imageName;
            }
            
            $profile = $this->profileRepository->createProfile([
                "picture"=>$data["picture"],
                "name"=>$data["name"],
                "gender"=>$data["gender"],
                "nationality"=>$data["nationality"],
                "date_of_birth"=>$data["date_of_birth"],
                "profileable_id"=>$user->id,
                "profileable_type"=>\App\Models\User::class
                
            ]);
            if($profile){
                $profile = $user->profile;
                return response()->json([
                    'data' => $user
                ]);
            }else{
                $user->delete();
            }
        }  
        return response()->json([
            'data' => false
        ]);
        
    }
}
