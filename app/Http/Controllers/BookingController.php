<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function view($category, $slug)
    {
        $place = Place::where('slug', $slug)->first();
        $booking = Booking::where('date', date('Y-m-d'))
            ->whereRelation('field', 'place_id', $place->id)
            ->get();

        $hari =  Carbon::now()->locale('id')->dayName;
        return view('booking.view', compact('category', 'place', 'booking', 'hari'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'hour' => 'required',
            'fieldId' => 'required',
            'phone_number' => 'required'
        ]);

        $booking = Booking::create([
            'name' => $request->name,
            'date' => date('Y-m-d'),
            'start_at' => $request->hour . ":00",
            'field_id' => $request->fieldId,
            'phone_number' => $request->phone_number
        ]);

        return response()->json(['message' => 'Booking success!']);
    }
}
