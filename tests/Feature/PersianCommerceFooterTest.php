<?php

it('renders footer brand content', function () {
    $html = view('theme::blocks.footer-brand', ['settings' => ['name' => 'فروشگاه پارسی', 'description' => 'خرید مطمئن']])->render();
    expect($html)->toContain('theme-footer-brand')->toContain('فروشگاه پارسی')->toContain('خرید مطمئن');
});

it('renders grouped footer links', function () {
    $html = view('theme::blocks.footer-links', ['settings' => ['groups' => [['title' => 'راهنما', 'links' => [['label' => 'تماس', 'url' => '/contact']]]]]])->render();
    expect($html)->toContain('راهنما')->toContain('تماس')->toContain('/contact');
});

it('renders service features and trust badges lazily', function () {
    $services = view('theme::blocks.service-features', ['settings' => ['features' => [['title' => 'ارسال سریع', 'description' => 'سراسر کشور']]]])->render();
    $trust = view('theme::blocks.trust-badges', ['settings' => ['title' => 'اعتماد', 'badges' => [['title' => 'نماد', 'image' => '/trust.png']]]])->render();
    expect($services)->toContain('ارسال سریع')->toContain('سراسر کشور')->and($trust)->toContain('loading="lazy"')->toContain('/trust.png');
});

it('renders newsletter and copyright contracts', function () {
    $newsletter = view('theme::blocks.newsletter', ['settings' => ['title' => 'خبرنامه', 'button_text' => 'عضویت']])->render();
    $copyright = view('theme::blocks.copyright', ['settings' => ['text' => 'فروشگاه پارسی']])->render();
    expect($newsletter)->toContain('theme-newsletter')->toContain('عضویت')->and($copyright)->toContain((string) now()->year)->toContain('فروشگاه پارسی');
});
