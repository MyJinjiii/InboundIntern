<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/87bcf3e0a4.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <link rel="icon" href="https://www.sci.psu.ac.th/wp-content/uploads//2021/06/original-sci-logo-th-01.svg">
    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- BOOTSTRAP -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        .admissionstatus {
            color: #04499b;
            text-align: center;
            font-size: 50px;
            font-family: "PSU Stidti", sans-serif;
            line-height: 1.2;
            /* Adjust line height as needed */
            outline: none;
            width: 80%;
            /* Adjust width as needed */
            margin: 0 auto;
            /* Center horizontally */
        }

        .h1form {
            font-size: 25px;
            color: #04499b;
        }

        .change-btn {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn:hover {
            background-color: #04499b;
            color: #ffffff;
        }

        .form-container {
            display: flex;
            flex-direction: column;

        }

        .change-btnfornav {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
            margin-left: 5%;
            margin-right: 5%;
        }

        .change-btnfornav:hover {
            background-color: #122241;
            color: #ffffff;
            border-color: #122241;
        }

        .modal-backdrop {
            z-index: 1;
        }
    </style>
</head>

<body>
    <div id='rectangle1' class='rectangle1'>
        <div class="container flex items-center justify-between mx-auto text-blue-gray-900">
            <a
                class="mr-4 block cursor-pointer py-1.5 font-sans text-base font-medium leading-relaxed text-inherit antialiased">
                <img style="display: block;margin: auto;cursor: zoom-in;transition: background-color 300ms;"
                    src="{{asset('storage/uploads/announcements/Logo_Subbrand_Faculty-of-Science-Full_EN.png')}}"
                    width="273" height="213">
            </a>
            @if (Route::currentRouteName() == 'status')
                {{ $item->name }}, {{ $item->surname }}
            @elseif (Route::currentRouteName() == 'index')
                @if (Auth::check())
                    @if (Auth::user()->user_type == 'admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <button class="change-btnfornav">Admin Panel</button></a>
                    @endif
                @endif
            @else(Route::currentRouteName() !== 'advisor','allprogram','index')
            @endif
            <div class="hidden lg:block">
                <ul class="flex flex-col gap-2 mt-2 mb-4 lg:mb-0 lg:mt-0 lg:flex-row lg:items-center lg:gap-6">
                    <div class="flex items-center gap-x-1">
                        @if (Auth::check())
                            <a href="{{ route('change') }}">{{ Auth::user()->name }} {{ Auth::user()->surname }}</a>&nbsp;
                            <a href="{{ route('logout') }}"><button class="change-btnfornav">Logout</button></a>
                        @else(Route::currentRouteName() !== 'login')
                            <a href="{{ route('login') }}"><button class="change-btnfornav">Login</button></a>
                        @endif
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            // Remove all .modal-backdrop elements
            document.querySelectorAll('.modal-backdrop').forEach(element => element.remove());

            // Remove the focusin event handler from Bootstrap modals
            $(document).off('focusin.modal');
        });
    </script>
    <br><br><br><br>
    <header>
        @yield('header')<br>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>
