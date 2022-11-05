<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Album;

class AlbumController extends Controller
{

    public function index() {
        return view('album.index');
    }
    public function create() {
        return view('album.create');
    }

    public function store(Request $request) {
        /* lets validate the request! */
        /* TODO: CREATE A MIDDLEWARE REQUEST FOR THIS CONTROLLER */
        $this->validate($request, [
            'name' => 'required|min:3|max:15',
            'description' => 'required|min:3|max:200',
            'category_id' => 'required',
            'image' => 'required|mimes:jpes,jpg,png'
        ]);
        $imageName = $request->image->hashName(); // stores name to public directory
        $request->image->move(public_path('album'), $imageName);
        
        $album = Album::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name), // slug generated from the name 
            'user_id' => auth()->user()->id,
            'image' => $imageName
        ]);
        $id = $album->id;
        return response()->json(['id' => $id]);
    }

    public function getAlbums() {
        $albums = Album::with('category')->where('user_id', auth()->user()->id)->get();
        return $albums;
    }

}
