<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $event = Event::all();
        $category = Category::all();
        return view('index', [
            'event' => $event,
            'category' => $category
        ]);
    }
}
