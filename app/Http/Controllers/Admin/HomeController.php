<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index() {

        $endOfCurrentMonth = Carbon::now()->endOfDay()->endOfMonth();
        $now = Carbon::now();
        $diffInDays = $endOfCurrentMonth->diffInDays($now);
        //dd($now->format('d/m/Y h:i:s'));

        $user = Auth::user();
        return view('admin.home', compact('user', 'diffInDays'));

    }

}
