@extends('layouts.main')

@section('title','menut : Create')

@section('content')
<form class="form" action="{{ route('menut-create') }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td><strong class="color">::</strong></td>
        <td><input type="text" name="code" id="" value="{{ old('code')}}" required></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td><strong class="color">::</strong></td>
        <td><input type="text" name="name" value="{{ old('name')}}" required></td>
    </tr> 
    <tr>
        <td><strong>Description</strong></td>
        <td><strong class="color">::</strong></td>
        <td> <textarea name="description" value="{{ old('description')}}" required></textarea></td>
    </tr>
</table>

<div class="actions">
    <button type="submit">Create</button>
</div>

</form>
@endsection