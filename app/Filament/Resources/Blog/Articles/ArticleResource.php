<?php

namespace App\Filament\Resources\Blog\Articles;

use App\Filament\Resources\Blog\Articles\Pages\CreateArticle;
use App\Filament\Resources\Blog\Articles\Pages\EditArticle;
use App\Filament\Resources\Blog\Articles\Pages\ListArticles;
use App\Filament\Resources\Blog\Articles\Pages\ViewArticle;
use App\Filament\Resources\Blog\Articles\Schemas\ArticleForm;
use App\Filament\Resources\Blog\Articles\Schemas\ArticleInfolist;
use App\Filament\Resources\Blog\Articles\Tables\ArticlesTable;
use Blog\Models\Article;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|null|\UnitEnum $navigationGroup = 'مدیریت وبلاگ';

    protected static ?string $recordTitleAttribute = 'blog-articles';

    protected static ?string $pluralLabel = 'مقالات';

    protected static ?string $modelLabel = 'مقاله';



    public static function form(Schema $schema): Schema
    {
        return ArticleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArticleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticlesTable::configure($table);
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
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'view' => ViewArticle::route('/{record}'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}
