<?php

namespace App\Filament\Resources\Blog\Comments;

use App\Filament\Resources\Blog\Comments\Pages\ListComments;
use App\Filament\Resources\Blog\Comments\Tables\CommentsTable;
use Blog\Models\Comment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;
    protected static string|null|\UnitEnum $navigationGroup = 'مدیریت وبلاگ';

    protected static ?string $recordTitleAttribute = 'blog-comments';

    protected static ?string $pluralLabel = 'نظرات';

    protected static ?string $modelLabel = 'نظر';

    public static function canCreate(): bool
    {
        return false;
    }


    public static function table(Table $table): Table
    {
        return CommentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
        ];
    }
}
