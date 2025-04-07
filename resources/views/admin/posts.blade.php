@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">All Tenant Posts</h1>

    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" id="search" placeholder="Search posts..." 
               class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
    </div>

    <!-- Posts Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full border-collapse bg-gray-100 rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr class="text-left">
                    <th class="p-3">#</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Author</th>
                    <th class="p-3">Created At</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody id="postsTable">
                @foreach($posts as $index => $post)
                <tr class="border-b">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $post->title }}</td>
                    <td class="p-3">{{ $post->user->name }}</td>
                    <td class="p-3">{{ $post->created_at->format('M d, Y') }}</td>
                    <td class="p-3">
                        <a href="{{ route('posts.show', $post->id) }}" 
                           class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                            View
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($posts->isEmpty())
        <p class="text-gray-500 mt-4">No posts available.</p>
        @endif
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        let searchText = this.value.toLowerCase();
        let rows = document.querySelectorAll('#postsTable tr');

        rows.forEach(row => {
            let title = row.cells[1].textContent.toLowerCase();
            let author = row.cells[2].textContent.toLowerCase();
            row.style.display = (title.includes(searchText) || author.includes(searchText)) ? '' : 'none';
        });
    });
</script>
@endsection
