@extends('layouts.main')

@section('title','User : Update')

@section('content')
<form class="form" action="{{ route('user-update',['email' => $user['email']]) }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>E-mail</strong></td>
        <td>::</td>
        <td><input type="text" name="email" value="{{ old('email', $user->email)}}" required></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>::</td>
        <td><input type="text" name="name" value="{{ old('name', $user->name)}}" required></td>
    </tr> 
    <tr>
        <td><strong>Password</strong></td>
        <td>::</td>
        <td><input type="text" name="password" ></td>
    </tr>
    <tr>
        <td><strong>Role</strong></td>
        <td>::</td>
        <td><input type="text" name="role" value="{{ old('role', $user->role)}}" required></td>
    </tr>
</table>

<div class="actions">
    <button type="submit">Update</button>
</div>
</form>
@endsection