<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Session;
class UserAuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
        
    }

    public function index(){
        Session::put("current_page","login");
        return view("user.login");
    }
    public function login(Request $req){
        $data = $req->validate([
            "email"=>"required|max:50",
            "password"=>"required|max:50"
        ]);
        $user = $this->userRepository->loginUser($data["email"],$data["password"]);
        if($user){
            Session::put([
                "id"=>$user->id,
                "type"=>"user"
            ]);
            return redirect("/");
        }
        return redirect()->back()->withErrors(["Incorrect email or password"]);
    }

    public function logout(){
        Session::flush();
        return redirect("/login");
    }

}
