@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    <!-- Pending User Approvals -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Pending Approvals</h2>

        <table class="w-full border-collapse bg-gray-100 rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr class="text-left">
                    <th class="p-3">#</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr class="border-b">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">
                        <form action="{{ route('admin.approveUser', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Approve
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($users->isEmpty())
        <p class="text-gray-500 mt-4">No pending approvals.</p>
        @endif
    </div>
</div>
@endsection
