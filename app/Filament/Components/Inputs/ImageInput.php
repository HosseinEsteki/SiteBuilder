<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ImageInput
{
    public static function make(string $collectionName)
    {
        return SpatieMediaLibraryFileUpload::make($collectionName)
            ->label(trans('public.image.thumbnail'))
            ->image() // مشخص می‌کنه که فقط فایل‌های تصویری مجاز هستند
            ->imageEditor() // امکان کراپ و ویرایش تصویر
            ->columnSpan(2)
            ->required();
    }

    public static function makeGallery(string $collectionName)
    {
        return SpatieMediaLibraryFileUpload::make($collectionName)
            ->label(trans('public.image.gallery'))
            ->image()
            ->columnSpan(2)
            ->panelLayout('grid')
            ->imageEditor()
            ->required()
            ->multiple();
    }

    public static function makeVariant(string $collectionName) {
        return SpatieMediaLibraryFileUpload::make($collectionName)
            ->label(trans('public.image.thumbnail'))
            ->image() // مشخص می‌کنه که فقط فایل‌های تصویری مجاز هستند
            ->imageEditor() // امکان کراپ و ویرایش تصویر
            ->required();
    }
}
