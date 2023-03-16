<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use App\Models\Airports;
use App\Models\ServiceCodes;
use App\Models\Planes;
use DB;
//use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DecodeController extends Controller
{
    public function index()
    {
        return view('decode.index');
    }

    public function decoder(Request $request)
    {

        $decode = ($request->all('decode'));
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


//      airline
            $airline_code = $decode_array[0];
            $airline = Airline::select('name')
                ->where('airlines.airline_iata', '=', $airline_code)
                ->first();
            if ($airline != null) {
                $airline = $airline->getAttribute('name');
            }


////      class_booking
//            $class_booking_code = $decode_array[2];
//            $class_booking_name = ServiceCodes::select('name')
//                ->where('service_codes.code', '=', $class_booking_code)
//                ->first();
//            if ($class_booking_name != null) {
//                $class_booking_name = $class_booking_name->getAttribute('name');
//            }

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
                ->where('airports.airport_iata_code', '=', $airports[0])
                ->first();

            if ($departure_airport != null) {
                $departure_airport = $departure_airport->getAttribute('name');
            }

//      arrival_airport
            $arrival_airport = Airports::select('name')
                ->where('airports.airport_iata_code', '=', $airports[1])
                ->first();

            if ($arrival_airport != null) {
                $arrival_airport = $arrival_airport->getAttribute('name');
            }

            //departure_country
            $departure_country = Airports::select('country_name')
                ->where('airports.airport_iata_code', '=', $airports[0])
                ->first();

            if ($departure_country != null) {
                $departure_country = $departure_country->getAttribute('country_name');
            }

            //arrival_country
            $arrival_country = Airports::select('country_name')
                ->where('airports.airport_iata_code', '=', $airports[1])
                ->first();

            if ($arrival_country != null) {
                $arrival_country = $arrival_country->getAttribute('country_name');
            }

            //departure_state
            $departure_state = Airports::select('states.name')
                ->join('states', 'airports.state_code', '=', 'states.state_code')
                ->where('airports.airport_iata_code', '=', $airports[0])
                ->first();

            if ($departure_state != null) {
                $departure_state = $departure_state->getAttribute('name');
            }

            //$arrival_state

            $arrival_state = Airports::select('states.name')
                ->join('states', 'airports.state_code', '=', 'states.state_code')
                ->where('airports.airport_iata_code', '=', $airports[1])
                ->first();

            if ($arrival_state != null) {
                $arrival_state = $arrival_state->getAttribute('name');
            }

//       booking status
            $booking_status = $decode_array[6];
            $booking_status = preg_replace('/(\b\w{2})/', '$1 ', $booking_status);
            $booking_status = explode(" ", "$booking_status");

            $reserved_seats = $booking_status[1];

//            $booking_status = ServiceCodes::select('name')
//                ->where('service_codes.code', '=', $booking_status[0])
//                ->first();
//
//            if ($booking_status != null) {
//                $booking_status = $booking_status->getAttribute('name');
//            }

//      plane
            $plane = $decode_array[9];

            $plane = Planes::select('name')
                ->where('planes.code_iata', '=', $plane)
                ->first();

            if ($plane != null) {
                $plane = $plane->getAttribute('name');
            }

//      Remaining seats
            $remaining_seats = $decode_array[11];

            $ordinary_user = ['airline' => $airline,
                'flight_number' => $decode_array[0] . ' ' . $decode_array[1],
//                'class_booking' => $class_booking_name,
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
                'arrival_state' => $arrival_state,
                'plane' => $plane,
                'reserved_seats' => $reserved_seats,
                'booking_status' => $booking_status,
                'remaining_seats' => $remaining_seats];

            $response = $ordinary_user;

            dd($decode, $decode_array, $ordinary_user);
            return view('binarysaerch.show', compact('sort_result', 'numbers'));
        }
    }
