@extends('layouts.app')
@section('content')
    <h2>Обновить разрешение</h2>
    <form class="mb-5" action="{{route('perms.update', $permission)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" required name="name" value="{{$permission->name}}" class="form-control" placeholder="Введите название разрешения">
        </div>

        <button type="submit" class="btn mt-2 btn-primary">Обновить разрешение</button>
    </form>
@endsection
