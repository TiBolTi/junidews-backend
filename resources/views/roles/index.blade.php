@extends('layouts.app')

    <h2>Список клиентов</h2>


        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center" scope="col">#</th>
                <th scope="col">Имя клиента</th>
                <th scope="col">Телефон</th>
                <th scope="col">Почта</th>
                <th scope="col" style="text-align: end">Buttons</th>
            </tr>
            </thead>
            <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($roles as $role)

                    <td>{{ $role->name }}</td>

                    <td align="end">
{{--                        <a href="{{ route('clients.show', $client) }}" class="btn btn-success " tabindex="-1"--}}
{{--                           role="button"><i class="fa-solid fa-eye"></i></a>--}}
{{--                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary " tabindex="-1"--}}
{{--                           role="button"><i class="fa-solid fa-pen"></i></a>--}}
{{--                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"--}}
{{--                                data-table="clients" data-id="{{ $client->id }}">--}}
{{--                            <i class="fa-solid fa-trash"></i>--}}
{{--                        </button>--}}

                    </td>
            </tr>
            @endforeach

            </tbody>
        </table>
@if(auth()->user()->can('show roles'))
    <a href="{{ route('roles.create') }}" class="btn btn-success btn " tabindex="-1" role="button">Добавить клиента</a>
@endif


    @section('delete')
        <script>
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var table = button.getAttribute('data-table');
                var id = button.getAttribute('data-id');
                var form = deleteModal.querySelector('form');
                var actionUrl = "{{ url('/') }}/" + table + "/" + id;
                form.setAttribute('action', actionUrl);
            });
        </script>
    @endsection

