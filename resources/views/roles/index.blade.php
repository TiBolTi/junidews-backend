@extends('layouts.app')
@section('content')




    <table class="table table-bordered mt-5">
        <h2>Список ролей</h2>
        <thead>
            <tr>
                <th style="text-align: center; width: 4%;" scope="col">#</th>
                <th scope="col">Название роли</th>
                <th scope="col">Права доступа</th>
            </tr>
        </thead>
        <tbody style="vertical-align: middle;">
            <tr>
                @foreach ($roles as $role)
                    <td style="text-align: center">{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td class="d-flex align-items-center justify-content-between">
                        @if ($role->permissions->isEmpty())
                            Права отсутсвуют
                        @else
                            <div class="w-100">
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-primary me-1">{{ $permission->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="dropdown dropstart">
                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="">
                                <li><a href="{{ route('roles.show', $role) }}" class="btn dropdown-item" tabindex="-1"
                                        role="button">
                                        <i class="fa-solid fa-eye"></i> Просмотр</a></li>
                                @if (auth()->user()->can('edit roles'))
                                    <li>
                                        <a href="{{ route('roles.edit', $role) }}" class="btn dropdown-item"
                                            id="{{ $role->id }}" tabindex="-1" role="button">
                                            <i class="fa-solid fa-pen"></i> Изменить</a>
                                    </li>
                                @endif
                                @if (auth()->user()->can('delete roles'))
                                    <li>
                                        <button class="btn dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-table="roles" data-id="{{ $role->id }}">
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
    @if (auth()->user()->can('add roles'))
        <a href="{{ route('roles.create') }}" class="btn btn-success btn " tabindex="-1" role="button">Добавить роль</a>
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
