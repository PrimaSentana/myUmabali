@props(['id', 'action', 'title', 'message'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40" onclick="closeModal('{{ $id }}')">
    <div onclick="event.stopPropagation()" class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">
        <h2 class="text-xl font-semibold mb-2">{{ $title }}</h2>
        <p class="text-gray-600 mb-6">{{ $message }}</p>
        <div class="flex gap-3 justify-end items-center">
            <button type="button" onclick="closeModal({{ $id }})" class="px-5 text-slate-800 py-2 border rounded-lg hover:bg-slate-200">
                Batal
            </button>
            <form action="{{ $action }}" method="POST" class="mt-4 px-5 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>