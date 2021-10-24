@extends('layouts.main')

@section('title', $title)

@section('content')

<a class="back" href="{{ route('menut-detail-maindish',['code' => $menut['code']]) }}"><strong> &lt; Back</strong></a>

<form id="form" class="form" action="{{ route('menut-add-maindish-form',['code' => $menut['code']]) }}" method="get">
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

    <a href="{{ route('maindish-list')}}">
        <button class="green">Clear</button>
    </a>
  </div>

</form>

<a class="link" href="{{ route('menut-create-form')}}">New menut</a>

<form action="{{ route('menut-add-maindish', ['code' => $menut->code,])}}" method="post">
@csrf
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
        <th>&nbsp; </th>
    </tr>
    @foreach($maindishes as $maindish)
    <tr>
        <td class="code"><a href="{{ route('maindish-detail',['code' => $maindish['code']]) }}">{{$maindish['code']}}</a></td>
        <td>{{$maindish['name']}}</td>
        <td>{{$maindish->menut->name}}</td>
        <td class="r">{{$maindish['price']}}</td>
        <td>
            <button type="submit" name="maindish" value="{{$maindish->code}}">Add</button>
        </td>
    </tr>
    @endforeach
</table>
</form>

{{$maindishes->withQueryString()->links()}}
@endsection