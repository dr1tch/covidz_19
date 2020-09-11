<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Album extends Model
{
    protected $fillable = ['name','description','cover_image'];

    public function images(){
        return $this->has_many(Image::class);
    }

}
