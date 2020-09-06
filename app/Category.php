<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Idea;

class Category extends Model
{
    public function ideas()
    {
    	return $this->belongsToMany(Idea::class);
    }
}
