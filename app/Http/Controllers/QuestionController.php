<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function create($quizId)
    {
        $quiz = Quiz::with(['questions'])->find($quizId, ['id', 'title', 'user_id']);
        if (Auth::user()->type === 'edit' && $quiz->user_id === Auth::user()->id) {
            return view('questions.create', compact('quiz'));
        }
        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $question = Question::with(['quiz'])->find($id);
        if (Auth::user()->type === 'edit' && $question->quiz->user_id === Auth::user()->id) {
            return view('questions.update', compact('question'));
        }
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'quiz_id' => 'required|integer|exists:quizzes,id',
            'title' => 'required',
            'type' => 'required|in:text,textarea,select',
            'answer' => 'required',
            'options' => 'required_if:type,select',
        ]);

        if ($data['type'] === 'select') {
            $options = preg_replace('~[\r]+~', '', $data['options']);
            $optionsArray = explode("\n", $options);
            $condition = 'in:' . implode(',', $optionsArray);
            $v = Validator::make($data, [
                'answer' => $condition,
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
        }

        $question = new Question;
        $question->title = $data['title'];
        $question->type = $data['type'];
        if ($question->type === 'select' && isset($optionsArray)) {
            $question->options = $optionsArray;
        }
        $question->answer = $data['answer'];
        $quiz = Quiz::find($data['quiz_id']);

        $question->quiz()->associate($quiz);

        $question->save();

        return redirect()->to("/quizzes/" . $quiz->id . "/create-question");
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:questions,id',
            'title' => 'required',
            'type' => 'required|in:text,textarea,select',
            'answer' => 'required',
            'options' => 'required_if:type,select',
        ]);

        if ($data['type'] === 'select') {
            $options = preg_replace('~[\r]+~', '', $data['options']);
            $optionsArray = explode("\n", $options);
            $condition = 'in:' . implode(',', $optionsArray);
            $v = Validator::make($data, [
                'answer' => $condition,
            ]);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
        }

        $question = Question::find($data['id']);
        $question->title = $data['title'];
        $question->type = $data['type'];
        if ($question->type === 'select' && isset($optionsArray)) {
            $question->options = $optionsArray;
        }
        $question->answer = $data['answer'];
        $quiz = Quiz::find($question->quiz_id);

        $question->save();

        return redirect()->to("/quizzes/" . $quiz->id);
    }

    public function destroy(Question $question)
    {
        $quizId = $question->quiz_id;

        $question->Delete();

        return redirect()->to('/quizzes/' . $quizId)
            ->with('success', 'Question deleted');
    }
}
