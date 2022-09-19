<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

        $questions = Question::all()->where('user_id', Auth::user()->id)->sortDesc();
        $answers = Answer::all()->where('user_id', Auth::user()->id)->sortDesc();

        $dice = [
            'answers' => $answers,
            'questions' => $questions,
            'qtdQuestions' =>  $questions->count(),
            'qtdAnswer' => $answers->count(),
        ];

        return view('profile', $dice);
    }
}
