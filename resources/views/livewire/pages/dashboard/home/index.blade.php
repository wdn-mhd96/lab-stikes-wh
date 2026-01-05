<div class="text-gray-600">
    @role('admin')
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        <div class="bg-slate-50 shadow rounded-lg p-6 row-span-full md:row-span-2 flex flex-col justify-between items-end">
            <div>
                <x-icon name="calendar" class="text-violet-600 w-10 h-10"></x-icon>
                <h2 class="text-3xl font-semibold mb-4">Peminjaman Hari ini</h2>
                <p class="text-6xl font-bold">{{$peminjamanHariIni}}</p>
            </div>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-amber-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Masuk (Pengajuan)</h2>
            <p class="text-6xl font-bold">{{ $peminjamanDiajukan }}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-emerald-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Selesai</h2>
            <p class="text-6xl font-bold">{{ $peminjamanSelesai}}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-red-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Ditolak</h2>
            <p class="text-6xl font-bold">{{ $peminjamanDitolak}}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Peminjaman</h2>
            <p class="text-6xl font-bold">{{ $totalPeminjaman}}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="user-circle" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Users</h2>
            <p class="text-6xl font-bold">{{ \App\Models\User::where("role", "user")->count() }}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="beaker" solid class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Inventory</h2>
            <p class="text-6xl font-bold">{{ $Inventory}}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="beaker" solid class="text-red-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Inventory Kosong (OOS)</h2>
            <p class="text-6xl font-bold">{{ $oos }}</p>
        </div>
    </div>
    @endrole
    @role('user')
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        <div class="bg-slate-50 shadow rounded-lg p-6 col-span-full md:col-span-2 lg:col-span-3">
            <x-icon name="calendar" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Aktif</h2>
            <p class="text-6xl font-bold">{{ $peminjamanAktifUser}}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-violet-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Total Peminjaman</h2>
            <p class="text-6xl font-bold">{{ $totalPeminjamanUser }}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-emerald-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Selesai</h2>
            <p class="text-6xl font-bold">{{ $peminjamanSelesaiUser}}</p>
        </div>
        <div class="bg-slate-50 shadow rounded-lg p-6">
            <x-icon name="clipboard-document-list" class="text-red-600 w-10 h-10"></x-icon>
            <h2 class="text-lg font-semibold mb-4">Peminjaman Ditolak</h2>
            <p class="text-6xl font-bold">{{ $peminjamanDitolakUser }}</p>
        </div>
    </div>
    @endrole
</div>
