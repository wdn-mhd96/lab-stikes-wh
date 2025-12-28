<div x-data="{ open: $wire.entangle('formOpen') }">
    <div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Manajemen User</h1>
            <button wire:click="openAdd" class="bg-violet-600 text-white hover:bg-violet-700 rounded-md py-2 px-4 text-sm">Tambah User</button>
        </div>
        <div class="mt-3 overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr class="border-b border-gray-300  text-sm {{ $index % 2 !== 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 text-center">{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->username }}</td>
                        <td class="px-4 py-2 flex justify-center gap-2 items-center">
                            <button wire:click="confirmDelete({{ $user->id }})"class="bg-red-600 text-white hover:bg-red-700 rounded-md py-1 px-3 text-sm">Hapus</button>
                            <button wire:click="editUser({{ $user->id }})" class="bg-emerald-600 text-white hover:bg-emerald-700 rounded-md py-1 px-3 text-sm">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                    @if($users->isEmpty())
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center">Tidak ada user ditemukan.</td>
                    </tr>
                    @endif  
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
    <livewire:pages.dashboard.users.form />
</div>
