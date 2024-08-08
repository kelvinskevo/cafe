<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Chef;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $foods;

    protected $chefs;

    public function __construct()
    {
        $this->foods = Food::all();
        $this->chefs = Chef::all();
    }

    public function index()
    {
        // Pass both foods and chefs to the home view
        return view('home')->with([
            'foods' => $this->foods,
            'chefs' => $this->chefs
        ]);
    }


    public function redirects()
    {
        $usertype = Auth::user()->usertype;

        // Pass both foods and chefs to the appropriate view based on usertype
        if ($usertype == '1') {
            return view('admin.home')->with([
                'foods' => $this->foods,
                'chefs' => $this->chefs
            ]);
        } else {
            return view('home')->with([
                'foods' => $this->foods,
                'chefs' => $this->chefs
            ]);
        }
    }
}
