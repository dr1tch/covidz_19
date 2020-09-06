<?php

namespace App;

use App\User;
use App\Category;
use App\Tag;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $guarded = [];

    // use Likable;

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function category(){
    	return $this->belongsTo(Categorie::class);
    }

    public function tag(){
    	return $this->belongsTo(Tag::class);
    }
}
