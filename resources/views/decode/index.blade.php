@extends('layouts.app')

@section('content')
<div class="container">
{{--{{$sort}}--}}
    <form action="{{ route('decode.decoder') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Заголовок</label>
            <input type="text" class="form-control" name="decode" id="exampleFormControlInput1" placeholder="Введите заголовок ">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection
