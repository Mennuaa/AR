@extends('components.head')
@section('sections')

<x-studios-header></x-studios-header>
@if(session('successChange'))

            <div class="alert alert-success mt-2" role="alert">
                      {{  session()->pull('successChange')}}
                    </div>
                    <script>
                    let error = document.querySelector('.alert-success');
                    setTimeout(() => {
                        error.style.display = 'none';
                    }, 3000);

                </script>
@endif
<form action="/request/{{ $request->id }}" method="POST">
@csrf
@method("PUT")
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Пленка</th>
            <th scope="col">Размер</th>
            <th scope="col center" style="text-align:center;">Статус</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $request_user->name }}</td>
            <td><img style="width: 150px;height:100px;border-radius:10px;" src="{{ $film->image }}" alt=""></td>
            <td>{{ $request->size }} м²</td>
            <td class="text-center">
                <select @if ($request->request_status == "Заявка выполнена")
                          disabled
                        @endif 
                        @if ($user->role_id != 2)
                        disabled
                        @endif
                        name="selected"
                        id="mySelect"
                        style="padding: 5px 10px;border-radius:10px;">
                    <option name="accept" value="accept">Резерв подтвержден</option>
                    <option name="dontaccept" value="dontaccept">Резерв не подтвержден</option>
                    <option name="canceled" value="canceled">Заявка отменена</option>
                    <option name="done" value="done">Заявка выполнена</option>
                    <option value="reserv" name="reserv">В резервации</option>
                    <option value="status" selected>{{ $request->request_status }}</option>
                 </select>
            </td>
            <td><button type="submit" class="btn btn-success">Сохрaнить</button></td>
        </tr>
          <tr>
        </tbody>
    </table>
</form>

<x-footer></x-footer>
<script>

const changeSelected = (e) => {
  const $select = document.querySelector('#mySelect');
  $select.value = 'done'
};

document.querySelector('.changeSelected').addEventListener('click', changeSelected);
</script>
@endsection