@extends('layouts.app')

@section('content')

    <div class="flex justify-center mb-24">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Welcome to the Quiz Manager
            </h2>
    </div>

    <div class="flex justify-center">
        @include('svgs.exam')
    </div>



@endsection
