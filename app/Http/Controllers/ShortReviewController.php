<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;

class ShortReviewController extends Controller
{
    protected $post;

    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $data = [
            'posts' =>  $this->post->getShortReviewsPosts(),
        ];

        return view('frontend.shortreviews.index', $data);
    }
}
