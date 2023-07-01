@extends('layouts.auth')

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

    <img class="cover-image" src="https://images.unsplash.com/photo-1588097281266-310cead47879?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80" alt="image" />
</div>
@endsection