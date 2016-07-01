<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Band;
use App\Post;
use DB;

use App\Http\Requests;

class BandController extends Controller
{
    public function index()
    {
        Band::with('posts', 'reviews', 'videos')->orderBy('title')->get();

        return view('backend.bands.index', compact('bands'));
    }
}
