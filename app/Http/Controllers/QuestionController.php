<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        return view('ask');
    }

    public function create (Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => ['required']
        ],[
            'title.required' => 'Preencha o campo de título',
            'description.required' => 'Preencha o campo de descrição.',
        ]);

        $slug = $this->slugUrl($request->input('title')).'-'.mt_rand(10000,99999);

        $create = Question::create([
            'user_id'     => Auth::user()->id,
            'title'       => $request->input('title'),
            'slug'        => $slug,
            'description' => $request->input('description'),
            'code'        => $request->input('code')
        ]);

        if ($create) {
            return redirect(route('question.show', $slug));
        }

        return redirect(route('ask'));
    }

    public function show($slug)
    {
        $question = Question::find($slug);

        if ($question) {
            $id = $question->id;
            $answers = Answer::all()->where('question_id', $id);

            $result = [
                'result' => $question,
                'answers' => $answers,
            ];

            return view('question', $result);
        }

        return redirect()->to('/');
    }

    private function slugUrl($text, string $divider = '-') : string
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);

        return (!empty($text) ? $text : false);
    }
}
