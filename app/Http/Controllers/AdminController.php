<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class AdminController extends Controller
{
    /**
     * Handle Tags Part
     * 
     *  [create, edit, delete, deleteAll]
     */

    public function createTag(Request $request)
    {
        $attributes = request()->validate([
            'tagName' => 'required|max:25',
        ]);
        $tag = Tag::create([
            'name' => $attributes['tagName'],
        ]);
        //return "it's working";
    }


    public function getTags()
    {
        return Tag::latest()->get();
    }

    public function editTag(Request $request, Tag $tag)
    {
        $attributes = request()->validate([
            'tagName' => 'required|max:25',
        ]);
        $tag->update(['name' => $attributes["tagName"]]);
        return $tag;
    }


    public function deleteTag(Tag $tag)
    {
        $tag->delete();
        return "done";
    }
    public function deleteAllTags()
    {
        Tag::where('id', '>', 0)->delete();
        return "done";
    }
}
