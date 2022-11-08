<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Album;

class GalleryController extends Controller
{
    public function create($id) {
        /* Check if this album belongs to this user */
        $albumBelongsToUser = Album::where('user_id', auth()->user()->id)->exists();
        if ($albumBelongsToUser) {
            $album_id = $id;
            session()->put('id', $id);
            return view('image.create', compact('album_id'));
        } else {
            return redirect()->back();
        }
    }
    

    public function upload(Request $request) {
        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'mimes:png,jpeg,jpg,gif'
        ]);

        foreach($request->file('files') as $file) {
            $name = $file->hashName();
            $file->move(public_path().'/images/', $name);

            $file = new Image();
            $file->album_id = $request->album_id;
            $file->image = $name;
            $file->save();
        }
        return response()->json(['success' => 'Your images successfully uploaded']);
    }
}
