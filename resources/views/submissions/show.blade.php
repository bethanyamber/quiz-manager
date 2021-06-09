@extends('layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between mb-4">
        <div class="min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Submission {{$submission->id}}
            </h2>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">

            @if(count($submission->content))
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-4 sm:px-6 flex justify-between border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Answers
                        </h3>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach($submission->content as $content)
                            <li class="px-4 py-4 sm:px-6 flex justify-between items-center">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{$content['question']}}
                                    </dt>
                                    <dd class="@if(!$content['mark']) line-through @endif mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$content['user-answer']}}
                                    </dd>
                                    @if(!$content['mark'])
                                        <dd class="text-red-700 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{$content['correct-answer']}}
                                        </dd>
                                    @endif
                                </div>
                                <div>
                                    @if($content['mark'])
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700"
                                             fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-4">
            <section aria-labelledby="quiz-details">
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="px-4 py-4 sm:px-6 flex justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Details
                        </h3>
                        @if(Auth::user()->id === $submission->user_id)
                            <div class="flex justify-between">
                                <form action="/submissions/{{$submission->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-gray-600 hover:text-gray-900 group flex items-center ml-2 text-sm font-medium rounded-md">
                                        <svg class="text-gray-400 group-hover:text-gray-500 h-6 w-6"
                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="px-4 py-3">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Quiz
                                    </dt>
                                    <a href="/quizzes/{{$submission->quiz_id}}">
                                        <dd class="mt-1 text-sm text-gray-900 capitalize sm:mt-0 sm:col-span-2">
                                            {{$submission->quiz->title}}
                                        </dd>
                                    </a>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Submitted By
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$submission->user->first_name}} {{$submission->user->last_name}}
                                    </dd>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Submitted At
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$submission->created_at_friendly}}
                                    </dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

