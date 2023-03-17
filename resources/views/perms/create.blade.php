@extends('layouts.app')
@section('content')
    <h2>Добавить право</h2>
    <form class="mb-5" action="{{ route('perms.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" required name="name" class="form-control" placeholder="Введите название права">
        </div>

        <button type="submit" class="btn mt-2 btn-primary">Добавить право</button>
    </form>
@endsection
