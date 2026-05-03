<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Application Management</h2>

        <div class="mb-4">
            <input wire:model.live="search" type="text" placeholder="Search by user email..." class="px-4 py-2 border rounded-lg w-full md:w-1/3">
        </div>

        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Current Step</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($applications as $app)
                    <tr>
                        <td class="px-6 py-4">{{ $app->user->email }}</td>
                        <td class="px-6 py-4">Step {{ $app->current_step }} / 10</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-bold 
                                {{ $app->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ strtoupper($app->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <button wire:click="approve({{ $app->id }})" class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Approve</button>
                            <button wire:click="reject({{ $app->id }})" class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Reject</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>
