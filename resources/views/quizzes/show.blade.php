@extends('layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between mb-4">
        <div class="min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Quiz {{$quiz->id}}
            </h2>
        </div>
        @if(Auth::user()->type === 'restricted')
            <div class="min-w-0">
                <a href="/quizzes/{{$quiz->id}}/create-submission">
                    <button type="button"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Answer Quiz
                    </button>
                </a>
            </div>
        @elseif(Auth::user()->type === 'edit')
            <div class="min-w-0">
                <a href="/quizzes/{{$quiz->id}}/submissions">
                    <button type="button"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        View Submissions
                    </button>
                </a>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">


            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-4 sm:px-6 flex justify-between border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Questions
                    </h3>
                    @if(Auth::user()->type === 'edit' && Auth::user()->id === $quiz->user_id)
                        <a href="/quizzes/{{$quiz->id}}/create-question"
                           class="text-gray-600 hover:text-gray-900 group flex items-center ml-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-400 group-hover:text-gray-500 h-6 w-6"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </a>
                    @endif
                </div>
                @if(count($quiz->questions))
                    <ul class="divide-y divide-gray-200">
                        @foreach($quiz->questions as $question)
                            <li class="px-4 py-4 sm:px-6 flex justify-between">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{$question->title}}</h3>
                                    @if(Auth::user()->type !== 'restricted')
                                        @if($question->options)
                                            <dt class="text-sm font-medium text-gray-500 mt-2">
                                                Options
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{implode(', ',$question->options)}}
                                            </dd>
                                        @endif
                                        <dt class="text-sm font-medium text-gray-500 mt-2">
                                            Answer
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{$question->answer}}
                                        </dd>
                                    @endif
                                </div>
                                <div class="flex">
                                    <div>
                                        <span
                                            class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full capitalize">{{$question->type}}</span>
                                    </div>
                                    @if(Auth::user()->id === $quiz->user_id && Auth::user()->type === 'edit')
                                        <div>
                                            <form action="/questions/{{$question->id}}" method="POST">
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
                                        <div>
                                            <a href="/questions/{{$question->id}}/edit"
                                               class="text-gray-600 hover:text-gray-900 group flex items-center ml-2 text-sm font-medium rounded-md">
                                                <svg class="text-gray-400 group-hover:text-gray-500 h-6 w-6"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-4 py-4 sm:px-6 flex justify-between">
                        This quiz has no questions.
                    </div>
                @endif
            </div>

        </div>

        <div class="grid grid-cols-1 gap-4">
            <section aria-labelledby="quiz-details">
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="px-4 py-4 sm:px-6 flex justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Details
                        </h3>
                        @if(Auth::user()->type === 'edit' && Auth::user()->id === $quiz->user_id)
                            <div class="flex justify-between">
                                <form action="/quizzes/{{$quiz->id}}" method="POST">
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
                                <a href="/quizzes/{{$quiz->id}}/edit"
                                   class="text-gray-600 hover:text-gray-900 group flex items-center ml-2 text-sm font-medium rounded-md">
                                    <svg class="text-gray-400 group-hover:text-gray-500 h-6 w-6"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="px-4 py-3">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Title
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 capitalize sm:mt-0 sm:col-span-2">
                                        {{$quiz->title}}
                                    </dd>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Questions
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{count($quiz->questions)}}
                                    </dd>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Submissions
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{count($quiz->submissions)}}
                                    </dd>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Created By
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$quiz->user->first_name}} {{$quiz->user->last_name}}
                                    </dd>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Created At
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$quiz->created_at_friendly}}
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
