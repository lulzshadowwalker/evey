@extends('layouts.dashboard')

@section('title', 'users')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection

@section('content')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<div class="main">
    @can('create')
    <div id="fab" class="floating-action-button">
        <i class="fa-solid fa-plus"></i>
    </div>
    @endcan

    <table class="styled-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Roles</th>
                <th>Documents</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr @can('update', $user) onclick="handleUpdateDialog({{ $user->id }})" @endcan class={{ $user->id === Auth::user()->id ? 'active-row' : '' }}>
                <td class=" multi">
                    <img class="smol-avatar" src="{{ asset('storage/' . $user['avatar']) }}" alt="user avatar" />
                    {{ $user->name  }}
                </td>
                <td>{{ $user->email  }}</td>
                <td>{{ $user->phone }}</td>
                <td class="multi">
                    @foreach($user->roles as $role)
                    <div class="role-chip">
                        {{ $role->title }}
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($user->documents as $doc)
                    <a class="limited-text" href={{ asset('storage/' . $doc->path) }} download={{ $doc->title }}> {{ $doc->title  }}</a><br>
                    @endforeach
                </td>

                <td>
                    @can('delete')
                    <form method="POST" action="{{ route('api.users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')

                        <button class="display-on-hover" type="submit" name="submit" style="flex-grow: 1; background-color: #F7475FCB">
                            <i class="fa-solid fa-trash" style="font-size: 12px"></i>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach($users as $user)
<dialog id="{{ 'update-form-' . $user->id  }}">
    <form method="POST" action="{{ route('api.users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <input class="image-input" name="avatar" type="file" accept="image/*" style="display:none">
        <div id="avatar" class="avatar">
            <img src="{{ asset('storage/' . $user['avatar']) }}" style="object-fit: cover; height: 82px; width: 82px; border-radius: 100%;">
        </div>

        <input id="name" type="text" placeholder="Username" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
        <input type="text" name="phone" placeholder="07 ⏺⏺⏺ ⏺⏺⏺ ⏺⏺" pattern="[0][7][789][0-9]{7}" value={{ $user->phone }} required>

        @if ($errors->has('name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif

        <input id="email" type="email" placeholder="email@example.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

        @if ($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

        <div class="multi">
            <input id="password" type="password" placeholder="Password" name="password">
        </div>

        <div class="files files-container">
            <input style="display:none;" type="file" class="file-picker" name="documents[]" multiple>

            <div class="multi">
                <i class="fa-solid fa-file"></i>
                <h4 style="font-weight: 400">Documents</h4>
            </div>
        </div>

        <input type="submit" value="Save" />
    </form>
</dialog>
@endforeach

<dialog id="user-dialog" class="dialog">
    <form method="POST" action="{{ route('api.users.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <input class="image-input" name="avatar" type="file" accept="image/*" style="display:none">
        <div class="avatar">
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



        <div class="files files-container" class="files">
            <input style="display:none;" type="file" class="file-picker" name="documents[]" multiple>

            <div class="multi">
                <i class="fa-solid fa-file"></i>
                <h4 style="font-weight: 400">Documents</h4>
            </div>
        </div>

        <input type="submit" value="Create User" />

    </form>
</dialog>

<script>
    const fab = document.querySelector("#fab");

    fab.addEventListener("click", () => {
        const dialog = document.getElementById("user-dialog");
        handleUserDialog(dialog);
    });

    function handleUpdateDialog(userId) {
        const dialog = document.getElementById('update-form-' + userId);
        handleUserDialog(dialog);
    }

    function handleUserDialog(dialog) {

        let imagePicker = dialog.querySelector('.image-input');
        let avatar = dialog.querySelector('.avatar');

        avatar.addEventListener('click', (e) => {
            imagePicker.click();
        });

        imagePicker.addEventListener('change', (e) => {
            var file = e.target.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    var img = document.createElement('img');

                    const size = "82px";
                    img.src = reader.result;
                    img.style.objectFit = "cover";
                    img.style.height = size;
                    img.style.width = size;
                    img.style.borderRadius = "100%";

                    avatar.innerHTML = '';
                    avatar.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });

        let filesContainer = dialog.querySelector('.files-container');
        let filePicker = dialog.querySelector('.file-picker');

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

        dialog.showModal();
    }
</script>
@endsection