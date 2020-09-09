<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Idea;

class Category extends Model
{
    protected $fillable = [ 'name' ];
    public function ideas()
    {
    	return $this->belongsToMany(Idea::class);
    }
}
