<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cache;
use App\Core\Entity;

/**
 * Class Blog
 * @package App
 */
class Blog extends Entity implements SluggableInterface
{
    use SluggableTrait;

    protected $table = 'blogposts';
}
