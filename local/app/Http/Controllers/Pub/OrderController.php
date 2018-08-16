<?php

namespace App\Http\Controllers\Pub;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    function add_order(Request $request)
    {
        $data_order = $request->get('book');

        $user = Auth::user();

        $key = 'ordering:' . $user->id;

        Cache::store('redis')->put($key, $data_order, Book::TIME_ORDER);

        return redirect()->route('info_payment');
    }
}
