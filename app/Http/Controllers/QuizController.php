<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->get();
        return view('quizzes.index', compact(['quizzes']));
    }

    public function show($id)
    {
        $quiz = Quiz::find($id);
        return view('quizzes.show', compact(['quiz']));
    }

    public function userIndex()
    {
        $quizzes = Quiz::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('quizzes.index', compact(['quizzes']));
    }

    public function create()
    {
        if (Auth::user()->type === 'edit') {
            return view('quizzes.create');
        }
        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $quiz = Quiz::find($id);
        if (Auth::user()->type === 'edit' && Auth::user()->id === $quiz->user_id) {
            return view('quizzes.update', compact(['quiz']));
        }
        return redirect()->route('dashboard');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:20',
            'description' => 'required|string'
        ]);

        $quiz = new Quiz;
        $quiz->title = $data['title'];
        $quiz->description = $data['description'];
        $user = User::find(Auth::user()->id);

        $quiz->user()->associate($user);

        $quiz->save();

        return redirect()->to("/quizzes/" . $quiz->id . "/create-question");
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:quizzes,id',
            'title' => 'required|string|max:20',
            'description' => 'required|string'
        ]);

        $quiz = Quiz::find($data['id']);
        $quiz->title = $data['title'];
        $quiz->description = $data['description'];

        $quiz->save();

        return redirect()->to("/quizzes/" . $quiz->id);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->Delete();

        return redirect()->to('/my-quizzes')
            ->with('success', 'Quiz deleted');
    }
}
