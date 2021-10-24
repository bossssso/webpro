@extends('layouts.main')

@section('title','Maindish : Create')

@section('content')
<form class="form" action="{{ route('maindish-create') }}" method="post">
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
        <td><strong>MenuType</strong></td>
        <td><strong class="color">::</strong></td>
        <td>
        <select name="menut_id" required>
        <option value="">-- Please select menut --</option>
            @foreach($menuts as $menut)
            <option value="{{ $menut->id }}"{{ ($menut->id === old('menut'))? ' selected' : '' }}>
                [{{ $menut->code }}] {{ $menut->name }}
            </option>
            @endforeach
        </select>
        </td>
    </tr> 
    
    <tr>
        <td><strong>Price</strong></td>
        <td><strong class="color">::</strong></td>
        <td><input type="number" name="price" value="{{ old('price')}}" required></td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td><strong class="color">::</strong></td>
        <td> <textarea name="description" required>{{ old('description')}}</textarea></td>
    </tr>
</table>

<div class="actions">
    <button type="submit">Create</button>
</div>

</form>
@endsection