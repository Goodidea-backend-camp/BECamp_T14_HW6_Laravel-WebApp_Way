<form id="register-form" class="auth-form" action="/register" method="POST">
    @csrf
    <div class="form-container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="user" value="{{ old('user') }}" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" value="{{ old('password') }}" required>

        <label for="password_confirmation"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="password_confirmation" required>

        <button type="submit">Register</button>
    </div>


    <div class="bottom-links">
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        @error('user')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</form>