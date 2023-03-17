@extends('layouts.app')
@section('content')

    <table class="table table-bordered mt-5">
        <h2>Список Аэропортов</h2>
        <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название Аэропортов</th>
                <th scope="col">Коды Аэропортов</th>
                <th scope="col">Страна</th>

            </tr>
        </thead>
        <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($airports as $airport)
                    <td style="text-align: center">{{ $airport->id }}</td>
                    <td>
                        {{ $airport->name }}
                    </td>

                    <td>
                        {{ $airport->airport_iata }}
                    </td>
                    <td>
                        {{ $airport->country->name }}
                    </td>
            </tr>
            @endforeach

        </tbody>
    </table>




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
