<div class="text-gray-600">
    @role('admin')
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        <div class="bg-slate-50 shadow rounded-lg p-6 row-span-full md:row-span-2 flex flex-col justify-between items-end">
            <div>
                <x-icon name="calendar" class="text-violet-600 w-10 h-10"></x-icon>
                <h2 class="text-3xl font-semibold mb-4">Peminjaman Hari ini</h2>
                <p class="text-6xl font-bold">{{$peminjamanHariIni}}</p>
            </div>
            <button class="text-center mt-6 bg-violet-600 text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-amber-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Masuk (Pengajuan)</h2>
            <p class="text-6xl font-bold">{{ $peminjamanDiajukan }}</p>
            <a href="{{ route('admin.peminjaman') }}" class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></a>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-emerald-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Selesai</h2>
            <p class="text-6xl font-bold">{{ $peminjamanSelesai}}</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-red-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Ditolak</h2>
            <p class="text-6xl font-bold">{{ $peminjamanDitolak}}</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Peminjaman</h2>
            <p class="text-6xl font-bold">{{ $totalPeminjaman}}</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="user-circle" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Users</h2>
            <p class="text-6xl font-bold">{{ \App\Models\User::count() }}</p>
            <a href="{{ route('admin.users') }}" class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></a>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="beaker" solid class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Inventory</h2>
            <p class="text-6xl font-bold">{{ $Inventory}}</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="beaker" solid class="text-red-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Inventory Kosong (OOS)</h2>
            <p class="text-6xl font-bold">{{ $oos }}</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
    </div>
    @endrole
    @role('user')
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        <div class="bg-slate-50 shadow rounded-lg p-6 col-span-full md:col-span-2 lg:col-span-3">
            <x-icon name="calendar" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Aktif</h2>
            <p class="text-6xl font-bold">2</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Peminjaman</h2>
            <p class="text-6xl font-bold">5</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-emerald-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Selesai</h2>
            <p class="text-6xl font-bold">5</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-red-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Ditolak</h2>
            <p class="text-6xl font-bold">5</p>
            <button class="mt-6 bg-violet-600 float-right text-white hover:bg-violet-700 rounded-md py-2 px-4"><x-icon name="arrow-right"></x-icon></button>
        </div>
    </div>
    @endrole
</div>
