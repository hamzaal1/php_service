<?php

namespace App;

use App\Request;

abstract class Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
    }

    public function show(Request $request){}

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
    }

    public function edit(Request $request)
    {
    }

    public function update(Request $request)
    {
    }

    public function destroy(Request $request)
    {
    }
    function view($path, mixed $data = null)
    {
        // Assuming views are in the root directory
        $path = "./views/" . $path . ".php";

        if (!file_exists($path)) {
            throw new \InvalidArgumentException("View not found: {$path}");
        }

        // Extract the data so it's accessible in the view
        if ($data !== null) {
            if (!is_array($data) && !is_object($data)) {
                throw new \InvalidArgumentException("Invalid data type. Expected array or object.");
            }
            extract(["data" => $data]);
        }

        // Capture the output of the view
        ob_start();
        include $path;
        $content = ob_get_clean();

        return $content;
    }

    // Additional common methods or properties can be added as needed
}
