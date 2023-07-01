<style>
    .header a:hover{
        color: #fff;
    }

</style>
<header class="header">
    <div class="content">
        <div class="header__inline">
            @if ($user->role_id == 3)
            <a href="{{ route('studios.home') }}" class="logo" >
               AR 
            </a>
            @else
            <a href="{{ route('manager.home') }}" class="logo">
                <img src="/img/layout/general/logo.svg" alt="">
            </a>
            @endif
           

            <nav class="nav">
                <ul class="header__list">
                    <li class="header__item " id="link_home">
                        @if ($user->role_id == 3)
                        <a href="{{ route('studios.home') }}">Главная</a>
                        @else
                        <a href="{{ route('manager.home') }}">Главная</a>
                            
                        @endif
                    </li>
                    @if ($user->role_id == 3)
                        @else
                        <li class="header__item" id="link_studios">
                            <a href="/manager/studios">Студии</a>
                        </li>
                            
                        @endif
                    
                </ul>

                <form action="" class="search">
                    <div class="search__input">
                        <input type="text" placeholder="Поиск">
                    </div>
                    <button class="search__btn">
                        <img src="/img/layout/general/search.png" alt="">
                    </button>
                </form>
            </nav>
            <a href="{{ route('dashboard') }}" class="account">
                <div class="account__img">
                    <img src="{{ $user->image }}" alt="" style=
                    "border-radius: 50%;
                    width: 38px;
                    height: 38px;">
                </div>
                <div class="account__person">{{ $user->name }}</div>
            </a>

            <div class="nav-open">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="content">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="{{ route('studios.home') }}">Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#">Запросы</a>
            </li>
        </ul>
    </div>
</div>