<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">店舗編集</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <form action="{{ route('shops.update', $shop) }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">店舗名</label>
                <input type="text" id="name" name="name" value="{{ old('name', $shop->name) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" placeholder="必須：店舗名を入力してください">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">住所</label>
                <input type="text" id="address" name="address" value="{{ old('address', $shop->address) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" placeholder="必須：住所を入力してください">
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">説明</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" placeholder="任意：店舗説明を入力してください">{{ old('description', $shop->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
                更新する
            </button>
        </form>
    </div>

</x-app-layout>

