<?php

namespace App\Filament\Components\Inputs;

use Athphane\FilamentEditorjs\Forms\Components\EditorjsTextField;

class ContentInput
{
    public static function make()
    {
        return EditorjsTextField::make('content')->label(trans('public.content'))
            ->required()
            ->name('content')
            ->columnSpanFull()
            ->extraAttributes([
                'class' => 'editorjs-box',
            ]);

    }
}
