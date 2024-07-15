<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries
          
            // Your web app's Firebase configuration
            const firebaseConfig = {
              apiKey: "AIzaSyCazzb--He1RagnEJZ8CgVpmkrKl8gbfNY",
              authDomain: "web-app-46412.firebaseapp.com",
              databaseURL: "https://web-app-46412-default-rtdb.firebaseio.com",
              projectId: "web-app-46412",
              storageBucket: "web-app-46412.appspot.com",
              messagingSenderId: "795366578570",
              appId: "1:795366578570:web:d13b97d6ce2f60b5495073"
            };
          
            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
          </script>

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
