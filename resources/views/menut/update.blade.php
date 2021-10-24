@extends('layouts.main')

@section('title','MenuType : Update')

@section('content')
<form class="form" action="{{ route('menut-update',['code' => $menut['code']]) }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td>::</td>
        <td><input type="text" name="code" value="{{ old('code', $menut->code)}}" required></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>::</td>
        <td><input type="text" name="name" value="{{ old('name', $menut->name)}}" required></td>
    </tr> 
    <tr>
        <td><strong>Description</strong></td>
        <td>::</td>
        <td> <textarea name="description" cols="80" rows="10" required>{{ old('description', $menut->description)}}</textarea></td>
    </tr>
</table>

<div class="actions">
    <button type="submit">Update</button>
</div>
</form>
@endsection