<title>Infinit SAMS</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Infinit School Information Management System">
<meta name="author" content="Infinit Solutions">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap');

    * {
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f5f5f5;
    }

    .login-container {
        display: flex;
        height: 100vh;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
    }

    .login-card {
        display: flex;
        width: 1000px;
        height: 500px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        background: #fff;
    }

    .login-left,
    .login-right {
        width: 50%;
    }

    .login-left {
        background: url('{{ asset('css/schoolLogin.jpg') }}') no-repeat center center;
        background-size: cover;
    }

    .login-right {
        background-color: #fff;
        padding: 100px 30px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: stretch;
    }

    .logo-img {
        width: 500px;
        height: 115px;
        margin: 0 auto 20px auto;
        margin-bottom: 20px;
        margin-top: -100px;
        margin-left: -30px;
        object-fit: contain;
    }

    .login-title {
        font-size: 1.5rem;
        font-weight: 500;
        color: #757575;
        margin-bottom: 8px;
        text-align: center;
    }

    .login-subtitle {
        font-size: 0.85rem;
        color: #757575;
        margin-bottom: 30px;
        text-align: left;
        letter-spacing: 0px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .form-group {
        width: 100%;
        margin-bottom: 10px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: #757575;
        font-size: 1rem;
    }

    .form-control {
        font-size: 1.05rem;
        padding: 12px 16px;
        width: 100%;
        color: #888;
        border: 1px solid #ddd;
        outline: none;
        transition: border-color 0.3s ease;
        border-radius: 3px;
    }


    .form-control:focus {
        border-color: #888;
    }

    .btn-login {
        background-color: #313131;
        color: white;
        font-size: 1.05rem;
        padding: 12px 0;
        border-radius: 3px;
        width: 100%;
        margin-top: 10px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #000;
    }

    .forgot-link {
        color: #ff6600;
        display: block;
        margin-top: 18px;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .alert {
        font-size: 0.95rem;
        padding: 10px;
        width: 93%;
        text-align: center;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    @media screen and (max-width: 768px) {
    .login-card {
        flex-direction: column;
        width: 95%;
        height: auto;
    }

    .login-left {
        width: 100%;
        height: 300px;
    }

    .login-right {
        width: 100%;
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: stretch;
    }

    .logo-img {
        width: 100%;
        max-width: 900px;
        height: auto;
        margin: 0 auto 20px auto;
        object-fit: contain;
    }

    .form-control,
    .alert {
        width: 100%;
    }
}
</style>