<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>@yield('title')</title>
</head>
<body>
        <nav>
            <img class="img" src="/images/logo.png" alt="">
            <div>
                <ul>
                    <li>Home</li>
                    <li>Posts</li>
                    <li>Users</li>
                    <li>Admins</li>
                    @can('AdminUser', App\Models\User::class)
                        <li><a class="li_a" href="{{route('get.admin.index')}}">category/Tag</a></li>
                    @endcan
                </ul>
            </div>
            <a class="btn btn-outline-dark" href="{{route('logout')}}">Logout</a>
        </nav>
        <div>
            @yield('content')
        </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js">
</body>
</html>