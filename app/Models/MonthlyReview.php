<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Core\Entity;

class MonthlyReview extends Entity implements SluggableInterface
{
    use SluggableTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}