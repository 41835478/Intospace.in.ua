<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Traits\ScopesTrait;
use App\Core\Entity;
use Sofa\Eloquence\Eloquence;

class Post extends Entity implements SluggableInterface
{
    use SluggableTrait;
    use ScopesTrait;
    use Eloquence;

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = ['year'];

    /**
     * @var array
     */
    protected $searchableColumns = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function band()
    {
        return $this->belongsTo(Band::class, 'band_id');
    }

    /**
     * @param $category_id
     * @return mixed
     */
    public function getPostsByCategoryId($category_id)
    {
        $posts = $this->with(['category', 'user']);
        if (!empty($category_id)) {
            $posts = $posts->where('category_id', $category_id);
        }

        return $posts->active()->sort()->paginate(10);
    }

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeFindBySlug($query, $slug)
    {
        return $query->whereSlug($slug)->firstOrFail();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getPostsByTag($slug)
    {
        $posts = Post::with('band', 'tags', 'category')->whereHas('tags', function ($query) use ($slug) {
                                                  $query->whereSlug($slug);})
                                                ->latest()->paginate(10);

        return $posts;
    }
}
