@extends('layouts.app', ['title' => 'Post'])

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg mb-5">
        @auth
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
        @endauth

        @forelse ($posts as $post)
        <x-post :post="$post" />
        @empty
        <div class="bg-red-700 p-3 rounded-lg text-white">
            No post.
        </div>
        @endforelse

        {{ $posts->links() }}
    </div>
</div>
@endsection