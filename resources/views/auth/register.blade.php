@extends('layouts.app')

@section('content')
<div class="logo">
    <h1>e v e y</h1>
</div>

<div class="row">
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <h1>Welcome back</h1>
                <p>get back on track</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf


                <input type="text" placeholder="your name" required />

                <input type="text" placeholder="email@example.com" required />
                <input type="password" placeholder="password" required />

                <div class="checkbox-container">
                    <input id="isAdmin" type="checkbox" />
                    <label for="isAdmin">admin</label>
                </div>

                <input type="submit" value="Sign up" />
            </form>
        </div>
    </div>
    <img class="cover-image" src="https://i.pinimg.com/564x/ef/ee/51/efee512cc7a7d89ee64f42321a8c8ef5.jpg" alt="image" />
</div>
@endsection