<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Category;
use Illuminate\Http\Request;
use App\Tag;
use App\Album;
class AdminController extends Controller
{
    /**
     * Handle Tags Part
     * 
     *  [get, create, edit, delete, deleteAll]
     */

    public function createTag(Request $request)
    {
        $attributes = request()->validate([
            'tagName' => 'required|max:25',
        ]);
        $tag = Tag::create([
            'name' => $attributes['tagName'],
        ]);
        return "it's working";
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
     *  [get, create, edit, delete, deleteAll]
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

    /**
     * Handle Albums Part
     * 
     *  [get, create, edit, delete, deleteAll]
     */

    public function createAlbum(Request $request){
        $attributes = request()->validate([
            'name' => 'required|string|max:256',
            'description' => 'required',
            'cover' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]); 
        $file = request('cover');
        $random_name = Str::random(10);
        $destinationPath = 'images/albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_cover.'.$extension;
        $uploadSuccess = request('cover')
        ->move($destinationPath, $filename);
        $album = Album::create([
            'name' => request('name'),
            'description' => request('description'),
            'cover_image' => $filename,
        ]);
        return "success";
    }
    public function getAlbums(){
       return Album::all();
    }
    public function getAlbum(Album $album){
        return $album;
    }
    
    public function editAlbum(Album $album){
        $req = request()->validate([
            'name' => ['required', 'string', 'max:256', Rule::unique('albums')->ignore($album)],
            'description' => 'required',
            'cover' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);
        $file = request('cover');
        time() . '.' . $request->image->extension();
        $random_name = Str::random(10);
        $destinationPath = 'images/albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_cover.'.$extension;
        $uploadSuccess = request('cover')
        ->move($destinationPath, $filename);
        $album->update([
            'name' => request('name'),
            'description' => request('description'),
            'cover_image' => $filename,
        ]);
        return "success";
    }

    public function deleteAlbum(Album $album){
      $album->delete();
      Storage::delete('images/albums/'.$album['cover_image']);
    }

    public function deleteAllAlbums(){
        Album::where('id', '>', 0)->delete();
        return "done";
    }
}
