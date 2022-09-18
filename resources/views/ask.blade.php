@extends('layout.base')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/codemirror.min.css') }}" />
    <div class="container m-auto">
        <main class="grid grid-cols-1 lg:grid-cols-1 gap-6 my-12 mx-2 md:mx-12 w-1xl px-2 mx-auto my-5">
            <div class="bg-white shadow mt-6 rounded-lg p-5 w-1xl">
                <h2 class="text-center text-2xl font-bold mb-4">Faça sua pergunta</h2>
                <hr>
                <form class="w-full" method="POST" action="{{ route('ask.create') }}">
                    @csrf

                    <label for="message" class="block my-2 text-sm font-medium text-gray-900 dark:text-gray-400">Título</label>
                    <input type="text" name="title" id="title" minlength="10" class="block mb-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Título"></input>

                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Descrição</label>
                    <textarea id="message" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Detalhes sobre seu poblema ou dúvida..."></textarea>

                    <label for="message" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-400">Código</label>
                    <div style="border: 1px solid #d2d5db;">
                        <textarea id="codigo" name="code" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Seu Código"></textarea>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <input type="submit" value="Enviar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 cursor-pointer rounded"></input>
                    </div>

                </form>
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
            <div class="flex bg-white shadow mt-6 justify-end rounded-lg p-4">

                <ul class="flex items-center justify-center space-x-2">
                    <li class="flex flex-col items-center space-y-2">
                        <a href="{{ route('user.profile') }}"
                            class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">
                            Voltar
                        </a>
                    </li>
                </ul>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/codemirror.min.js') }}"></script>
    <script>
        let myTextarea = document.getElementById('codigo');

        let editor = CodeMirror.fromTextArea(myTextarea, {
            lineNumbers: true,
            mode: "javascript"
        });

        function closeAlert() {
            let alert = document.getElementById("alert");
            alert.remove();
        }
    </script>

@endsection
