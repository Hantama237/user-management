<?php

namespace App\Http\Controllers;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;
use Session;
class AdminPageController extends Controller
{   
    private $userRepository;
    private $adminRepository;

    public function __construct(UserRepositoryInterface $userRepository, AdminRepositoryInterface $adminRepository) 
    {
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;
    }

    public function index(Request $req){
        Session::put("current_page","home");
        if ($req->ajax()) {
            $data = $this->userRepository->getAllUsers();
            return Datatables::of($data)
                    ->addColumn('Picture',function($row){
                        return '<img class="rounded-circle" height="50px" width="50px" src="'.asset("/assets/images/profile/".$row->profile->picture).'" alt="">';
                    })
                    ->addColumn('Name', function($row){
                        return $row->profile->name;
                    })
                    ->addColumn('Gender', function($row){
                        return $row->profile->gender;
                    })
                    ->addColumn('Nationality', function($row){
                        return $row->profile->nationality;
                    })
                    ->addColumn('Date of Birth', function($row){
                        return $row->profile->date_of_birth->format("Y-m-d");
                    })
                    ->addColumn('Action', function($row){
                        $btn = '<button onclick="showDetailModal('.$row->id.')" class="btn btn-primary">Detail</button>
                                <button onclick="deleteUser('.$row->id.')" class="btn btn-danger">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['Picture','Action'])
                    ->make(true);
        }
        return view("admin.index",[
            //"users"=>$this->userRepository->getAllUsers()
        ]);
    }

    public function profile(){
        Session::put("current_page","profile");
        return view("admin.profile",[
            "profile"=>$this->adminRepository->getAdminById(Session::get("id"))->profile,
        ]);
    }

   
}
