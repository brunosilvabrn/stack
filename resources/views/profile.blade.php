@extends('layout.base')

@section('content')

<div class="container m-auto">
    <main class="grid grid-cols-1 lg:grid-cols-1 gap-6 my-12 mx-2 md:mx-12 w-1xl px-2 mx-auto my-5">
        <div class="">
            <div class="bg-white shadow rounded-lg p-10">
                <div class="flex flex-col gap-1 text-center items-center">
                    <img class="h-32 w-32 bg-white p-2 rounded-full shadow mb-4"
                         src="{{ asset('images/user.png') }}"
                         alt="">
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                    <div class="text-sm leading-normal text-gray-400 flex justify-center items-center">
                        <!-- <svg viewBox="0 0 24 24" class="mr-1" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mr-1" width="16"
                             height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                        </svg>

                        {{ Auth::user()->email }}
                    </div>
                </div>
                <div class="flex justify-center items-center gap-2 my-3">
                    <div class="font-semibold text-center mx-4">
                        <p class="text-black">{{ $qtdQuestions }}</p>
                        <span class="text-gray-400">Perguntas</span>
                    </div>
                    <div class="font-semibold text-center mx-4">
                        <p class="text-black">{{ $qtdAnswer }}</p>
                        <span class="text-gray-400">Respostas</span>
                    </div>
                </div>
            </div>

            <div class="flex bg-white shadow mt-6 justify-center rounded-lg p-4">

                <ul class="flex items-center justify-center space-x-2">
                    <!-- Story #1 -->
                    <li class="flex flex-col items-center space-y-2">
                        <button
                            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Editar perfil
                        </button>
                    </li>
                    <li class="flex flex-col items-center space-y-2">
                        <a href="{{ route('ask') }}"
                            class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                            Criar pergunta
                        </a>
                    </li>
                    <li class="flex flex-col items-center space-y-2">
                        <button
                            class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                            Excluir conta
                        </button>
                    </li>
                </ul>
                <div>

                </div>
            </div>

            <div class="bg-white bg-white shadow rounded-lg p-5 lg:p-10 mt-6 rounded-lg">
                <h3 class="text-gray-600 text-sm font-semibold mb-4">Suas perguntas | {{ $qtdQuestions }}</h3>
                <hr>

                @if($qtdQuestions > 0)

                    @foreach($questions as $question)
                        <div class="bg-white my-4 rounded overflow-hidden shadow-md">
                            <div class="px-6 py-4">
                                <div class="font-bold text-2xl mb-2 text-center">{{ $question->title  }}</div>
                                <hr class="my-4">
                                <p class="text-gray-700 text-base">
                                    {{ $question->description }}
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-4 flex justify-between">
                                <a href="{{ route('question.show', $question->slug) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Ver pergunta
                                </a>
                                <button onclick="excluirPergunta({{ $question->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    @endforeach

                @else

                    <div class="my-4 rounded overflow-hidden">
                        <div class="font-bold text-md mb-2 text-center">Nenhuma pergunta</div>
                    </div>

                @endif
            </div>
        </div>

            <div class="bg-white bg-white shadow rounded-lg p-5 lg:p-10 mt-6 rounded-lg">
                <h4 class="font-bold text-xl text-center">Respostas</h4>
                <h3 class="text-gray-600 text-sm font-semibold mb-4">Suas respostas: {{ $qtdAnswer }}</h3>

                <hr class="my-2">

                @if($qtdAnswer > 0)

                    @foreach($answers as $answer)
                        <div class="bg-white my-4 rounded overflow-hidden shadow-md">
                            <div class="px-6 py-4">
                                <div class="font-bold text-2xl mb-2 text-center">{{ $answer->question->title }}</div>
                                <hr class="my-2">
                                <p class="text-gray-700 text-base">{{ $answer->description }}</p>
                            </div>
                            <div class="px-6 pt-4 pb-4 flex justify-between">
                                <a href="{{ route('question.show', $answer->question->slug) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Ver resposta
                                </a>
                                <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Excluir
                                </a>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="my-4 rounded overflow-hidden">
                        <div class="font-bold text-md mb-2 text-center">Nenhuma resposta</div>
                    </div>
                @endif

                <template id="deletePergunta">
                    <swal-title>
                        Deseja realemte excluír essa pergunta?
                    </swal-title>
                    <swal-icon type="warning" color="red"></swal-icon>
                    <swal-button type="confirm" color="red">
                        Excluir
                    </swal-button>
                    <swal-button type="cancel">
                        Cancel
                    </swal-button>
                    <swal-param name="allowEscapeKey" value="false" />
                    <swal-param
                        name="customClass"
                        value='{ "popup": "my-popup" }' />
                </template>
            </div>
    </main>
</div>

    <script>

        function excluirPergunta(id) {
            Swal.fire({
                template: '#deletePergunta'
            })

        }

    </script>

@endsection
