<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>BRUMULTIVERSE | PRE-REGISTER</title>
</head>
<body>
<div class="flex w-full md:w-3/5 mx-auto px-2 h-screen justify-center items-center">
    <div class="text-base text-center m-5 p-5 shadow-xl rounded-xl">
        <p class="text-gray-700 mt-4">
            You have now pre-registered an account on the BRUMULTIVERSE App! Thank you so much.
        </p>
        <p class="text-gray-700 mt-4">
            Here is your Account Number <span class="font-bold">{{$aan ?? '1232340234'}}</span>. It has been sent to your registered email as well. Please keep it, as you will use it during BRU App account registration.
        </p>
        <a href="/" class="inline-block uppercase font-bold text-white mt-4 p-2 px-4 rounded-3xl bg-gradient-to-r from-blue-900 to-purple-900">Go Back To Home</a>
    </div>
</div>

</body>
</html>
