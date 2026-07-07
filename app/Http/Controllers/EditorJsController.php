<?php

namespace App\Http\Controllers;

use Blog\Models\Article;
use Illuminate\Http\Request;

class EditorJsController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            // فرض می‌کنیم یک Article نمونه داریم یا می‌سازی
            $article = new Article();
            $article->save();

            $article->addMediaFromRequest('image')
                ->toMediaCollection('editorjs');

            $media = $article->getFirstMedia('editorjs');

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $media->getUrl(),
                ],
            ]);
        }

        return response()->json(['success' => 0]);
    }

}
