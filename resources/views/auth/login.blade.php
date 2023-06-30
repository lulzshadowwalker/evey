@extends('layouts.app')

@section('content')
<div class="header">
    <div class="logo">
        <i class="fa-solid fa-droplet"></i>
        <h1>e v e y</h1>
    </div>

    <a style="display:block" href="{{ route('register')  }}">
        <button>Sign up</button>
    </a>
</div>

<div class="row">
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <h1>Welcome back</h1>
                <p>get back on track</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" placeholder="email@example.com" name="email" required />
                <input type="password" placeholder="password" name="password" required />
                <input style="margin-top: 72px;" type="submit" value="Sign in" />

            </form>
        </div>
    </div>

    <img class="cover-image" src="https://i.pinimg.com/564x/ef/ee/51/efee512cc7a7d89ee64f42321a8c8ef5.jpg" alt="image" />
</div>
@endsection