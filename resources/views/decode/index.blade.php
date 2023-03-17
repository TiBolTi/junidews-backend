@extends('layouts.app')

@section('content')
    {{$decoding = null}}
@if($decoding != [])
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Заголовок краткого текста</h5>
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div>
                    <p>departure_airport: {{$airline = $decoding['departure_airport']}}</p>
                    <p>departure_time: {{$airline = $decoding['departure_time']}}</p>
                    <p>departure_date: {{$airline = $decoding['departure_date']}}</p>
                </div>
                <div><p>Airline: {{$airline = $decoding['airline']}}</p></div>
                <div>
                    <p>arrival_airport: {{$airline = $decoding['arrival_airport']}}</p>
                    <p>arrival_time: {{$airline = $decoding['arrival_time']}}</p>
                    <p>arrival_date: {{$airline = $decoding['arrival_date']}}</p>

                </div>
            </div>
            <a href="#" class="btn btn-primary card-text read-more">Подробнее</a>
        </div>
        <div class="card-footer detail-text d-none">
            <p>Полный текст, который появится при нажатии на кнопку "Подробнее"</p>
            <a href="#" class="btn btn-secondary read-less">Скрыть</a>
        </div>
    </div>
    <div class="container">
        <p>Entered data: </p>
        <p>Airline: {{$airline = $decoding['airline']}}</p>
        <p>flight_number: {{$airline = $decoding['flight_number']}}</p>
        <p>class_booking: {{$airline = $decoding['class_booking']}}</p>
        <p>departure_time: {{$airline = $decoding['departure_time']}}</p>
        <p>arrival_time: {{$airline = $decoding['arrival_time']}}</p>
        <p>departure_date: {{$airline = $decoding['departure_date']}}</p>
        <p>arrival_date: {{$airline = $decoding['arrival_date']}}</p>
        <p>week_day: {{$airline = $decoding['week_day']}}</p>
        <p>departure_airport: {{$airline = $decoding['departure_airport']}}</p>
        <p>arrival_airport: {{$airline = $decoding['arrival_airport']}}</p>
        <p>departure_country: {{$airline = $decoding['departure_country']}}</p>
        <p>arrival_country: {{$airline = $decoding['arrival_country']}}</p>
        <p>departure_state: {{$airline = $decoding['departure_state']}}</p>
        <p>arrival_state: {{$airline = $decoding['arrival_state']}}</p>
        <p>plane: {{$airline = $decoding['plane']}}</p>
        <p>booking_status: {{$airline = $decoding['booking_status']}}</p>
        <p>reserved_seats: {{$airline = $decoding['reserved_seats']}}</p>
        <p>remaining_seats: {{$airline = $decoding['remaining_seats']}}</p>
        @endif
    <form action="{{ route('decode.decoder') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Заголовок</label>
            <input type="text" class="form-control" name="code" id="exampleFormControlInput1" placeholder="Введите заголовок ">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
    <script>
        $(document).ready(function() {
            // При нажатии на кнопку "Подробнее"
            $('.read-more').on('click', function(event) {
                event.preventDefault();
                // Скрываем краткий текст и показываем полный
                $(this).closest('.card').find('.card-text').addClass('d-none');
                $(this).closest('.card').find('.detail-text').removeClass('d-none');
            });

            // При нажатии на кнопку "Скрыть"
            $('.read-less').on('click', function(event) {
                event.preventDefault();
                // Скрываем полный текст и показываем краткий
                $(this).closest('.card').find('.card-text').removeClass('d-none');
                $(this).closest('.card').find('.detail-text').addClass('d-none');
            });
        });
    </script>
@endsection
