@extends('layouts.app')
@section('content')

    <table class="table table-bordered mt-5">
        <h2>Список разрешений</h2>
        <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название разрешения</th>

            </tr>
        </thead>
        <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($permissions as $permission)
                    <td style="text-align: center">{{ $permission->id }}</td>
                    <td class="d-flex align-items-center justify-content-between">

                        <span class="badge bg-primary me-1">{{ $permission->name }}</span>

                        <div class="dropdown dropstart">
                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="">
                                <li><a href="{{ route('perms.show', $permission) }}" class="btn dropdown-item"
                                        tabindex="-1" role="button">
                                        <i class="fa-solid fa-eye"></i> Просмотр</a></li>
                                @if (auth()->user()->can('edit perms'))
                                    <li>
                                        <a href="{{ route('perms.edit', $permission) }}" class="btn dropdown-item"
                                            id="{{ $permission->id }}" tabindex="-1" role="button">
                                            <i class="fa-solid fa-pen"></i> Изменить</a>
                                    </li>
                                @endif
                                @if (auth()->user()->can('delete perms'))
                                    <li>
                                        <button class="btn dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-table="perms"
                                            data-id="{{ $permission->id }}">
                                            <i class="fa-solid fa-trash"></i> Удалить
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    @if (auth()->user()->can('add perms'))
        <a href="{{ route('perms.create') }}" class="btn btn-success btn " tabindex="-1" role="button">Добавить
            разрешение</a>
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
