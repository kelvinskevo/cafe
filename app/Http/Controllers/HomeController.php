<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Chef;
use App\Models\Special;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $foods;
    protected $chefs;
    protected $breakfast;
    protected $lunch;
    protected $dinner;

    public function __construct()
    {
        $this->foods = Food::all();
        $this->chefs = Chef::all();
        $this->breakfast = Special::where('category', 'breakfast')->get();
        $this->lunch = Special::where('category', 'lunch')->get();
        $this->dinner = Special::where('category', 'dinner')->get();
    }

    public function index()
    {
        // Pass both foods and chefs to the home view
        return view('home')->with([
            'foods' => $this->foods,
            'chefs' => $this->chefs,
            'breakfast' => $this->breakfast,
            'lunch' => $this->lunch,
            'dinner' => $this->dinner
        ]);
    }


    public function redirects()
    {
        $usertype = Auth::user()->usertype;

        // Pass both foods and chefs to the appropriate view based on usertype
        if ($usertype == '1') {
            return view('admin.home')->with([
                'foods' => $this->foods,
                'chefs' => $this->chefs,
                'specials' => $this->specials,
            ]);
        } else {
            return view('home')->with([
                'foods' => $this->foods,
                'chefs' => $this->chefs,
                'specials' => $this->specials
            ]);
        }
    }
}
