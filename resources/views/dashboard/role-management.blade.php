@extends('layouts.dashboard')

@section('title', 'role-management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection

@section('content')
<div class="main">
    <div id="fab" class="floating-action-button">
        <i class="fa-solid fa-plus"></i>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Assigned to</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($roles as $role)
            <tr onclick="handleUpdateDialog({{ $role->id  }})">
                <td class="multi">
                    <div class="role-chip">
                        {{ $role->title }}
                    </div>
                </td>


                <td>
                    @if($role->id == App\Models\Role::USER)
                    <strong><em>everyone</em></strong>
                    @else
                    @foreach($role->users as $user)
                    <div class="multi">
                        <img class="smol-avatar" src="{{ asset('storage/' . $user['avatar']) }}" alt="user avatar" />
                        {{ $user->name  }}
                    </div>
                    @endforeach
                    @endif
                </td>

                <td>
                    <form method="POST" action="{{ route('api.roles.destroy', $role) }}">
                        @csrf
                        @method('DELETE')

                        <button class="display-on-hover" type="submit" name="submit" style="flex-grow: 1; background-color: #F7475FCB">
                            <i class="fa-solid fa-trash" style="font-size: 12px"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach($roles as $role)
<dialog id="{{ 'role-dialog-' . $role->id  }}" class="dialog">
    <h3>Edit role</h3>

    <form method="POST" action="{{ route('api.roles.update', $role) }}">
        @csrf
        @method('PATCH')

        <input type="text" name="title" placeholder="what do you wanna call it 🤔" value="{{ $role->title }}" required>
        <div class="modal-actions" style="padding-top: 48px">
            <button type="submit" name="submit">Save</button>
        </div>
    </form>
</dialog>
@endforeach

<dialog id="role-dialog" class="dialog">
    <h3>Create a new role</h3>

    <form method="POST" action="{{ route('api.roles.store') }}">
        @csrf

        <input type="text" name="title" placeholder="what do you wanna call it 🤔" required>
        <div class="modal-actions" style="padding-top: 48px">
            <button type="submit" name="submit">Save</button>
        </div>
    </form>
</dialog>

<script>
    const fab = document.querySelector("#fab");
    const createRoleDialog = document.getElementById("role-dialog");

    fab.addEventListener("click", () => {
        createRoleDialog.showModal();
    });

    function handleUpdateDialog(roleId) {
        console.log('here', 'role-dialog-' + roleId);
        const dialog = document.getElementById('role-dialog-' + roleId);
        dialog.showModal();
    }
</script>
@endsection