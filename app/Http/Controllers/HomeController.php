<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::all()->sortDesc();

        $dice = [
            'questions' => $questions,
        ];

        return view('home', $dice);
    }
}
