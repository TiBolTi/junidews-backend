@extends('layouts.app')
@section('content')

        <table  class="table table-bordered mt-5">
            <h2>Список авиялиний</h2>
            <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название Авиялиний</th>
                <th scope="col">Коды Авиялиний</th>

            </tr>
            </thead>
            <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($airlines as $airline)
                    <td style="text-align: center">{{ $airline->id }}</td>
                    <td>
                        {{$airline->name}}
                    </td>

                    <td>
                        {{$airline->airline_iata}}
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
