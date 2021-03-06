<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Category;
use App\Models\Tag;
use App\Repositories\Posts\PostRepository;

class FooterComposer
{
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function compose(View $view)
    {
        $randompost = $this->post->getLatestActivePosts()->random(1);

        $view->with('randompost', $randompost);
    }
}
