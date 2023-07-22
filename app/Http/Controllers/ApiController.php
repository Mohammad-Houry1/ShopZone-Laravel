<?php
namespace App\Http\Controllers;

use App\Models\Post;

class ApiController extends Controller
{
    public function getData()
    {
        $data = Post::all(); // Retrieve data from your data source
        return response()->json($data);
    }
}