@extends('layout.base')

@section('content')

    <div class="px-2 sm:p-x2">
    <div class="container m-auto ">
        <div class="bg-white rounded overflow-hidden shadow-md p-3 m-4">
            <div>
                @include('layout.form_search_question')
                <hr class="my-2">
                @if(Auth::check())
                    <div class="mt-2 flex justify-between">
                        <a href="{{ route('ask') }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Perguntar</a>
                        <a href="{{ route('user.profile') }}" type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Visualizar perfil</a>
                    </div>
                @else
                    <div class="mt-2 flex justify-center">
                        <a href="{{ route('user.login') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Realizar login</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container m-auto mt-4">

        @foreach($questions as $question)

        <div class="bg-white rounded overflow-hidden shadow-md m-4">
            <div class="px-6 py-4">
                <div class="font-semibold text-4xl mb-2 text-center">{{ $question->title }}</div>
                <div class="flex my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="ml-1 font-medium">
                    {{ $question->user->name }}
                    </span>
                </div>
                <hr class="my-2">
                <p class="text-base mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ $question->description }}
                </p>

                <div class="pt-4">
                    @foreach($question->categories as $category)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $category->category->name }}</span>
                    @endforeach
                </div>

                <div class="flex my-2">
                    <span class="float-right text-sm font-semibold text-gray-700">
                        @php
                            echo str_replace(' ', ' ás ', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $question->created_at)->format('d/m/Y H:i'));
                        @endphp
                    </span>
                </div>

                <hr class="my-2">

                <div class="flex justify-end mt-2">
                    <a href="{{ route('question.show', $question->slug) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Ver pergunta
                        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        @endforeach
    </div>
@endsection
