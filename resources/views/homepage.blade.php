<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Hello {{ $name }}</h1>
    <p>Welcome to our homepage!</p>

    <h2>Animals List</h2>
    <ul>
        @foreach ($animals as $animal)
            <li>{{ $animal }}</li>
        @endforeach
    </ul>

    <a href="/about">Go to About Page</a>
</body>

</html>
