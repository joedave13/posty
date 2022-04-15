@extends('layouts.app', ['title' => 'User Profile'])

@section('content')
<div class="flex justify-center">
    <div class="w-8/12">
        <div class="p-6">
            <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
            <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{
                $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}.</p>
        </div>

        <div class="bg-white p-6 rounded-lg">
            @forelse ($posts as $post)
            <x-post :post="$post" />
            @empty
            <div class="bg-red-700 p-3 rounded-lg text-white mt-3">
                {{ $user->name }} does not have any post.
            </div>
            @endforelse
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection