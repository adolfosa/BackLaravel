<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif

        <style>
            body {
                background-color: #F5F5F5;
                color: #333;
                font-family: 'Instrument Sans', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                text-align: center;
            }

            header {
                width: 100%;
                max-width: 480px;
                margin-bottom: 40px;
            }

            nav {
                display: flex;
                justify-content: center;
                gap: 20px;
            }

            a {
                display: inline-block;
                padding: 12px 25px;
                font-size: 1rem;
                border-radius: 8px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            /* Estilo para los enlaces de login y register */
            .login-btn {
                background-color: #4CAF50;
                color: white;
                border: 2px solid #4CAF50;
            }

            .login-btn:hover {
                background-color: white;
                color: #4CAF50;
                border-color: #4CAF50;
                transform: scale(1.05);
            }

            .register-btn {
                background-color: #008CBA;
                color: white;
                border: 2px solid #008CBA;
            }

            .register-btn:hover {
                background-color: white;
                color: #008CBA;
                border-color: #008CBA;
                transform: scale(1.05);
            }

            /* Estilo para el contenedor de la página */
            .container {
                padding: 20px;
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Añadir algo de espacio a los textos */
            h1 {
                font-size: 2rem;
                margin-bottom: 30px;
                color: #333;
            }
        </style>
    </head>
    <body class="bg-[#F5F5F5]">
        <div class="container">
            <header>
                <h1>Bienvenido a Wit</h1>
                @if (Route::has('login'))
                    <nav>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="login-btn">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="login-btn">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="register-btn">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>
        </div>
    </body>
</html>
