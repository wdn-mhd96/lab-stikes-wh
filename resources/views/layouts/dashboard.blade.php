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
        @livewireStyles
        @livewireScripts
    </head>
    <body class="font-sans text-gray-900 antialiased flex justify-start min-h-screen w-full"
        x-data="{ sidebarOpen: false }"
    >
        <livewire:layout.sidebar />
        <div class="min-h-screen pt-6 sm:pt-0 bg-gray-100 w-full">
            <livewire:layout.navigation />

            <div class="m-0 md:m-6  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirm-delete', event => {
                const data = event[0];
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(data.event, {id:data.id} );
                    }
                })
            }),
            Livewire.on('notify', event => {
                const data = event[0];
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    showConfirmButton: false,
                });
            })
            new TomSelect('.tom-select', {
                create: false,
                sortField: {
                    field: 'text',
                    direction: 'asc'
                }
            });
        })


        </script>
    </body>
</html>
