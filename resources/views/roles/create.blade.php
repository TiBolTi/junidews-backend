@extends('layouts.app')
@section('content')
    <h2>Добавить роль</h2>
    <form class="mb-5" action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" required name="name" class="form-control" placeholder="Введите название роли">
        </div>
        <div class="form-group">
            <label for="name">Права доступа</label>
<div style="max-height: 105px;" class="d-flex flex-wrap flex-column">
        @foreach ($permissions as $permission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->id}}" id="permissions_{{$permission->id}}">
                <label class="form-check-label badge bg-secondary me-1" for="permissions_{{$permission->id}}" >
                    {{$permission->name}}
                </label><br>
            </input>
            </div>
        @endforeach
</div>
        </div>

        <button type="submit" class="btn mt-2 btn-primary">Добавить роль</button>
    </form>
@endsection
