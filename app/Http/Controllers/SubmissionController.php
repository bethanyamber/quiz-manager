<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function show($id)
    {
        $submission = Submission::find($id);
        if (Auth::user()->type === 'edit' || Auth::user()->id === $submission->user_id) {
            return view('submissions.show', compact(['submission']));
        }
        return redirect()->route('dashboard');
    }

    public function index()
    {
        $currentUser = Auth::user();

        if ($currentUser->type === 'edit') {
            $submissions = Submission::whereHas('quiz', function ($q) use ($currentUser) {
                $q->where('user_id', $currentUser->id);
            })->orderBy('created_at', 'desc')->get();
            return view('submissions.index', compact(['submissions']));
        } else if ($currentUser->type === 'restricted') {
            $submissions = Submission::where('user_id', $currentUser->id)->orderBy('created_at', 'desc')->get();
            return view('submissions.index', compact(['submissions']));
        }
        return redirect()->route('dashboard');
    }

    public function quizIndex($quizId)
    {
        $currentUser = Auth::user();

        if ($currentUser->type === 'edit' || $currentUser->type === 'view') {
            $submissions = Submission::where('quiz_id', $quizId)->orderBy('created_at', 'desc')->get();
            return view('submissions.index', compact(['submissions']));
        }
        return redirect()->route('dashboard');
    }

    public function create($quizId)
    {
        $quiz = Quiz::with(['questions'])->find($quizId, ['id', 'title', 'user_id']);
        if (Auth::user()->type === 'restricted') {
            return view('submissions.create', compact('quiz'));
        }
        return redirect()->route('dashboard');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $validations = [
            'quiz_id' => 'required|integer|exists:quizzes,id'
        ];
        $questions = [];
        $userAnswers = [];
        $correctAnswers = [];
        $content = [];

        foreach ($data as $key => $datum) {
            if (str_contains($key, 'user_answer_')) {
                $validations[$key] = 'required|string';
                $userAnswers[$key] = $datum;
            } else if (str_contains($key, 'question_')) {
                $questions[$key] = $datum;
            } else if (str_contains($key, 'correct_answer_')) {
                $correctAnswers[$key] = $datum;
            }
        }

        foreach ($questions as $index => $question) {
            $key = str_replace('question_', '', $index);
            array_push($content,
                [
                    'question' => $questions['question_' . $key],
                    'user-answer' => $userAnswers['user_answer_' . $key],
                    'correct-answer' => $correctAnswers['correct_answer_' . $key],
                    'mark' => strtolower($userAnswers['user_answer_' . $key]) === strtolower($correctAnswers['correct_answer_' . $key]),
                ]);
        }

        $data = $request->validate($validations);

        $submission = new Submission;

        $submission->content = $content;

        $quiz = Quiz::find($data['quiz_id']);
        $submission->quiz()->associate($quiz);

        $user = User::find(Auth::user()->id);
        $submission->user()->associate($user);

        $submission->save();

        return redirect()->to("/submissions/" . $submission->id);
    }

    public function destroy(Submission $submission)
    {
        $submission->Delete();

        return redirect()->to('/submissions')
            ->with('success', 'Submission deleted');
    }
}
