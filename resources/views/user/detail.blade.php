@extends('layouts.main')

@section('title','User : View')

@section('content')

<nav>
    <a href="{{ session()->get('bookmark.user-detail', route('user-list'))}}"> &lt; Back</a>
    @can('update', \App\Models\User::class)
    <a href="{{ route('user-update-form',['email' => $user['email']])}}">Update</a>
    @endcan

    @can('delete', \App\Models\User::class)
    <a href="{{ route('user-delete',['email' => $user['email']]) }}">Delete</a>
    @endcan
</nav>

<table>
    <tr>
        <td><strong>E-mail</strong></td>
        <td><strong class="color">::</strong></td>
        <td>{{$user['email']}}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td><strong class="color">::</strong></td>
        <td class="name">{{$user['name']}}</td>
    </tr>
    <tr>
        <td><strong>Role</strong></td>
        <td><strong class="color">::</strong></td>
        <td>{{$user['role']}}</td>
    </tr>
</table>

@endsection