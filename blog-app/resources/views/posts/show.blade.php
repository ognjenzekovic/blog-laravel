<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">{{ $post->title }}</h2>
            <div class="flex gap-2">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                @endcan
                @can('delete', $post)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm"
                                onclick="return confirm('Delete this post?')">
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4">

            {{-- Post body --}}
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <p class="text-gray-500 text-sm mb-4">
                    By {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                </p>
                <div class="prose text-gray-800">{{ $post->content }}</div>
            </div>

            {{-- Comments --}}
{{--            <h3 class="text-lg font-semibold mb-4">--}}
{{--                Comments ({{ $post->comments->count() }})--}}
{{--            </h3>--}}

{{--            @forelse($post->comments as $comment)--}}
{{--                <div class="bg-white rounded-lg shadow p-4 mb-3 flex justify-between">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm font-medium text-gray-700">--}}
{{--                            {{ $comment->user?->name ?? 'Guest' }}--}}
{{--                            <span class="text-gray-400 font-normal">--}}
{{--                                · {{ $comment->created_at->diffForHumans() }}--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                        <p class="text-gray-800 mt-1">{{ $comment->comment }}</p>--}}
{{--                    </div>--}}
{{--                    @auth--}}
{{--                        @can('delete', $comment)--}}
{{--                            <form method="POST" action="{{ route('comments.destroy', $comment) }}">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="text-red-500 text-sm hover:underline">Delete</button>--}}
{{--                            </form>--}}
{{--                        @endcan--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <p class="text-gray-500 mb-4">No comments yet.</p>--}}
{{--            @endforelse--}}

            {{-- Add comment form --}}
{{--            <div class="bg-white rounded-lg shadow p-6 mt-6">--}}
{{--                <h4 class="font-semibold mb-3">Leave a Comment</h4>--}}
{{--                <form method="POST" action="{{ route('comments.store', $post) }}">--}}
{{--                    @csrf--}}
{{--                    <textarea name="comment" rows="3" placeholder="Your comment..."--}}
{{--                              class="w-full border rounded p-2 @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>--}}
{{--                    @error('comment')--}}
{{--                    <p class="text-red-500 text-sm">{{ $message }}</p>--}}
{{--                    @enderror--}}
{{--                    <button type="submit"--}}
{{--                            class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">--}}
{{--                        Post Comment--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}

        </div>
    </div>
</x-app-layout>
