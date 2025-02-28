@extends('layouts.layout')

@section('title', 'Users List')

@section('content')
    <h2 class="text-center mb-4">Users List</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Full Name</th>
                <th>Middle Initial</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Birthdate</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td><img src="{{ $user['avatar'] }}" alt="Avatar" class="rounded-circle" width="50"></td>
                    <td>{{ $user['details']['full_name'] ?? 'N/A' }}</td>
                    <td>{{ $user['details']['middle_initial'] ?? 'N/A' }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['details']['phone'] ?? $user['phone'] ?? 'N/A' }}</td>
                    <td>{{ $user['details']['birthdate'] ?? $user['birthdate'] ?? 'N/A' }}</td>
                    <td>{{ ucfirst($user['details']['gender'] ?? $user['gender'] ?? 'N/A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
