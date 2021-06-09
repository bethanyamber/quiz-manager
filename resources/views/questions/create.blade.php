@extends('layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between mb-4">
        <div class="min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Create Questions for '{{$quiz->title}}'
            </h2>
        </div>
        <div class="min-w-0">
            <a href="/quizzes/{{$quiz->id}}">
                <button type="button"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    View Quiz
                </button>
            </a>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white shadow px-4 pb-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Questions</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        This is where you add a question to your quiz.
                    </p>
                </div>
                <div class="md:mt-0 md:col-span-2">
                    <form class="space-y-6 -mt-6" action="{{ route('questions.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1 flex rounded shadow-sm">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                       class="@error('title') border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300">
                            </div>
                            @error('title')
                            <p class="text-red-400 text-xs">{{$message}}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                Question Type
                            </label>
                            <div class="mt-1 flex rounded shadow-sm">
                                <select id="type" name="type" autocomplete="type" required
                                        class="@error('type') border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300">
                                    <option value="text" {{ old('type') === 'text' ? 'selected' : null }}>Text</option>
                                    <option value="textarea" {{ old('type') === 'textarea' ? 'selected' : null }}>Text
                                        Area
                                    </option>
                                    <option value="select" {{ old('type') === 'select' ? 'selected' : null }}>Multiple
                                        Choice
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="answer" class="block text-sm font-medium text-gray-700">
                                Answer
                            </label>
                            <div class="mt-1 flex rounded shadow-sm">
                                <input type="text" name="answer" id="answer" value="{{ old('answer') }}" required
                                       class="@error('answer') border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300">
                            </div>
                            <p id="multiple-choice-info" style="display: none" class="@error('answer') text-red-400 @enderror mt-2 text-sm text-gray-500">Your answer must be within
                                the options written below</p>
                            @error('answer')
                            <p class="text-red-400 text-xs">{{$message}}</p>
                            @enderror
                        </div>

                        <div id="options" style="display: none">
                            <label for="options" class="block text-sm font-medium text-gray-700">
                                Options
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <textarea name="options" id="options" rows="5"
                                          class="@error('options') border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300"
                                          placeholder="">{{ old('options') }}</textarea>
                                <p class="mt-2 text-sm text-gray-500">Write each option on a separate line</p>
                            </div>
                            @error('options')
                            <p class="text-red-400 text-xs">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ URL::route('quizzes.index') }}">
                                <button type="button"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </button>
                            </a>
                            <button type="submit"
                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    @if(count($quiz->questions))
        <div class="bg-white shadow overflow-hidden sm:rounded-md mt-4">
            <ul class="divide-y divide-gray-200">
                @foreach($quiz->questions as $question)
                    <li class="px-4 py-4 sm:px-6 flex justify-between">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{$question->title}}</h3>
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
                        </div>
                        <div>
                            <dd>
                                <span
                                    class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full capitalize">{{$question->type}}</span>
                            </dd>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
