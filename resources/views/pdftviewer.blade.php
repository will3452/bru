<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<style>
    body,html {
        margin:0px;
        padding: 0px;
    }
</style>
<body>
    {{-- https://drive.google.com/viewerng/viewer?embedded=true&url --}}
    <iframe style="width:100vw; height:100vh" frameborder="0" allowfullscreen webkitallowfullscreen src='{{ url($url) }}#toolbar=0&view=fitH'></iframe>
</body>
</html>