@component('mail::message')
# Your post was received new like

{{ $user->name }} liked your post.

@component('mail::button', ['url' => route('post.show', $post)])
View Post
@endcomponent

{{ config('app.name') }}
@endcomponent