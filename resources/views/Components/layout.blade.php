<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1;
        }

        /* List Reset */
        ul,
        ol {
            list-style: none;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #333;
            height: 50px;
        }

        .container {
            max-width: 1024px;
            width: 100%;
            margin: 0 auto;
        }

        .logo {
            display: inline;
        }

        .logo a {
            color: #ffc078;
            text-decoration: none;
            line-height: 50px;
            font-size: 24px;
        }

        .logo .fa-music {
            color: #ffc078;
            margin-right: 1em;
        }

        /* Menu Styles */
        .menu {
            float: right;
        }

        .menu li {
            float: left;
        }

        .menu a {
            display: flex;
            margin-right: 10px;
            color: #ffc078;
            text-decoration: none;
            line-height: 50px;
            padding: 0 1em;
        }

        .menu a:hover {
            background-color: #ffc078;
            color: #333;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #ffc078;
            padding: 0 1em;
            cursor: pointer;
            line-height: 50px;
            font-size: 16px;
            display: flex;
            align-items: center;
            height: 50px;
            margin: 0;
            font-family: inherit;
        }

        .logout-btn:hover {
            background-color: #ffc078;
            color: #333;
        }

        .logout-form {
            display: inline;
            margin: 0;
            line-height: 0;
        }

        /* Form Styles */
        .form-container {
            padding: 16px;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type=text],
        input[type=password],
        input[type=email],
        input[type=number],
        input[type=date],
        input[type=time],
        select,
        textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #000000;
            color: #ffc078;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            color: white;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Utility Classes */
        .auth-form.active {
            display: block;
        }

        .text-danger {
            color: red;
            margin-top: 5px;
        }

        .bottom-links {
            text-align: center;
            margin-top: 10px;
        }

        .bottom-links a {
            color: #ffc078;
            text-decoration: none;
        }

        .bottom-links a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="container">
            <div class="logo">
                <a href="/">
                    <i class="fas fa-music"></i>{{ $productName }}
                </a>
            </div>

            <ul class="menu">
                <li><a href="/dinbandon">DingBanDon</a></li>
                <li><a href="/meetroom">MeetingRoom</a></li>
                @guest
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
                @endguest
                @auth
                <li>
                    <form method="post" action="/logout" style="display: inline; margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn">'{{ session('username') }}'-out</button>
                    </form>
                </li>
                @endauth
            </ul>

        </div>
    </div>
    {{ $slot }}

</body>

</html>