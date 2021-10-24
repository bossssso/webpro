@extends('layouts.main')

@section('title','Maindish : Update')

@section('content')
<form class="form" action="{{ route('maindish-update',['code' => $maindish['code']]) }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td>::</td>
        <td><input type="text" name="code" value="{{ old('code', $maindish->code)}}" required></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>::</td>
        <td><input type="text" name="name" value="{{ old('name', $maindish->name)}}" required></td>
    </tr> 
    <tr>
        <td><strong>MenuType</strong></td>
        <td><strong class="color">::</strong></td>
        <td>
        <select name="menut_id" required>
        @foreach($menuts as $menut)
        <option value="{{ $menut->id }}"{{ ($menut->id === old('menut', $maindish->menut->id))? ' selected' : '' }}>
                [{{ $menut->code }}] {{ $menut->name }}
        </option>
        @endforeach
        </select>
        </td>
    </tr> 
    <tr>
        <td><strong>Price</strong></td>
        <td>::</td>
        <td><input type="number" name="price" value="{{ old('price', $maindish->price)}}" required></td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td>::</td>
        <td> <textarea name="description" cols="80" rows="10" required>{{ old('description', $maindish->description)}}</textarea></td>
    </tr>
</table>

<div class="actions">
    <button type="submit">Update</button>
</div>
</form>
@endsection