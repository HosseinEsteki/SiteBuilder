<!doctype html>
<html lang="fa">

<!-- Mirrored from noonpost.netlify.app/html/template/page404.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2023 15:33:33 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- favicon -->
    <link rel="icon" sizes="16x16" href={{url("theme/noonPost/assets/img/favicon.png")}}>
    <!-- Title -->
    <title> نون پست - قالب وبلاگ شخصی </title>

    <!-- Font Google -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet"> -->

    <!-- CSS Plugins -->
    <link rel="stylesheet" href={{url("theme/noonPost/assets/RTL/css/all.css")}}>
    <link rel="stylesheet" href={{url("theme/noonPost/assets/RTL/css/elegant-font-icons.css")}}>
    <link rel="stylesheet" href={{url("theme/noonPost/assets/RTL/css/bootstrap.min.css")}}>
    <link rel="stylesheet" href={{url("theme/noonPost/assets/RTL/css/owl.carousel.css")}}>

    <!-- main style -->
    <link rel="stylesheet" href={{url("theme/noonPost/assets/RTL/css/style.css")}}>
    <link rel="stylesheet" href={{url("theme/noonPost/assets/RTL/css/custom.css")}}>
</head>
<body dir="rtl">
<!--loading -->
<div class="loading">
    <div class="circle"></div>
</div>
<!--/-->
<!-- Navigation-->
<x-noon-post.header/>
<!--/-->

<!--Content-->
@yield('content')
<!--newslettre-->
<x-noon-post.news-letter/>
<x-noon-post.footer/>
<!--Search-form-->
<div class="search">
    <div class="container-fluid">
        <div class="search-width  text-center">
            <button type="button" class="close">
                <i class="icon_close"></i>
            </button>
            <form class="search-form" action="#">
                <input type="search" value="" placeholder="چه چیزی را جستجو می‌کنید؟">
                <button type="submit" class="search-btn">جستجو</button>
            </form>
        </div>
    </div>
</div>
<!--/-->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src={{url("theme/noonPost/assets/RTL/js/jquery-3.5.0.min.js")}}></script>
<script src={{url("theme/noonPost/assets/RTL/js/popper.min.js")}}></script>
<script src={{url("theme/noonPost/assets/RTL/js/bootstrap.min.js")}}></script>

<!-- JS Plugins  -->
<script src={{url("theme/noonPost/assets/RTL/js/ajax-contact.js")}}></script>
<script src={{url("theme/noonPost/assets/RTL/js/owl.carousel.min.js")}}></script>
<script src={{url("theme/noonPost/assets/RTL/js/switch.js")}}></script>

<!-- JS main  -->
<script src={{url("theme/noonPost/assets/RTL/js/main.js")}}></script>

</body>
</html>
