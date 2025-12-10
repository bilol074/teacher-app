@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 500px; margin: 40px auto; background: #f8f9fa; padding: 25px 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">

        <h1 style="text-align: center; color: #333; margin-bottom: 25px;">✏️ Edit User</h1>

        {{-- Xatoliklarni chiqarish --}}
        @if ($errors->any())
            <div style="background-color: #ffe6e6; color: #cc0000; padding: 10px 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px;">👨‍🏫 User Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 15px;">
            </div>

            {{-- Email --}}
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">📧 User Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 15px;">
            </div>

            {{-- Password --}}
            <div style="margin-bottom: 20px; position: relative;">
                <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px;">🔑 New Password (optional):</label>
                <input type="password" id="password" name="password"
                       style="width: 100%; padding: 10px 40px 10px 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 15px;">

                {{-- Show/hide button --}}
                <button type="button" id="togglePassword"
                        style="position: absolute; right: 10px; top: 38px; border: none; background: transparent; cursor: pointer; font-size: 17px;">
                    👁
                </button>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="role" style="display: block; font-weight: bold; margin-bottom: 5px;">📧 User role:</label>
                <select name="role" id="role" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 15px;">
                        <option value="{{null}}">-</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="text-align: center;">
                <button type="submit"
                        style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">
                    💾 Update
                </button>
            </div>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('users.index') }}" style="text-decoration: none; color: #555;">⬅ Back to list</a>
        </div>
    </div>

    {{-- Parolni ko‘rsatish uchun skript --}}
    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        toggleBtn.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            toggleBtn.textContent = type === 'password' ? '👁' : '🙈';
        });
    </script>
@endsection
