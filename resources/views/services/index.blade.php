@extends('layouts.app')
@section('content')

        <table  class="table table-bordered mt-5">
            <h2>Список сервисных кодов</h2>
            <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название сервисных кодов</th>
                <th scope="col">Коды сервисных кодов</th>

            </tr>
            </thead>
            <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($codes as $code)
                    <td style="text-align: center">{{ $code->id }}</td>
                    <td>
                        {{$code->name}}
                    </td>

                    <td>
                        {{$code->code}}
                    </td>
            </tr>
            @endforeach

            </tbody>
        </table>

@if(auth()->user()->can('add perms'))
    <a href="{{ route('perms.create') }}" class="btn btn-success btn " tabindex="-1" role="button">Добавить разрешение</a>
@endif


    @section('delete')
        <script>
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var table = button.getAttribute('data-table');
                var id = button.getAttribute('data-id');
                var form = deleteModal.querySelector('form');
                var actionUrl = "{{ url('/') }}/" + table + "/delete/" + id;
                form.setAttribute('action', actionUrl);
            });
        </script>
    @endsection
@endsection
