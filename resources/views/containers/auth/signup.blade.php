@extends('components.head')
@section('sections')

<main>
    <div class="login reg">
        <a href="#" class="logo">
            <img src="img/layout/general/logo-black.svg" alt="">
        </a>

        <div class="login__inner">
            <div class="login__inline">
                <a href="/signin" class="login__link ">Авторизоваться</a>
                <a href="/signup" class="login__link login__active">Регистрация</a>
            </div>

            <div class="group">
                <div class="group__input">
                    <input type="text" placeholder="Имя пользователя">
                </div>
            </div>

            <div class="group">
                <div class="group__input">
                    <input type="text" placeholder="Номер телефона">
                </div>
            </div>

            <div class="group">
                <div class="group__input">
                    <input type="text" placeholder="Электронная почта ">
                </div>
            </div>

            <div class="group">
                <div class="group__input">
                    <input type="text" placeholder="Придумайте пароль">
                </div>
                <div class="group__btn">
                    <img src="img/layout/general/eye.svg" alt="">
                </div>
            </div>

            <div class="group">
                <div class="group__input">
                    <input type="text" placeholder="Повторите пароль">
                </div>
                <div class="group__btn">
                    <img src="img/layout/general/eye.svg" alt="">
                </div>
            </div>

            <button class="login__btn button button-black">Авторизоваться</button>
        </div>
    </div>
</main>

@endsection
@extends('components.footer')
@section('footer')
    
@endsection