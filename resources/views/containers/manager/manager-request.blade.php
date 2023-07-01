@extends('components.head')
@section('sections')

<x-studios-header></x-studios-header>

<main>
    <!-- info -->
    <section class="info">
        <div class="content">
            <div class="info__list">
                <div class="info__item">
                    <div class="info__title">Количество запросов </div>
                    <div class="info__value">{{ count($requests->where("request_status","!=", "Заявка выполнена")) }}/{{ count($requests) }}</div>
                </div>
                <div class="info__item">
                    <div class="info__title">Количество студии </div>
                    <div class="info__value">{{ count($studios) }}</div>
                </div>
                <div class="info__item">
                    <div class="info__title">Количество выполненных обращений </div>
                    <div class="info__value">{{ count($requests->where("request_status", "Заявка выполнена")) }}</div>
                </div>
            </div>
        </div>
    </section>
    <!-- request -->
    <section class="manager">
        <div class="content">
            <div class="top">
                <a href="#" class="top__link top__active">Запросы</a>
                <a href="{{ route('chat') }}" class="top__link">Чат</a>
    
                <div class="top__aside">
                    <div class="load">
                        <div class="load__head">
                            <img src="img/layout/general/load.svg" alt="">
                            Выгрузить
                        </div>
                        <div class="load__drop">
                            <a href="#" class="load__item">пример</a>
                            <a href="#" class="load__item">пример</a>
                            <a href="#" class="load__item">пример</a>
                            <a href="#" class="load__item">пример</a>
                            <a href="#" class="load__item">пример</a>
                        </div>
                    </div>
    
                    <div class="filter">
                        <div class="filter__ico">
                            <img src="/img/layout/general/filter.png" alt="">
                        </div>
                        <form action="/manager/requests" method="GET" class="filter__drop">
                            @csrf
                            <input type="hidden" name="filter" id="filter_input">
                            <a  aria-valuetext="all" class="filter__item">Все</a>
                            <a aria-valuetext="accept" class="filter__item">Резерв подтвержден</a>
                            <a aria-valuetext="dontaccept" class="filter__item">Резерв не подтвержден</a>
                            <a aria-valuetext="canceled" class="filter__item">Заявка отменена</a>
                            <a aria-valuetext="done" class="filter__item">Заявка выполнена</a>
                            <a aria-valuetext="reserv" class="filter__item">В резервации</a>
                            <a aria-valuetext="doing" class="filter__item">Запрос в обработке</a>
                        </form>
                    </div>
                </div>
            </div>
    
            <div class="table">
                <div class="table__wrap">
                    @if (count($requests)>0)
                    @foreach ($requests as $request)
                    @php
                        $film = $films->where("id", $request->film_id)->first();
                        $request_user = $users->where("id", $request->user_id)->first()
                    @endphp
                    <div  class="table__row">
                        <div  class="table__item table__account">
                            <a href="#" class="account">
                                <div class="account__img">
                                    <img style="   
                                    width: 69px;
                                    height: 69px;
                                    flex-shrink: 0;
                                    border-radius: 50%;"
                                     src="{{ $film->image }}" alt="">
                                </div>
                                <div style="color:black;">{{ $request_user->name }}</div>
                            </a>
                        </div>
    
                        <div class="table__item table__product">
                            <div class="product">
                                <div class="product__name">Пленка</div>
                                <div class="product__article">
                                    <div>Артикул:</div>
                                    <div>{{ $film->code }}</div>
                                </div>
                            </div>
                        </div>
    
                        <div class="table__item table__option">
                            <div class="option">
                                <div>Объем:</div>
                                <div>{{ $request->size }}</div>
                            </div>
                        </div>
    
                        <div class="table__item table__status">
                            <div class="status">
                                <div class="status__title">Статус заявки:</div>
                                <div class="status__value status__confirmed">{{ $request->request_status }}</div>
                            </div>
                        </div>
    
                        <div class="table__item table__edit">
                            <a target="_blank" href="/request/{{ $request->id }}" class="edit">
                                <img src="/img/layout/general/edit.svg" alt="">
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <h2>Результат не найден</h2>
                    @endif
                    
                </div>
            </div>
        </div>
    </section>
</main>
<x-footer></x-footer>
    
@endsection