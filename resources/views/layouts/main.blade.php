<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Frumbledingle - @yield('page_title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron:700&display=swap" />
    <style type="text/css">
        #app-container {
            margin: auto;
            width: 1024px;
        }

        .logo {
            color: #121889;
            font-family: 'Orbitron';
            font-size: 4em;
            margin-top: 20px;
            text-align: center;
            text-shadow: #999 4px 4px 8px;
        }
        
        .m-t-20{
            margin-top: 20px;
        }
    </style>
    @yield('page_style')
</head>

<body>
    <div id="app-container">
        <div class="logo"><i class="fa fa-object-group"></i> Frumbledingle Corp</div>
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/locations">Locations</a></li>
                <li class="nav-item"><a class="nav-link" href="/items">Items</a></li>
                <li class="nav-item"><a class="nav-link" href="/categories">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="/report">Report</a></li>
            </ul>
        </nav>
        @yield('content')
    </div>
    <script src=" {{ elixir('js/app.js') }}"></script>
</body>

</html>