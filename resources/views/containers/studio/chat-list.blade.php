@extends('components.head')
@section('sections')
    <x-studios-header></x-studios-header>
@if ($user->role_id == 3)
<main>
    <!-- contacts -->
    <section class="contacts">
        <div class="content">
            <div class="contacts__inline">
                <div class="contacts__main">
                    <div class="contacts__inner">
                        <div class="contacts__title">Ваш менеджер</div>
                        <div class="contacts__name">{{ $manager->name }}</div>
    
                        <div class="contacts__schedule">
                            <div>Режим работы: с 9:00-19:00</div>
                            <div>Сб-Вс: выходной</div>
                        </div>
                    </div>
                    <div class="social">
                        <a href="#" class="social__item">
                            <img src="/img/layout/general/phone.svg" alt="">
                        </a>
                        <a href="#" class="social__item">
                            <img src="/img/layout/general/mail.svg" alt="">
                        </a>
                        <a href="#" class="social__item">
                            <img src="/img/layout/general/tg.svg" alt="">
                        </a>
                    </div>
                </div>
    
                <a href="#popup" class="contacts__btn button button-black">Сделать запрос</a>
                <section id="popup" class="popup">
                    <a href="#" class="popup__area"></a>
                    <div class="popup__body">
                        <div class="popup__contnet">
                            <div class="popup__top">
                                <h2 class="popup__title">Сделать запрос</h2>
                                <a href="#" class="popup__clous">X</a>
                            </div>
                            <div class="popup_contacts">
                                <div class="popup_contacts_info">
                                    <div class="popup_call_us"> 
                                    <form action="" method="POST" autocomplete="off">
                                    @csrf
                                    <a href="" class="account">
                                        <div class="account__img">
                                            <img src="{{ Session::get('user_image') }}" alt="" style=
                                            "border-radius: 50%;
                                            background-color:none;
                                            width: 38px;
                                            height: 38px;">
                                        </div>
                                        <div style="color:white" class="account__person">{{ Session::get('user_name') }}</div>
                                    </a>
                                    <input type="text" name="articul" class="popup__input" placeholder="Введите артикул" id="articul">
                                   <div class="popup-hidden-div">
                                    <div id="popup_image_div" class="popup_image_div"><img src="#" id="popup_image" class="popup_img" /></div>
                                   <div class="popup-inputs-sq">
                                    <input placeholder="Размер" type="number"  name="" id="popup-size"><input type="number" placeholder="Количество" name="" id="popup-quantity">
                                   </div>
                                   </div>
                                    <button type="submit" class="popup__btn">Отправить</button>
                                </form>
                                    </div>
                            <div class="footer__item">
                                <ul class="footer__social">
                                    <li class="footer__subitem"><a class="footer__link" href=""><img src="/icon/telegram.png" alt=""></a></li>
                                    <li class="footer__subitem"><a class="footer__link" href=""><img src="/icon/facebook.png" alt=""></a></li>
                                    <li class="footer__subitem"><a class="footer__link" href=""><img src="/icon/instagram.png" alt=""></a></li>
                                </ul>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <section class="manager">
        <div class="content">
            <div class="top">
                <a href="#" class="top__link ">Запросы</a>
                <a href="#" class="top__link top__active">Чат</a>
            </div>
            <div class="chat">
                @livewire('chat.chat-list')
                <div class="chat_items">
                    @livewire('chat.chatbox')
                </div>
            </div>
        </div>
    </section>
</main>
@else
<section class="info">
    <div class="content">
        <div class="info__list">
            <div class="info__item">
                <div class="info__title">Количество запросов </div>
                <div class="info__value">14/32</div>
            </div>
            <div class="info__item">
                <div class="info__title">Количество студии </div>
                <div class="info__value">32</div>
            </div>
            <div class="info__item">
                <div class="info__title">Количество выполненных обращений </div>
                <div class="info__value">32</div>
            </div>
        </div>
    </div>
</section>
<section class="manager">
    <div class="content">
        <div class="top">
            <a href="#" class="top__link ">Запросы</a>
            <a href="#" class="top__link top__active">Чат</a>
        </div>
        <div class="chat">
            @livewire('chat.chat-list')
            <div class="chat_items">
                @livewire('chat.chatbox')
            </div>
        </div>
    </div>
</section>
@endif


<x-footer></x-footer>
    @endsection