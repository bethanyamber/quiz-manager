@extends('layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-start mb-4">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{$quiz->title}}
            </h2>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white shadow px-4 pb-5 sm:rounded-lg sm:p-6">
            <form class="space-y-6 -mt-6" action="{{ route('submissions.store') }}" method="POST">
                <input type="hidden" name="quiz_id" value="{{$quiz->id}}"/>
                @csrf
                @foreach($quiz->questions as $index => $question)
                    <input type="hidden" name="question_{{$index}}" value="{{$question->title}}"/>
                    <input type="hidden" name="correct_answer_{{$index}}" value="{{$question->answer}}"/>
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{$question->title}}
                        </label>
                        @if($question->type === 'text')
                            <div class="mt-1 flex rounded shadow-sm">
                                <input type="text" name="user_answer_{{$index}}" id="user_answer_{{$index}}" required
                                       class="@error('user_answer_'.$index) border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300">
                                @error('user_answer_'.$index)
                                <p class="text-red-400 text-xs">{{$message}}</p>
                                @enderror
                            </div> <!-- input -->
                        @elseif($question->type === 'select')
                            <div class="mt-1 flex rounded shadow-sm">
                                <select required id="type" name="user_answer_{{$index}}" autocomplete="user_answer_{{$index}}"
                                        class="@error('user_answer_'.$index) border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300">
                                    <option value="" selected disabled hidden>Choose an option</option>
                                    @foreach($question->options as $option)
                                        <option
                                            value="{{$option}}" {{ old('user_answer_'.$index) === $option ? 'selected' : null }}>{{$option}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_answer_'.$index)
                                <p class="text-red-400 text-xs">{{$message}}</p>
                                @enderror
                            </div> <!-- select -->
                        @else
                            <div class="mt-1 flex rounded shadow-sm">
                            <textarea name="user_answer_{{$index}}" id="user_answer_{{$index}}" rows="5" required
                                      class="@error('user_answer_'.$index) border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300"
                                      placeholder="">{{ old('user_answer_'.$index) }}</textarea>
                                @error('answer_'.$index)
                                <p class="text-red-400 text-xs">{{$message}}</p>
                                @enderror
                            </div> <!-- textarea -->
                        @endif
                    </div>
                @endforeach

                <div class="flex justify-end">
                    <a href="{{ URL::route('submissions.index') }}">
                        <button type="button"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                    </a>
                    <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </form>

        </div>


    </div>

@endsection
