<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function create(Request $request, $question_id)
    {
        $request->validate([
            'description' => ['required']
        ],[
            'description.required' => 'Preencha o campo de resposta.',
        ]);

        $code = ($request->input('code') == null ? '' : $request->input('code'));

        $create = Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => $question_id,
            'description' => $request->input('description'),
            'code' => $code
        ]);

        if ($create) {
            return redirect()->back();
        }

        return redirect()->back();
    }
}
