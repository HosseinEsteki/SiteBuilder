# Public Module

The Public module contains shared building blocks used by Blog, Ecommerce, and other content modules.

## Contents

- `Public\Models\Post`
- `Public\Traits\HasAuthor`
- `Public\Traits\HasPersianDate`
- `Public\Helpers\AuthorHelper`
- shared `PostStatus` and `CommentStatus` enums
- author migrations for blog and ecommerce tables

## Purpose

`Public\Models\Post` is the shared base model for content-like records such as blog articles and ecommerce products. It provides shared fillable fields, slug support, SEO traits, tags, media integration, author handling, and Persian date helpers.

## Provider

The service provider is auto-discovered through the module `composer.json` and loads shared migrations.

## TODO

- Document exact shared field contracts for content modules.
- Add tests for author assignment in web, API, queue, and seeder contexts.
