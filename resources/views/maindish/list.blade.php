@extends('layouts.main')

@section('title','Maindish : List')

@section('content')
<form id="form" class="form" action="{{ route('maindish-list') }}" method="get">
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

    <button form="form" class="s" type="submit">Search</button>

    <a href="{{ route('maindish-list')}}">
        <button class="c">Clear</button>
    </a>
  </div>

</form>

   
        <a class="link" href="{{ route('maindish-create-form')}}">New maindish</a>


<table class="list">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>MenuType</th>
        <th>Price</th>
    </tr>
    @foreach($maindishes as $maindish)
    <tr>
        <td class="code"><a href="{{ route('maindish-detail',['code' => $maindish['code']]) }}">{{$maindish['code']}}</a></td>
        <td>{{$maindish['name']}}</td>
        <td>{{$maindish->menut->name}}</td>
        <td>{{$maindish['price']}}</td>
    </tr>
    @endforeach
</table>

{{$maindishes->withQueryString()->links()}}
@endsection