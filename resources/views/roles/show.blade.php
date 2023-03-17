@extends('layouts.app')
@section('content')
    <h2>Просмотр роли</h2>

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" required name="name" value="{{$role->name}}" class="form-control" placeholder="Введите название роли">
        </div>
        <div class="form-group">
            <label for="name">Права доступа</label>
            <div style="max-height: 105px;" class="d-flex flex-wrap flex-column">
                @foreach ($permissions as $permission)

                    <div class="form-check">
                        <label class="form-check-label badge @if($role->hasPermissionTo($permission->name)) bg-primary @endif @if(!$role->hasPermissionTo($permission->name)) bg-secondary @endif  me-1" for="permissions_{{$permission->id}}" >
                            {{$permission->name}}
                        </label><br>

                    </div>
                @endforeach
            </div>
        </div>
@endsection
