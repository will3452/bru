<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/test" method="POST">
        @csrf
        <div>
            Enter Email
            <input type="email" name="email">
        </div>
        <div>
            Enter Value
            <input type="number" name="value">
        </div>
        <div>
            <button>
                Submit
            </button>
        </div>
    </form>
    @if (isset($success))
        Added!
    @endif
</body>
</html>