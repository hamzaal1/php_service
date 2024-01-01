<?php

namespace App\Controller;

use App\Controller;
use App\Model\User;
use App\Request;
use App\Auth;

class AuthController extends Controller
{

    public function isAuth(Request $request)
    {
        echo json_encode([
            "message" => Auth::check() ? "user is loged in" : "user is not loged in",
            "status" => Auth::check() ? 1 : 0,
            "user"=> Auth::check() ? Auth::user() : null
        ]);
    }
    public function auth(Request $request)
    {
        // echo $request->username;
        if (Auth::credentiel($request->username, $request->password)) {
            echo json_encode([
                "message" => "user is loged in successfully",
                "status" => 1,
            ]);
        } else {
            echo json_encode([
                "message" => "the username or password wrong",
                "status" => 0,
            ]);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::logout()) {
            echo json_encode([
                "message" => "user is loged out successfully",
                "status" => 1,
            ]);
        } else {
            echo json_encode([
                "message" => "the user may be already logged out",
                "status" => 0,
            ]);
        }
    }


    public function create(Request $request){
        $user = User::create([
            "name" => $request->username,
            "email" => $request->email,
            "password" => $request->password
        ]);
        if($user){
            echo json_encode([
                "message" => "user created successfully",
                "status" => 1,
            ]);
        }else{
            echo json_encode([
                "message" => "some error occoured try again later",
                "status" => 0,
            ]);
        }
    }

}

?>