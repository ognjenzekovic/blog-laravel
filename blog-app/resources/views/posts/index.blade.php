<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Blog Posts</h2>
            @auth
                <a href="{{ route('posts.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    New Post
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow p-6 mb-4">
                    <h3 class="text-lg font-semibold">
                        <a href="{{ route('posts.show', $post) }}"
                           class="hover:text-indigo-600">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">
                        By {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                    </p>
                    <p class="text-gray-700 mt-3">
                        {{ Str::limit($post->content, 200) }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">No posts yet. Be the first!</p>
            @endforelse

            {{ $posts->links() }} {{-- pagination --}}
        </div>
    </div>
</x-app-layout>
