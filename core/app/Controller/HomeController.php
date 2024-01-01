<?php

namespace App\Controller;

use App\Controller;
use App\Model\User;
use App\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // echo 'Home controller';
    }

    public function index(Request $request)
    {
        // var_dump($request);
        $users = User::get();
        echo $this->view("home",$users);
    }

    public function show(Request $request)
    {

    }

    public function create(Request $request)
    {
        echo $this->view("create");

    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        header("Location:/");

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        echo $this->view("edit", $user);

    }

    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        $result = $user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);
        if ($result) {
            header("Location:/");
        }

    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            header("Location:/");
        }
    }
}

?>