<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airports;
use App\Models\ServiceCode;
use App\Models\Planes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;




class DecodeController extends Controller
{
    public function decoder(Request $request)
    {

            $decode = ($request->all('code'));
            $decode = implode($decode);

            $first_word = strtok($decode, " ");
            $number_of_letters = strlen($first_word);

            if ($number_of_letters > 2) {
                $decode = preg_replace('/^(\w{2})/', '$1 ', $decode);
            }

            $decode = preg_replace('/\s+/', ' ', $decode);

            $decode_array = explode(" ", "$decode");

        $validation = Validator::make($request->all(), [
            'code' => 'required|string|max:200',
        ]);

        if (count($decode_array) == 11) {
            $validation->errors()->add('decode_array', 'Указанный вами код содержит ошибки или указан не верно.');
            return response()->json(['status' => 'error', 'message' => $validation->getMessageBag()], 400);
        }
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->getMessageBag()], 400);
        }

        else {
//      airline
            $airline_code = $decode_array[0];
            $airline = Airline::select('name')
                ->where('airlines.airline_iata', '=', $airline_code)
                ->first();
            if ($airline != null) {
                $airline = $airline->getAttribute('name');
            }



//      class_booking
            $class_booking_code = $decode_array[2];
            $class_booking_name = ServiceCode::select('name')
                ->where('service_codes.code', '=', $class_booking_code)
                ->first();
            if ($class_booking_name != null) {
                $class_booking_name = $class_booking_name->getAttribute('name');
            }

//      departure time
            $departure_time = $decode_array[7];

            $departure_time = preg_replace('/(\b\w{2})/', '$1:', $departure_time);


//      arrival time
            $arrival_time = $decode_array[8];

            $arrival_time = preg_replace('/(\b\w{2})/', '$1:', $arrival_time);
            $next_day = substr("$arrival_time", -2);
            if ($next_day == '+1') {
                $arrival_time = substr_replace($arrival_time, '', -2);
            }

//      departure date


            $dateString = $decode_array[3];

            $date = Carbon::createFromFormat('d F', $dateString);
            $departure_date = $date->format('d F');


//      arrival_date
            if ($next_day == '+1') {
                $arrival_date = $date->addDays(1);
                $arrival_date = $arrival_date->format('d F');
            } else {
                $arrival_date = $departure_date;
            }

            //days of week

            $days_of_week = [
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday',
                7 => 'Sunday',
            ];

            $week_day = $days_of_week[$decode_array[4]];


            //airports
            $airports = $decode_array[5];
            $airports = preg_replace('/(\b\w{3})/', '$1 ', $airports);
            $airports = explode(" ", "$airports");

//      departure_airport
            $departure_airport = Airports::select('name')
                ->where('airports.airport_iata', '=', $airports[0])
                ->first();

            if ($departure_airport != null) {
                $departure_airport = $departure_airport->getAttribute('name');
            }

//      arrival_airport
            $arrival_airport = Airports::select('name')
                ->where('airports.airport_iata', '=', $airports[1])
                ->first();

            if ($arrival_airport != null) {
                $arrival_airport = $arrival_airport->getAttribute('name');
            }

            //departure_country
            $departure_country = Airports::select('countries.name')
                ->join('countries', 'airports.country_id', '=', 'countries.id')
                ->where('airports.airport_iata', '=', $airports[0])
                ->first();

            if ($departure_country != null) {
                $departure_country = $departure_country->getAttribute('name');
            }

            //arrival_country
            $arrival_country = Airports::select('countries.name')
                ->join('countries', 'airports.country_id', '=', 'countries.id')
                ->where('airports.airport_iata', '=', $airports[1])
                ->first();

            if ($arrival_country != null) {
                $arrival_country = $arrival_country->getAttribute('name');
            }

            //departure_state
            $departure_state = Airports::select('states.name')
                ->join('states', 'airports.state_id', '=', 'states.id')
                ->where('airports.airport_iata', '=', $airports[0])
                ->first();

            if ($departure_state != null) {
                $departure_state = $departure_state->getAttribute('name');
            }

            //$arrival_state

            $arrival_state = Airports::select('states.name')
                ->join('states', 'airports.state_id', '=', 'states.id')
                ->where('airports.airport_iata', '=', $airports[1])
                ->first();

            if ($arrival_state != null) {
                $arrival_state = $arrival_state->getAttribute('name');
            }

//       booking status
            $booking_status = $decode_array[6];
            $booking_status = preg_replace('/(\b\w{2})/', '$1 ', $booking_status);
            $booking_status = explode(" ", "$booking_status");

            $reserved_seats = $booking_status[1];

            $booking_status = ServiceCode::select('name')
                ->where('service_codes.code', '=', $booking_status[0])
                ->first();

            if ($booking_status != null) {
                $booking_status = $booking_status->getAttribute('name');
            }

//      plane
            $plane = $decode_array[9];

            $plane = Planes::select('name')
                ->where('planes.iata', '=', $plane)
                ->first();

            if ($plane != null) {
                $plane = $plane->getAttribute('name');
            }

//      Remaining seats
            $remaining_seats = $decode_array[11];

            $ordinary_user= ['airline' => $airline,
                'flight_number' => $decode_array[0] . ' ' . $decode_array[1],
                'class_booking' => $class_booking_name,
                'departure_time' => $departure_time,
                'arrival_time' => $arrival_time,
                'departure_date' => $departure_date,
                'arrival_date' => $arrival_date,
                'week_day' => $week_day,
                'departure_airport' => $departure_airport,
                'arrival_airport' => $arrival_airport,
                'departure_country' => $departure_country,
                'arrival_country' => $arrival_country,
                'departure_state' => $departure_state,
                'arrival_state' => $arrival_state];


            $auth_user = [
                'plane' => $plane,
                'reserved_seats' => $reserved_seats,
                'booking_status' => $booking_status,
                'remaining_seats' => $remaining_seats];

            if (auth()->check() && auth()->user()->role('user')) {
                $response =  $auth_user;
            } else {
                $response = $ordinary_user;
            }

            return response()->json($response, 200);

        }
    }
}
