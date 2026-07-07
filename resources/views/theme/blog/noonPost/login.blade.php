@extends('theme.blog.noonPost.layouts.app')
@section('content')
    <!--Login-->
    <section class="section pt-55 mb-50">
        <div class="container">
            <div class="sign widget ">
                <div class="section-title">
                    <h5>ورود</h5>
                </div>
                <form action="#" class="sign-form widget-form " method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="نام کاربری*" name="username" value="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="رمز عبور*" name="password" value="">
                    </div>
                    <div class="sign-controls form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                            <label class="custom-control-label" for="rememberMe">مرا به خاطر بسپار</label>
                        </div>
                        <a href="#" class="btn-link  mr-auto">فراموشی رمز عبور؟</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-custom">ورود</button>
                    </div>

                    <p class="form-group text-center">حساب کاربری ندارید؟ <a href="register.html" class="btn-link">یکی
                            بسازید</a></p>

                </form>
            </div>
        </div>
    </section>
@endsection
