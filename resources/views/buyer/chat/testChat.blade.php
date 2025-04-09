<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4 text-center">Chat Room</h2>

        <div id="chat-box" class="h-96 overflow-y-auto p-4 border border-gray-300 rounded-lg bg-gray-50">

            <div class="message mb-3 p-2 bg-gray-100 rounded">
                Hello, how are you?
            </div>

        </div>
    </div>





    <script>
        window.addEventListener('DOMContentLoaded', function() {

            let chatBox = document.getElementById('chat-box');

            window.Echo.channel('messages')
                .listen('TestEvent', (e) => {

                    console.log(e);

                    let messageElement = document.createElement('div');

                    messageElement.classList.add('message', 'mb-3', 'p-2', 'bg-gray-100', 'rounded');
                    messageElement.innerHTML = `${e.message}`;

                    chatBox.appendChild(messageElement);

                    // chatBox.scrollTop = chatBox.scrollHeight;

                    console.log(e);

                });

        });
    </script>

</body>

</html>
