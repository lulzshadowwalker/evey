<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://kit.fontawesome.com/a51f251d24.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    @yield('styles')
</head>

<body>

    <div class="row">
        <div class="sidebar">
            <div class="logo">
                <i class="fa-solid fa-droplet"></i>
            </div>

            @php
            $tabs = [
            [
            'title'=>'Users',
            'icon'=>"fa fa-user-group",
            ],
            [
            'title'=>'Signals',
            'icon'=>"fa-solid fa-tower-broadcast",
            ],
            [
            'title'=>'Inbox',
            'icon'=>"fa-solid fa-inbox",
            ],
            [
            'title'=>'Role Management',
            'icon'=>"fa-solid fa-address-book",
            ],
            ];
            @endphp


            @foreach ($tabs as $tab)
            @php
            $dest = str_replace(' ', '-', strtolower($tab['title']));
            $highlight = $dest == $__env->yieldContent('title') ? 'style=color:white;' : '';
            @endphp
            <div class='tab-item' {{ $highlight }}>
                <a class="nostyle" href=" {{ route('dashboard.'.$dest)  }}  ">
                    <i class="{{ $tab['icon']}}"></i>
                </a>
            </div>
            @endforeach


            <div class="bottom-items">
                <hr style="padding: 0px 8px; border: 2px solid white; border-radius: 30px;">

                <div class='tab-item' {{ 'settings' == $__env->yieldContent('title') ? 'style=color:white;' : '' }}>
                    <a class="nostyle" href=" {{ route('dashboard.settings')  }}  ">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </div>

                <div class='tab-item'>
                    <i class="fa-solid fa-right-from-bracket" onclick="event.preventDefault();document.getElementById('logout-form').submit();"></i>

                    <form id="logout-form" method="POST" action="/logout" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <main class="main">
            @yield('content')
        </main>
    </div>

</body>

</html>