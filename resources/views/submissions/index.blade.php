@extends('layouts.app')

@section('content')

    <div class="md:flex md:items-center md:justify-start mb-4">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Submissions
            </h2>
        </div>
    </div>

    @if(count($submissions))
        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            @foreach($submissions as $submission)
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-4 h-36">
                        @if(Auth::user()->type === 'restricted')
                            <h3 class="text-gray-900 text-lg font-medium capitalize">{{$submission->quiz->title}}</h3>
                        @else
                            <h3 class="text-gray-900 text-lg font-medium capitalize">{{$submission->user->first_name}} {{$submission->user->last_name}}</h3>
                            <dd class="text-gray-500 text-sm capitalize">{{$submission->quiz->title}}</dd>
                        @endif
                        <dd class="my-2">
                            <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">Submitted: {{$submission->created_at_friendly}}</span>
                        </dd>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="w-0 flex-1 flex">
                                <a href="/submissions/{{$submission->id}}"
                                   class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border-t border-transparent rounded-bl-lg hover:text-gray-500">
                                    <span>View</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
        @endforeach
        <!-- More people... -->
        </ul>
    @endif
@endsection
