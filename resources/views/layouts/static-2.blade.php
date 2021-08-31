<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRUMULTIVERSE | Home</title>
    <link rel="stylesheet" href="/css/static.generic.css">
    <link rel="stylesheet" href="/css/about.css">
</head>
<body>
    @yield('content')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const xx = document.querySelector('#xx');
        let count = 0;
        xx.addEventListener('click', function(){
            count++;
            if(count >= 3){
                window.location.href = '/admin/login';
            }
        })
    });
</script>
@include('partials.cookies-alert')
</body>
</html>