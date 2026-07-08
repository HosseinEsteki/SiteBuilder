# Email Module

The Email module contains mail-related routes, controllers, and mail classes for SiteBuilder.

## Contents

- `Email\Http\Controllers\EmailController`
- `Email\Mail\OrderCreatedMail`
- `Email\Providers\EmailServiceProvider`
- `routes/web.php`

## Current Scope

This module currently provides a test email route and an order-created mailable skeleton. It is not yet a full notification system.

## Routes

```text
POST /send-test-email
```

## Provider

The service provider is auto-discovered through the module `composer.json`.

## TODO

- Add production-ready order email views.
- Add event-driven sending from the ecommerce order flow.
- Add queue configuration and tests.
