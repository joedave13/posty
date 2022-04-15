@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('user.profile', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span
        class="text-gray-600 text-sm">{{
        $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>

    <div class="flex items-center">
        @auth
        @if (!$post->likedBy(Auth::user()))
        <form action="{{ route('post.like', $post) }}" method="POST" class="mr-2">
            @csrf
            <button type="submit" class="bg-blue-800 text-white px-3 rounded">
                <i class="fas fa-thumbs-up mr-2"></i>Like
            </button>
        </form>
        @else
        <form action="{{ route('post.unlike', $post) }}" method="POST" class="mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-3 rounded">
                <i class="fas fa-thumbs-down mr-2"></i>Unlike
            </button>
        </form>
        @endif

        @can('delete', $post)
        <form action="{{ route('post.delete', $post) }}" method="POST" class="mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">
                <i class="far fa-trash-can"></i>
            </button>
        </form>
        @endcan
        @endauth

        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
</div>