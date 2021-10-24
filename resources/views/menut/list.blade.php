@extends('layouts.main')

@section('title','MenuType : List')

@section('content')
<form class="form" action="{{ route('menut-list') }}" method="get">
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

<a href="{{ route('menut-list')}}">
    <button class="green">Clear</button>
</a>
</div>

    @can('create', \App\Models\menut::class)
        <a class="link" href="{{ route('menut-create-form')}}">New menut</a>
    @endcan


<table class="list">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>No. of Maindish</th>
    </tr>
    @foreach($menuts as $menut)
    <tr>
        <td class="code"><a href="{{ route('menut-detail',['code' => $menut['code']]) }}">{{$menut['code']}}</a></td>
        <td>{{$menut['name']}}</td>
        <td class="r">{{$menut->maindishes_count}}</td>
    </tr>
    @endforeach
</table>

{{$menuts->links()}}

@endsection