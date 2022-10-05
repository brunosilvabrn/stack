<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function create(Request $request, $question_id)
    {
        $request->validate([
            'description' => ['required']
        ],[
            'description.required' => 'Preencha o campo de resposta.',
        ]);

        $code = ($request->input('code') === null ? '' : $request->input('code'));

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

    public function like(Request $request) {

        $idAnswer = $request->input('id_ask');
        $idUser = Auth::user()->id;
        $exists = DB::table('likes')->where('user_id', '=', $idUser)->
                                             where('answer_id', '=', $idAnswer)->count();
        $info = [
            'user_id' => $idUser,
            'answer_id' => $idAnswer
        ];

        if ($exists === 0) {
            Like::create($info);
            $states = 'add';
        }else {
            Like::where($info)->delete();
            $states = 'remove';
        }

        $data = ['like' => $states];
        return response()->json($data);
    }
}
