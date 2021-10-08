<head>
    <title>
        payment test
    </title>
</head>

<body>
    <form action="/payment-post" method="POST">
        @csrf
        <input type="email" placeholder="email" name="email" required>
        <input type="number" name="amount" placeholder="amount" required>
        <input type="text" name="description" placeholder="description here">
        <button>pay now</button>
    </form>
</body>
