@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">

                <h2>PHR-Converter</h2>
                @if (Auth::user())
                    <p>Имя пользователя: {{ Auth::user()->name }}</p>
                    <p>Роль: {{ Auth::user()->getRoleNames()->first() }}</p>
                @endif

                <div class="mt-5">
                    <form action="{{ route('decode.decoder') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Введите запрос</label>


                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="code" id="exampleFormControlInput1"
                                    placeholder="TS1275 J 15OCT 4 LGWYVR HK1 1910 1200+1 332 E 0  ">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary" type="button">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($decoding != null)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <div class="col text-start">
                                    <span>{{ $airline = $decoding['departure_airport'] }}</span><br>
                                    <span class="fs-3 fw-bold">{{ $airline = $decoding['departure_time'] }}</span>
                                    <span>({{ $airline = $decoding['departure_date'] }})</span>
                                </div>
                                <div class="col text-center">
                                    <span>{{ $airline = $decoding['airline'] }}</span>
                                </div>
                                <div class="col text-end">
                                    <span>{{ $airline = $decoding['arrival_airport'] }}</span><br>
                                    <span>({{ $airline = $decoding['arrival_date'] }})</span>
                                    <span class="fs-3 fw-bold">{{ $airline = $decoding['arrival_time'] }}</span>


                                </div>
                            </div>
                            <a href="#" class="btn btn-primary card-text read-more mt-3">Подробнее</a>
                        </div>
                        <div class="card-footer bg-transparent detail-text d-none">
                            <p class="fs-5 fw-bold">{{ $airline = $decoding['departure_airport'] }} ---
                                {{ $airline = $decoding['arrival_airport'] }}
                            </p>
                            <p><span class="fw-bold"> Авиакомпания:</span> {{ $airline = $decoding['airline'] }}</p>


                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="fs-5 fw-bold">{{ $airline = $decoding['departure_time'] }}</span>
                                    <sapn>{{ $airline = $decoding['departure_date'] }} -
                                        {{ $airline = $decoding['week_day'] }}</sapn>
                                </div>

                                <div class="d-flex text-end flex-column">
                                    <p>{{ $airline = $decoding['departure_airport'] }} <span class="fw-bold"> -
                                            Аэропорт</span></p>
                                    <div class="d-flex text-end flex-column">
                                        <span>{{ $airline = $decoding['departure_country'] }} <span class="fw-bold"> -
                                                Страна</span></span>
                                        @if ($airline = $decoding['departure_state'] != null)
                                            <span>{{ $airline = $decoding['departure_state'] }} <span class="fw-bold"> -
                                                    Штат</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="fs-5 fw-bold">{{ $airline = $decoding['arrival_time'] }}</span>
                                    <span>{{ $airline = $decoding['arrival_date'] }} -
                                        {{ $airline = $decoding['arrival_day'] }}</span>
                                </div>

                                <div class="d-flex text-end flex-column">
                                    <p>{{ $airline = $decoding['arrival_airport'] }} <span class="fw-bold"> -
                                            Аэропорт</span></p>
                                    <div class="d-flex text-end flex-column">
                                        <span>{{ $airline = $decoding['arrival_country'] }} <span class="fw-bold"> -
                                                Страна</span></span>
                                        @if ($airline = $decoding['arrival_state'] != null)
                                            <span>{{ $airline = $decoding['arrival_state'] }} <span class="fw-bold"> -
                                                    Штат</span></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p><span class="fw-bold"> Класс бронирования:</span>
                                        {{ $airline = $decoding['class_booking'] }}</p>
                                    <p><span class="fw-bold"> Статус бронирования:</span>
                                        {{ $airline = $decoding['booking_status'] }}</p>
                                    <p><span class="fw-bold"> Зарезервированно мест:</span>
                                        {{ $airline = $decoding['reserved_seats'] }} мест</p>
                                </div>
                                <div>
                                    <p><span class="fw-bold"> Самолёт:</span> {{ $airline = $decoding['plane'] }}</p>
                                    <p><span class="fw-bold"> Осталось мест:</span>
                                        {{ $airline = $decoding['remaining_seats'] }} мест</p>
                                    <p><span class="fw-bold"> Номер рейса:</span>
                                        {{ $airline = $decoding['flight_number'] }}</p>
                                </div>
                            </div>
                            <a href="#" class="btn btn-secondary read-less">Скрыть</a>
                        </div>
                    </div>
                    <div class="container">
                @endif


            </div>
        </div>
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
