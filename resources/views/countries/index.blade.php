@extends('layouts.app')
@section('content')

    <table class="table table-bordered mt-5">
        <h2>Список стран</h2>
        <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название стран</th>
                <th scope="col">Коды стран</th>

            </tr>
        </thead>
        <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($countries as $country)
                    <td style="text-align: center">{{ $country->id }}</td>
                    <td>
                        {{ $country->name }}
                    </td>

                    <td>
                        {{ $country->iso2 }}
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
