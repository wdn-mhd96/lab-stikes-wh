<div   class="w-[300px] bg-white z-50 top-0 left-0 min-h-screen text-slate-600 transition-all duration-300 ease-in-out p-6 fixed md:static
                "    
        :class="sidebarOpen == true ? 'ml-0 md:-ml-[300px]' : '-ml-[300px] md:ml-0'">
    <div class="mb-8">
        <a href="/" wire:navigate>
            <img src="{{ asset('assets/images/static/logo-stikes.svg')}}" alt="" class="h-[80px] m-auto mb-3">
        </a>
        <span class="block text-center font-bold text-lg mb-3">E-LAB TERPADU</span>
        <span class="block text-center font-bold text-md mb-3">STIKES WIJAYA HUSADA</span>
        <x-icon name="x-circle" class="absolute top-4 right-4 md:hidden text-gray-600" @click="sidebarOpen = false" />
    </div>
    <nav class="space-y-4">
        <a href="/dashboard" wire:navigate class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->is('dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
            Dashboard
        </a>
        @role('admin')
        <a href="" wire:navigate class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->is('admin.users') ? 'bg-gray-100 font-semibold' : '' }}">
            List Peminjaman
        </a>
        <a href="{{ route('admin.users') }}" wire:navigate class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.users') ? 'bg-gray-100 font-semibold' : '' }}">
            Users
        </a>
        <a href="{{ route('admin.inventory') }}" wire:navigate class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.inventory') ? 'bg-gray-100 font-semibold' : '' }}">
            Inventory
        </a>
        {{-- <a href="" wire:navigate class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100">
        Ruangan
        </a> --}}
        @endrole
        @role('user')
        <a href="{{ route('user.peminjaman') }}" wire:navigate class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('user.peminjaman') ? 'bg-gray-100 font-semibold' : '' }}">
            Pinjam Alat
        </a>
        @endrole
    </nav>
</div>
