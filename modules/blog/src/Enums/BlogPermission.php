<?php


namespace Blog\Enums;

use Ecommerce\Enums\EcommercePermission;

enum BlogPermission: string
{
    // Blog
    case Blog = 'blog';

    // Article
    case Article= 'blog.article';
    case ArticleView = 'blog.article.view';
    case ArticleCreate = 'blog.article.create';
    case ArticleEdit = 'blog.article.edit';
    case ArticleDelete = 'blog.article.delete';

    // Category
    case Category = 'blog.category';
    case CategoryView = 'blog.category.view';
    case CategoryCreate = 'blog.category.create';
    case CategoryEdit = 'blog.category.edit';
    case CategoryDelete = 'blog.category.delete';

    // Comment
    case Comment = 'blog.comment';
    case CommentView = 'blog.comment.view';
    case CommentApprove = 'blog.comment.approve';
    case CommentReject = 'blog.comment.reject';

    public static function getPermissionNames()
    {
        return collect(BlogPermission::cases())->map(function (BlogPermission $item) {
            return $item->value;
        });
    }

    public static function getFaLanguage()
    {
        return collect(BlogPermission::cases())
            ->mapWithKeys(function ($item) {
            return [$item->value => $item->label()];
        })->toArray();
    }

    public function label(): string
    {
        return match ($this) {
            // Blog
            self::Blog => 'بلاگ',

            // Article
            self::Article=>'مقالات',
            self::ArticleView => 'مشاهده مقالات',
            self::ArticleCreate => 'ایجاد مقاله',
            self::ArticleEdit => 'ویرایش مقاله',
            self::ArticleDelete => 'حذف مقاله',

            // Category
            self::Category=>'دسته‌بندی مقالات',
            self::CategoryView => 'مشاهده دسته‌بندی‌ها',
            self::CategoryCreate => 'ایجاد دسته‌بندی',
            self::CategoryEdit => 'ویرایش دسته‌بندی',
            self::CategoryDelete => 'حذف دسته‌بندی',

            // Comment
            self::Comment=>'نظرات مقالات',
            self::CommentView => 'مشاهده نظرات',
            self::CommentApprove => 'تأیید نظر',
            self::CommentReject => 'رد نظر',
        };
    }
}
