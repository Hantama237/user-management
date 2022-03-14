<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Session;
class UserPageController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        Session::put("current_page","home");
        return view("user.index");
    }

    public function profile(){
        Session::put("current_page","profile");
        return view("user.profile",[
            "profile"=>$this->userRepository->getProfileByUserId(Session::get("id")),
        ]);
    }
}
