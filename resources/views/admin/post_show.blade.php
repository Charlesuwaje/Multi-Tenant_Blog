@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
    <p class="text-gray-600 mb-2">By {{ $post->user->name }} | {{ $post->created_at->format('M d, Y') }}</p>

    <div class="mt-4 p-6 bg-white shadow rounded-lg">
        <p class="text-gray-800 leading-relaxed">
            {{ $post->content }}
        </p>
    </div>
</div>
@endsection
