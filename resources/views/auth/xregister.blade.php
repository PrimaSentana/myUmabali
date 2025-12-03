<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-white">
            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    <h5 class="text-xl font-medium text-gray-900">Welcome to UmaBali!</h5>
                    <div>
                        {{-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Your Name</label> --}}
                        <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Your Name" required />
                    </div>
                    <div>
                        {{-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Your Name</label> --}}
                        <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Email" required />
                    </div>
                    <div>
                        {{-- <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Your password</label> --}}
                        <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div>
                        {{-- <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Your password</label> --}}
                        <input type="password" name="password" id="password" placeholder="Confirm Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-red-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
                            </div>
                            <label for="remember" class="ms-2 text-sm font-medium text-gray-900">Remember me</label>
                        </div>
                        <a href="#" class="ms-auto text-sm text-[#FF0000] hover:underline ">Lost Password?</a>
                    </div>
                    <button type="submit" class="w-full text-white hover:bg-[#dd0000] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-[#FF0000]">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500">
                    Not registered? <a href="#" class="text-[#FF0000] hover:underline ">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

