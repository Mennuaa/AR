@extends('components.head')
@section('sections')

<x-studios-header></x-studios-header>

<main style="width: 100%;display:flex;justify-content:center;">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Имя</th>
            <th scope="col">Название студии</th>
            <th scope="col">Телефон</th>
            <th scope="col">Время работы</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($studios as $studio)

            @php
                $studio_user = $users->where("id", $studio->studio_id)->first();
                $studio_studio = $studio_users->where("user_id", $studio_user->id)->first()
            @endphp
        <tr>
            <th scope="row">{{ $studio_user->name }}</th>
            <td>{{ $studio_studio->studio_name }}</td>
            <td>{{ $studio_user->phone }}</td>
            <td>{{ $studio_studio->working_time }}</td>
          </tr>
            @endforeach
          
        </tbody>
      </table>
</main>
<x-footer></x-footer>
    
@endsection