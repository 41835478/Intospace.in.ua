<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Blog;
use Auth;
use Flash;
use Carbon\Carbon;
use App\Http\Requests\StoreBlogRequest;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function index()
    {
        $blogs = $this->blog->with('user')->paginate(15);

        return view('backend.blogs.index', compact('blogs'));
    }

    public function show(Request $request, $id)
    {
        $blog = $this->blog->findOrFail($id);

        return view('backend.blogs.show', compact('blog'));
    }

    public function create()
    {
        $data = [
            'save_url'      =>  route('backend.blogs.store'),
        ];
        return view('backend.blogs.create', $data);
    }

    public function destroy($id)
    {
        $review = $this->blog->findOrFail($id);

    }

    public function update(StoreBlogRequest $request, $id)
    {
        $review = $this->blog->findOrNew($id);
    }

    public function store(StoreBlogRequest $request)
    {
        $blog = $this->storeOrUpdateBlog($request, $blog_id = null);

        //dd($request->input('published_at'));
        $blog->published_at = $request->input('published_at');
        $blog->save();

        Flash::message('blog created!');
        return redirect()->route('backend.blogs.edit', ['blog_id' => $blog->id]);
    }

    public function edit($blog_id)
    {
        $data = [
            'blog'          =>  $this->blog->find($blog_id),
        ];

        return view('backend.blogs.edit', $data);
    }

    public function storeOrUpdateBlog(Request $request, $blog_id)
    {
        $blog = $this->blog->findOrNew($blog_id);
        $blog->user_id = Auth::user()->id;
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');

        return $blog;
    }
}
