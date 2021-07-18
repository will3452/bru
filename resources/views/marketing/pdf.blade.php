<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        *{
            z-index: 99;
        }
        table{
            text-align:start;
            width:100%;
            border:1px solid #222;
            border-collapse: collapse;
        }
        td,th{
            border:1px solid #222;
            text-align: left;
            font-size: 12px;
        }
        #id{
            text-align: right;
        }
        h1{
            text-align: center;
            font-size:50px;
        }
        #watermark{
            position: absolute;
            /* transform: rotate(45deg); */
            z-index: 98;
            color: #ddd;
            font-size: 200px;
            width:100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 id="watermark">BRU</h2>
    <div class="d-flex">
        <h1>
            {{ $title }}
        </h1>
        <p id="id">
            #{{ $id }}
        </p>
    </div>
    <table style="">
        <tr>            
            <th>
                Category
            </th>
            <td>
                {{ $category }}
            </td>
        </tr>
        <tr>
            <th>
                Schedule
            </th>
            <td>
                {{ $schedule }}
            </td>
        </tr>
        <tr>
            <th>
                Duration
            </th>
            <td>
                {{ $duration }}
            </td>
        </tr>
        <tr>
            <th>
                Cost
            </th>
            <td>
               PHP {{ number_format($cost, 2) }}
            </td>
        </tr>
    </table>
</body>
</html>