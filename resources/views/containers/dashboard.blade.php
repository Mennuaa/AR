
@extends('components.head')
@section('sections')
<x-studios-header></x-studios-header>
<main>
    <!-- profile -->
    <section class="profile">
        <form action="/user/{{ $user->id }}" enctype="multipart/form-data" method="POST" class="content" id="changeForm">
            <div class="profile__info">
                <div class="profile__aside">
                    <div class="profile__img">
                        <img src="{{ $user->image }}" alt="">
                    </div>
                    <div class="upload">
                        <label class="upload__label">
                            Выбрать фотографию
                            <input type="file" class="upload__input">
                          </label>  
                    </div>	
                </div>
    
                <div class="profile__main">
                    <div class="profile__title">Ваши данные</div>
                    <div class="profile__inline">
                        <div class="profile__section">
                            <div class="profile__item">
                                <div class="profile__subtitle">Имя пользователя</div>
                                <div class="profile__name">{{ $user->name }}</div>
                            </div>
    
                            <div class="profile__item">
                                <div class="profile__subtitle">Электронная почта</div>
                                <a href="#" class="profile__contact">{{ $user->email }}</a>
                            </div>
                        </div>
                       
                        <div class="profile__section">
                            <div class="profile__item">
                                <div class="profile__subtitle">Роль</div>
                                <a href="#" class="profile__contact">{{ $role }}</a>
                            </div>
    
                            <div class="profile__item"
                            >
                                <div class="profile__subtitle">Номер телефона</div>
                                <a href="#" class="profile__contact">{{ $user->phone }}</a>
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="profile__main">
                </div>
                <div class="profile__logout">
                    <a href="{{ route('logout') }}">Выйти</a>
                </div>
            </div>
            @if(session('profileChangeSuccess'))

            <div class="alert alert-success mt-2" role="alert">
                      {{  session()->pull('profileChangeSuccess')}}
                    </div>
                    <script>
                    let error = document.querySelector('.alert-success');
                    setTimeout(() => {
                        error.style.display = 'none';
                    }, 3000);

                </script>
        @endif
            <div class="settings">
                @csrf
                @method('PUT')
                <div class="settings__section settings__data">
                    <div class="settings__title">
                        <div class="settings__ico">
                            <img src="/img/layout/general/profile.svg" alt="">
                        </div>
                        Ваши данные
                    </div>
    
                    <div class="group">
                        <a href="#" class="group__edit">Изменить</a>
                        <div class="group__input">
                            <input name="name" type="text" value="{{ $user->name }}">
                        </div>
                    </div>
    
                    <div class="group">
                        <a href="#" class="group__edit">Изменить</a>
                        <div class="group__input">
                            <input name="phone" type="text" value="{{ $user->phone }}">
                        </div>
                    </div>
    
                    <div class="group">
                        <a href="#" class="group__edit">Изменить</a>
                        <div class="group__input">
                            <input readonly name="email"  type="text" value="{{ $user->email }}">
                        </div>
                    </div>
                    @if(session('emailExist'))

                    <div class="alert alert-danger mt-2" role="alert">
                       {{  session()->pull('emailExist')}}
                   </div>
                       <script>
                       let error = document.querySelector('.alert-danger');
                       setTimeout(() => {
                           error.style.display = 'none';
                       }, 3000);

                   </script>
               @endif
                    <button type="submit" class="settings__btn button button-black">Сохранить</button>
                </div>
    
                <div class="settings__section">
                    <div class="settings__title">
                        <div class="settings__ico">
                            <img src="/img/layout/general/lock.svg" alt="">
                        </div>
                        Смена пароля
                    </div>
    
                    <div class="group">
                        <div class="group__input">
                            <input name="prev_password" type="text" placeholder="Пароль">
                        </div>
                        <div class="group__btn">
                            <img src="/img/layout/general/eye.svg" alt="">
                        </div>
                    </div>
                    @if(session('notCorrectPrevPass'))

                            <div class="alert alert-danger mt-2" role="alert">
                                      {{  session()->pull('notCorrectPrevPass')}}
                                    </div>
                                    <script>
                                    let error = document.querySelector('.alert-danger');
                                    setTimeout(() => {
                                        error.style.display = 'none';
                                    }, 3000);

                                </script>
                        @endif
                    <div class="group">
                        <div class="group__input">
                            <input name="password" type="text" placeholder="Новый пароль">
                        </div>
                        <div class="group__btn">
                            <img src="/img/layout/general/eye.svg" alt="">
                        </div>
                    </div>
                    @if(session('notCorrectRePass'))

                    <div class="alert alert-danger mt-2" role="alert">
                              {{  session()->pull('notCorrectRePass')}}
                            </div>
                            <script>
                            let error = document.querySelector('.alert-danger');
                            setTimeout(() => {
                                error.style.display = 'none';
                            }, 3000);

                        </script>
                    @endif
                    <div class="group">
                        <div class="group__input">
                            <input name="re_password" type="text" placeholder="Подтвердите пароль">
                        </div>
                        <div class="group__btn">
                            <img src="/img/layout/general/eye.svg" alt="">
                        </div>
                    </div>
    
                    <button type="submit" class="settings__btn button button-black">Сохранить</button>
                </div>
    
                @if ($user->role_id == 3)
                <div class="settings__section settings__post">
                    <div class="settings__title">
                        <div class="settings__ico">
                            <img src="img/layout/general/profile.svg" alt="">
                        </div>
                        Место работы
                    </div>
    
                    <div class="group">
                        <a href="#" class="group__edit">Изменить</a>
                        <div class="group__input">
                            <input value="{{ $studio_user->address }}" name="address" type="text" placeholder="Ваш адрес">
                        </div>
                    </div>
    
                    <div class="group">
                        <a href="#" class="group__edit">Изменить</a>
                        <div class="group__input">
                            <input value="{{ $studio_user->working_time }}" name="working_time" type="text" placeholder="Время работы">
                        </div>
                    </div>
    
                    <div class="group">
                        <a href="#" class="group__edit">Изменить</a>
                        <div class="group__input">
                            <input value="{{ $studio_user->studio_name }}" name="studio_name" type="text" placeholder="Наименования студии">
                        </div>
                    </div>
    
                    <button class="settings__btn button button-black">Сохранить</button>
                </div>
                @endif
            </form>
        </div>
    </section>
</main>
<x-footer></x-footer>
<script>
const form = document.querySelector('#changeForm');
const imageButton = document.querySelector('.upload__input');
const submitForm = ()=>{
    imageButton.name= "image"
    form.submit()
}
imageButton.addEventListener('change', submitForm)

</script>
@endsection