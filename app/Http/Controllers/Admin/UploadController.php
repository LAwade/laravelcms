<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function imageupload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $image = time() . '.' . $request->file->extension();
        $request->file->move(public_path('media/images'), $image);

        return [
            'location' => asset('media/images/' . $image)
        ];
    }
}
