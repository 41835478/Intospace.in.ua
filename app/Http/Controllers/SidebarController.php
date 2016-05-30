<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;

class SidebarController extends Controller
{
    public function index()
    {
        $data = [
            'tags'  =>  Tag::with('postsCount')->get(),
        ];


        return $data;
    }
}
