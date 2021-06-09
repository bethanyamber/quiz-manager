@extends('layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-start mb-4">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Create Quiz
            </h2>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white shadow px-4 pb-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Details</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        This is where you add the details for your quiz. You will be able to add questions on the next
                        page.
                    </p>
                </div>
                <div class="md:mt-0 md:col-span-2">
                    <form class="space-y-6 -mt-6" action="{{ route('quizzes.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1 flex rounded shadow-sm">
                                <input type="text" name="title" id="title"
                                       class="@error('title') border-red-400 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded rounded-md sm:text-sm border-gray-300"
                                       placeholder="My Quiz">
                            </div>
                            @error('title')
                            <p class="text-red-400 text-xs">{{$message}}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3"
                                          class="@error('description') border-red-400 @enderror shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                          placeholder="A description for my quiz."></textarea>
                            </div>
                            @error('description')
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
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
