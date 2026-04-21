<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="mt-1 w-full border rounded p-2 @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" rows="8"
                                  class="mt-1 w-full border rounded p-2 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                        @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                        Publish
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
