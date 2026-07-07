<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorjsUploadController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('image');

        $media = auth()->user()
            ->addMedia($file)
            ->toMediaCollection('editorjs');

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => $media->getUrl(),
            ],
        ]);
    }
}

