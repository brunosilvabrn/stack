@extends('layout.base')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/codemirror.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/xcode.min.css') }}">

    <div class="container m-auto">
        <main class="grid grid-cols-1 lg:grid-cols-1 gap-6 my-12 mx-2 md:mx-12 w-1xl px-2 mx-auto my-5">
            <div class="bg-white shadow rounded-lg p-4 md:p-10">
                <h1 class="text-5xl text-center font-semibold mb-5">{{ $result->title }}</h1>
                <hr class="">
                <div class="my-5">
                    <p class="text-black text-lg font-normal text-neutral-800">{{ $result->description }}</p>
                </div>

                <div class="text-gray-600 text-md font-semibold mb-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="ml-1">
                        {{ $result->user->name }}
                    </span>
                </div>

                <hr>
                <div class="my-4" style="border: 1px solid #e5e7eb;">
                    <pre>
                        <code class="language">
{{ $result->code }}
                        </code>
                    </pre>
                </div>

                <div class="flex justify-end">
                    <button id="btnResp" onclick="responder()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Responder
                    </button>
                </div>


                <div id="boxResp" class="mt-5 hidden">
                    <h2 class="text-center text-2xl font-bold mb-4">Responda a pergunta</h2>
                    <hr>

                    <form class="w-full" method="POST" action="{{ route('answer.create', $result->id) }}">
                        @csrf

                        <label for="message"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Resposta</label>
                        <textarea id="message" name="description" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="Resposta..."></textarea>

                        <div class="w-100">
                            <label for="message"
                                   class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-400">Código</label>
                            <div style="border: 1px solid #e5e7eb;">
<textarea id="codigo" name="code" rows="4"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Seu Código">
</textarea>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <input type="submit" value="Responder"
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 cursor-pointer rounded"></input>
                        </div>

                    </form>
                </div>

                @if ($errors->any() || session('error'))
                    <div class="flex justify-center">
                        <div id="alert" class="mt-4 sm:w-1/4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                                @if(session('error'))
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                @else
                                    @foreach ($errors->all() as $error)
                                        <span class="block sm:inline">{{ $error }}</span><br>
                                    @endforeach
                                @endif
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" onclick="closeAlert()" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                            </div>
                        </div>
                    </div>
                @endif


            </div>

            <div class="bg-white bg-white shadow rounded-lg p-4 lg:p-10 mt-6 rounded-lg">
                <h4 class="font-bold text-4xl text-center">Respostas</h4>
            </div>

            @foreach($answers as $answer)

            <div class="bg-white bg-white shadow rounded-lg p-4 lg:p-10 mt-6 rounded-lg">
                <div class="text-gray-600 text-lg font-semibold mb-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="ml-1">
                        {{ $answer->user->name }}
                    </span>
                </div>

                <hr>

                <p class="text-black text-lg font-normal text-neutral-800 mt-2">{{ $answer->description }}</p>

                @if($answer->code != '')
                <div class="my-4" style="border: 1px solid #e5e7eb;">
                    <pre><code class="language">
{{ $answer->code }}
                        </code></pre>
                </div>
                @endif

                <hr class="my-2">

                <div class="my-4 rounded overflow-hidden flex items-start">
                    <button onclick="like(this)"
                            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded flex mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z"/>
                        </svg>

                        10

                    </button>

                    <button
                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded flex mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384"/>
                        </svg>

                        2
                    </button>
                </div>
            </div>

            @endforeach


        </main>
    </div>

    <script src="{{ asset('js/codemirror.min.js') }}"></script>
    <script src="{{ asset('js/highlight.min.js') }}"></script>

    <script>

        function like() {
            console.log(this);
        }

        hljs.highlightAll();

        let myTextarea = document.getElementById('codigo');

        let editor = CodeMirror.fromTextArea(myTextarea, {
            lineNumbers: true,
            mode: "javascript"
        });

        function responder() {

            let box = document.getElementById('boxResp');
            let button = document.getElementById('btnResp');

            if (box.classList.contains('hidden')) {
                box.classList.remove('hidden');
                button.classList.remove('bg-blue-500');
                button.classList.remove('hover:bg-blue-700');
                button.classList.add('bg-red-500');
                button.classList.add('hover:bg-red-700');
                button.textContent ='Fechar';
            } else {
                button.classList.remove('bg-red-500');
                button.classList.remove('hover:bg-red-700');
                button.classList.add('bg-blue-500');
                button.classList.add('hover:bg-blue-700');
                button.textContent ='Responder';
                box.classList.add('hidden');
            }

        }

        function closeAlert() {
            let alert = document.getElementById("alert");
            alert.remove();
        }

        @if ($errors->any() || session('error'))
            responder();
        @endif

    </script>

@endsection
