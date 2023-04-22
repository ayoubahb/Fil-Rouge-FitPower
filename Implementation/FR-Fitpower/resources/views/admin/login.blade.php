<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen w-screen flex justify-center items-center">
    <form action="{{ route('admin.authenticate') }}" class="max-w-xl w-full p-10 bg-thirdColor text-white" method="POST">
        @csrf
        <div class="mb-10">
            <p class="text-4xl font-bold text-center">Admin login</p>
        </div>
        <div class="w-full">
            <label>Email</label>
            <input type="email"
                class="block border-white border-b-2 bg-transparent mt-3 w-full focus:outline-none p-3"
                name="email" />
        </div>
        <div class="w-full mt-8">
            <label>Password</label>
            <input type="password"
                class="block border-white border-b-2 bg-transparent mt-3 w-full focus:outline-none p-3"
                name="password" />
        </div>
        <div class="flex justify-center">
            <button class="py-2 px-14 bg-transparent font-light border mt-8" type="submit">
                Login
            </button>
        </div>
    </form>
</body>

</html>
