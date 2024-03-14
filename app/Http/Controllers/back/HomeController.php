<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function index()
    {
        $posts = Post::orderByViews()->get(); // descending
        $users = DB::table('users')->count();
        return view('back.pages.home',
    ['posts' => $posts]);
    }
}
