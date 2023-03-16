@extends('layouts.app')
    <h2>Добавить клиента</h2>
    <form action="" method="POST">

        @csrf
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" required name="name" class="form-control" placeholder="Введите имя клиента">
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="number" name="phone" class="form-control" placeholder="Укажите номер телефона">
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" name="email" class="form-control" placeholder="Укажите почту">
        </div>

        <button type="submit" class="btn mt-2 btn-primary">Добавить запись</button>
    </form>

