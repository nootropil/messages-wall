<!DOCTYPE html>
<html>
<head>
    <title>Сайтсофт</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}"/>
</head>
<body>

<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Сайтсофт</a>
        <ul class="nav">
            <li class="active"><a href="#">Главная</a></li>
            <li><a href="#">Авторизация</a></li>
            <li><a href="#">Регистрация</a></li>
        </ul>

        <ul class="nav pull-right">
            <li><a>Username</a></li>
            <li><a href="#">Выход</a></li>
        </ul>
    </div>
</div>


<div class="row-fluid">
    @yield('content')
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>