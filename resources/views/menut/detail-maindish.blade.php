@extends('layouts.main')

@section('title', $title)

@section('content')

<a class="back" href="{{ route('menut-detail',['code' => $menut['code']]) }}"><strong> &lt; Back</strong></a>

<form class="form" action="{{ route('menut-detail-maindish',['code' => $menut['code']]) }}" method="get">
<table>
        <tr>
            <td> <label for="term">Search</label> </td>
            <td> <strong class="color">::</strong></td>
            <td> <input type="text" name="term" id="term" value="{{$data['term']}}"> </td>
        </tr>
        <tr>
            <td> <label for="minPrice">Min Price</label> </td>
            <td> <strong class="color">::</strong></td>
            <td> <input type="text" name="minPrice" id="minPrice" value="{{$data['minPrice']}}"> </td>
        </tr>
        <tr>
            <td> <label for="maxPrice">Max Price</label> </td>
            <td> <strong class="color">::</strong></td>
            <td> <input type="text" name="maxPrice" id="maxPrice" value="{{$data['maxPrice']}}"> </td>
        </tr>
    </table>




<div class="actions">

<button form="form" class="blue" type="submit">Search</button>

<a href="{{ route('menut-list')}}">
    <button class="green">Clear</button>
</a>
</div>
</form>
@can('update', \App\Models\menut::class)
    <a class="link" href="{{ route('menut-add-maindish-form',['code' => $menut->code,]) }}">Add Maindish </a>
@endcan

<table class="list">
<colgroup>
    <col style="width:6ch;" />
    <col />
    <col style="width:20ch;" />
    <col style="width:4ch;" />
</colgroup>
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>menut</th>
        <th>Price</th>
    </tr>
    @foreach($maindishes as $maindish)
    <tr>
        <td class="code"><a href="{{ route('maindish-detail',['code' => $maindish['code']]) }}">{{$maindish['code']}}</a></td>
        <td>{{$maindish['name']}}</td>
        <td>{{$maindish->menut->name}}</td>
        <td class="r">{{$maindish['price']}}</td>
    </tr>
    @endforeach
</table>

{{$maindishes->withQueryString()->links()}}

@endsection