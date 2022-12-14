<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="https://cdn.worldvectorlogo.com/logos/stack-overflow.svg" alt="logo">
            StackOverSendit
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Crie uma conta
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('user.create')  }}" method="POST" id="formulario">
                    @csrf

                    <div>
                        <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuário</label>
                        <input type="text" name="user" id="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Usuário" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                        <input type="password" name="password" id="senha" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar senha</label>
                        <input type="password" name="passwordConfirm" id="confirmarSenha" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        <div id="boxConfirmarSenha"></div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Criar conta</button>
                    <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
                        Já tem uma conta? <a href="{{ route('user.login')  }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Entrar</a>
                    </p>
                </form>
            </div>
        </div>
        @if ($errors->any() || session('error'))
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
        @endif
    </div>
</section>
<script>

    let form = document.getElementById('formulario');

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        let senha = document.getElementById('senha');
        let confirmarSenha = document.getElementById('confirmarSenha');

        if (senha.value != confirmarSenha.value) {
            let box = document.getElementById('boxConfirmarSenha');

            box.innerHTML = '<p class="text-red-500 text-xs italic">Senha e confirmar senha não correspondem!</p>';
            senha.classList.add('border-red-500');
            confirmarSenha.classList.add('border-red-500');
        }else {
            form.submit();
        }

    });

    function closeAlert() {
        let alert = document.getElementById("alert");
        alert.remove();
    }

</script>
</body>
