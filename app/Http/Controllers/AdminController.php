<?php

namespace App\Http\Controllers;

use App\Category;
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
            'Name' => 'required|max:25',
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

    /**
     * Handle Categories Part
     * 
     *  [create, edit, delete, deleteAll]
     */

    public function createCategory(Request $request)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $cat = Category::create([
            'name' => $attributes['catName'],
        ]);
        return "it's working";
    }


    public function getCategories()
    {
        return Category::latest()->get();
    }

    public function editCategory(Category $category)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $category->update(['name' => $attributes["catName"]]);
        return $category;
    }


    public function deleteCategory(Category $category)
    {
        $category->delete();
        return "done";
    }
    public function deleteAllCategories()
    {
        Category::where('id', '>', 0)->delete();
        return "done";
    }
}
