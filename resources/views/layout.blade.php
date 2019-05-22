<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
    <style>
        .is-complete{
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <div class="container" style="width:95%; margin-top:20px;">
        @yield('content')
    </div>
</body>
</html>