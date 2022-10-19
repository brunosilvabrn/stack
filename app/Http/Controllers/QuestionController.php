<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QuestionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $nameCategories = [];

        foreach ($categories as $key => $value) {
            $nameCategories[] = $value->name;
        }

        return view('ask', ['categories' => $nameCategories]);
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

        $slug = Str::slug($request->input('title').' '.mt_rand(10000,99999));

        $create = Question::create([
            'user_id'     => Auth::user()->id,
            'title'       => $request->input('title'),
            'slug'        => $slug,
            'description' => $request->input('description'),
            'code'        => $request->input('code')
        ]);

        if ($create) {
            $questionCreatedId = DB::table('questions')->orderBy('id', 'desc')->first();
            $replaced = Str::replace(['[', '{', '"', '}', ']', '"', "value:"], "" , $request->input('tags'));
            $collection = Str::of($replaced)->explode(',');
            $questionId = $questionCreatedId->id ?? null;

            foreach ($collection as $value)
            {
                $category= Categories::where('name', '=', $value)->first();
                if ($category) {
                    DB::table('question_categories')->insert([
                        'question_id' => $questionId,
                        'category_id' => $category->id
                    ]);
                }
            }

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

            $user = Auth::check() ? User::where('id', Auth::user()->id)->first() : Null;

            $result = [
                'result' => $question,
                'answers' => $answers,
                'user' => $user,
            ];

            return view('question', $result);
        }

        return redirect()->to('/');
    }

    public function search(Request $request)
    {
        $param = $request->input('search');

        $questions = Question::where('title', 'LIKE', '%' . $param . '%')->get();

        $categories = DB::table('categories')->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('question_categories')
                ->whereColumn('question_categories.category_id', 'categories.id');
        })->count();
//        dd($categories);
//
//        $questions = Question::all()->sortDesc();

        $dice = [
            'questions' => $questions,
        ];

        return view('search', $dice);
    }

}
