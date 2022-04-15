@extends('layouts.app', ['title' => 'Post'])

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ route('post.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body')
                    border-red-500
                @enderror" placeholder="Post Something!"></textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
                    <i class="fas fa-fw fa-plus mr-2"></i>Post
                </button>
            </div>
        </form>

        @forelse ($posts as $post)
        <div class="mb-4">
            <a href="" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{
                $post->created_at->diffForHumans() }}</span>
            <p class="mb-2">{{ $post->body }}</p>

            <div class="flex items-center">
                @auth
                @if (!$post->likedBy(Auth::user()))
                <form action="{{ route('post.like', $post) }}" method="POST" class="mr-1">
                    @csrf
                    <button type="submit" class="bg-blue-800 text-white px-3 rounded">
                        <i class="fas fa-thumbs-up mr-2"></i>Like
                    </button>
                </form>
                @else
                <form action="{{ route('post.unlike', $post) }}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-3 rounded">
                        <i class="fas fa-thumbs-down mr-2"></i>Unlike
                    </button>
                </form>
                @endif
                @endauth

                <span class="ml-2">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
            </div>
        </div>
        @empty
        <div class="bg-red-700 p-3 rounded-lg text-white">
            No Post
        </div>
        @endforelse

        {{ $posts->links() }}
    </div>
</div>
@endsection