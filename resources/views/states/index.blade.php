@extends('layouts.app')
@section('content')

        <table  class="table table-bordered mt-5">
            <h2>Список штатов</h2>
            <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название штатов</th>
                <th scope="col">Коды штатов</th>
                <th scope="col">Страна</th>

            </tr>
            </thead>
            <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($states as $state)
                    <td style="text-align: center">{{ $state->id }}</td>
                    <td>
                        {{$state->name}}
                    </td>

                    <td>
                        {{$state->state_code}}
                    </td>
                <td>
                    {{ $state->country->name }}
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
