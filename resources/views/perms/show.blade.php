@extends('layouts.app')
@section('content')
    <h2>Просмотр разрешения</h2>

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" required name="name" value="{{$permission->name}}" class="form-control" placeholder="Введите название роли">
        </div>

@endsection
