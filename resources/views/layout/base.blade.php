<!doctype html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StackOverSendit</title>
    <link rel="stylesheet" href="{{ asset('css/flowbite.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-slate-100">

<nav class="bg-white sticky md:relative top-0 z-50 border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900 shadow-lg">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="#" class="flex items-center">
            <img src="{{ asset('svg/logo.svg') }}" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">StackOverSendit</span>
        </a>
        <div class="flex items-center md:order-2">

            @if(Auth::check())
                <span class="mr-2 block text-dark font-semibold text-lg">{{ Auth::user()->name }}</span>
                <button type="button"
                        class="flex bg-white mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom" style="background: #ffffff">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/user.png') }}" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                     id="user-dropdown" data-popper-reference-hidden="" data-popper-escaped=""
                     data-popper-placement="bottom"
                     style="position: absolute; inset: 0 auto auto 0; margin: 0; transform: translate(0px, 606px);">
                    <div class="py-3 px-4">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span
                            class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-1" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('user.profile') }}"
                               class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                               class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#"
                               class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="{{ route('user.logout') }}"
                               class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sair</a>
                        </li>
                    </ul>
                </div>

            @else

                <a type="button" href="{{ route('user.login')  }}"
                   class="flex bg-white mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                   style="background: #ffffff">
                    <span class="sr-only">Entrar</span>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/user.png') }}" alt="user photo">
                </a>

            @endif
            <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
            <ul
                class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('home') }}"
                       class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white"
                       aria-current="page">Home</a>
                </li>
                @if(Auth::check())
                    <li>
                        <a href="{{ route('user.profile') }}"
                           class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('ask') }}"
                           class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Criar pergunta</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<script src="{{ asset('js/flowbite.js') }}"></script>
</body>
