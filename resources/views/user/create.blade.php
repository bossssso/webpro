@extends('layouts.main')

@section('title','User : Create')

@section('content')
<form class="form" action="{{ route('user-create') }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>E-mail</strong></td>
        <td><strong class="color">::</strong></td>
        <td><input type="text" name="email" id="" value="{{ old('email')}}" required></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td><strong class="color">::</strong></td>
        <td><input type="text" name="name" value="{{ old('name')}}" required></td>
    </tr> 
    <tr>
        <td><strong>Password</strong></td>
        <td><strong class="color">::</strong></td>
        <td><input type="text" name="password" value="{{ old('password')}}" required></td>
    </tr>
    <tr>
        <td><strong>Role</strong></td>
        <td><strong class="color">::</strong></td>
        <td>
        <select name="role" required>
            <option   option>--Please select--</option>
            @foreach($roles as $role)
                <option value="{{$role}}">{{$role}}</option>
            @endforeach
         </select>
        </td>
    </tr> 
</table>

<div class="actions">
    <button type="submit">Create</button>
</div>

</form>
@endsection