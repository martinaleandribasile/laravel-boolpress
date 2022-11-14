<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class HomeController extends Controller
{
    public function index()
    {
        $lastpost = Post::latest('id')->first();
        return view('admin.home', compact('lastpost'));
    }
}
