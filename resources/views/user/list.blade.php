@extends('layouts.main')

@section('title','User : List')

@section('content')
<form class="form" action="{{ route('user-list') }}" method="get">
    <table>
        <tr>
            <td> <label for="term">Search</label> </td>
            <td> <strong class="color">::</strong></td>
            <td> <input type="text" name="term" id="term" value="{{$data['term']}}"> </td>
        </tr>
    </table>
</form>

<div class="actions">

<button class="blue" type="submit">Search</button>

<a href="{{ route('user-list')}}">
    <button class="green">Clear</button>
</a>
</div>
    <a class="link" href="{{ route('user-create-form')}}">New User</a>

<table class="list">
    <tr>
        <th class="mail">E-mail</th>
        <th>Name</th>
        <th>Role</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td class="code"><a href="{{ route('user-detail',['email' => $user['email']]) }}">{{$user['email']}}</a></td>
        <td>{{$user['name']}}</td>
        <td>{{$user['role']}}</td>
    </tr>
    @endforeach
</table>

{{$users->links()}}

@endsection