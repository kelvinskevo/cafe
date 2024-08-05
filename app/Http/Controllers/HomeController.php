<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $foods;

    public function __construct()
    {
        $this->foods = Food::all();
    }

    public function index()
    {
        return view('home')->with('foods', $this->foods);
    }

    public function redirects()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            return view('admin.home')->with('foods', $this->foods);
        } else {
            return view('home')->with('foods', $this->foods);
        }
    }
}
