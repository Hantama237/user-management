<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Session;
class AdminAuthController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository) 
    {
        $this->adminRepository = $adminRepository;
        
    }

    public function index(){
        Session::put("current_page","loginadmin");
        return view("admin.login");
    }
    public function login(Request $req){
        $data = $req->validate([
            "username"=>"required|max:50",
            "password"=>"required|max:50"
        ]);
        $admin = $this->adminRepository->loginAdmin($data["username"],$data["password"]);
        if($admin){
            Session::put([
                "id"=>$admin->id,
                "type"=>"admin"
            ]);
            return redirect("/admin");
        }
        return redirect()->back()->withError("Incorrect email or password");
    }
    public function logout(){
        Session::flush();
        return redirect("/admin/login");
    }

}
