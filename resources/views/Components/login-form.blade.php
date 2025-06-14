<form id="login-form" class="auth-form" action="/login" method="post">
    @csrf
    <div class="form-container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
    </div>

    <div class="bottom-links">
        @error('login')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</form>