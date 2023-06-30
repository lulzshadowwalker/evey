@extends('layouts.auth')

@section('content')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


<div class="header">
    <div class="logo">
        <i class="fa-solid fa-droplet"></i>
        <h1>e v e y</h1>
    </div>

    <a style="display:block" href="{{ route('login')  }}">
        <button>Sign in</button>
    </a>
</div>

<div class="row">
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <h1>Create an account</h1>
                <p>Let's get you started with your journey</p>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <input id="image-input" name="avatar" type="file" accept="image/*" style="display:none">
                <div id="avatar" class="avatar">
                    <lottie-player style="object-fit:cover;" src="https://assets10.lottiefiles.com/packages/lf20_tp6fqnn5.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                </div>

                <input id="name" type="text" placeholder="Username" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                <input type="text" name="phone" placeholder="07 ⏺⏺⏺ ⏺⏺⏺ ⏺⏺" pattern="[0][7][789][0-9]{7}" required>

                @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif

                <input id="email" type="email" placeholder="email@example.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

                <div class="multi">
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <input id="password-confirm" type="password" placeholder="Confirm password" class="form-control" name="password_confirmation" required>
                </div>
                @if ($errors->has('password'))
                <span>
                    <em style="color:#fabfbf">{{ $errors->first('password') }}</em>
                </span>
                @endif



                <div id="files-container" class="files">
                    <input style="display:none;" type="file" id="file-picker" name="documents[]" multiple>

                    <div class="multi">
                        <i class="fa-solid fa-file"></i>
                        <h4 style="font-weight: 400">Documents</h4>
                    </div>
                </div>

                <input type="submit" value="Sign up" />

            </form>
        </div>
    </div>

    <img class="cover-image" src="https://i.pinimg.com/564x/ef/ee/51/efee512cc7a7d89ee64f42321a8c8ef5.jpg" alt="image" />
</div>

<script>
    let imagePicker = document.querySelector('#image-input');
    let avatar = document.querySelector('#avatar');

    avatar.addEventListener('click', (e) => {
        imagePicker.click();
    });

    imagePicker.addEventListener('change', (e) => {
        var file = e.target.files[0];

        if (file) {
            var reader = new FileReader();


            reader.onload = function() {
                var img = document.createElement('img');

                const size = "78px";
                img.src = reader.result;
                img.style.objectFit = "cover";
                img.style.height = size;
                img.style.width = size;
                img.style.borderRadius = "100%";

                document.getElementById('avatar').innerHTML = '';
                document.getElementById('avatar').appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    });

    let filesContainer = document.querySelector('#files-container');
    let filePicker = document.querySelector('#file-picker');

    filesContainer.addEventListener('click', (e) => {
        filePicker.click();
    });

    filePicker.addEventListener('change', (e) => {
        var files = e.target.files;


        if (files.length > 0) {
            filesContainer.style.backgroundColor = '#9DBEF8D3';
            filesContainer.style.color = 'black';
        }
    });
</script>
@endsection