@extends('layouts.main')

@section('title','menut : View')

@section('content')

<nav>
    <a href="{{ session()->get('bookmark.menut-detail', route('menut-list'))}}"> &lt; Back</a>
    <a href="{{ route('menut-detail-maindish',['code' => $menut['code']])}}">Show Maindish</a>
    @can('update', \App\Models\menut::class)
    <a href="{{ route('menut-update-form',['code' => $menut['code']])}}"><svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" width="15" height="15"><path d="M18.656.93,6.464,13.122A4.966,4.966,0,0,0,5,16.657V18a1,1,0,0,0,1,1H7.343a4.966,4.966,0,0,0,3.535-1.464L23.07,5.344a3.125,3.125,0,0,0,0-4.414A3.194,3.194,0,0,0,18.656.93Zm3,3L9.464,16.122A3.02,3.02,0,0,1,7.343,17H7v-.343a3.02,3.02,0,0,1,.878-2.121L20.07,2.344a1.148,1.148,0,0,1,1.586,0A1.123,1.123,0,0,1,21.656,3.93Z"/><path d="M23,8.979a1,1,0,0,0-1,1V15H18a3,3,0,0,0-3,3v4H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2h9.042a1,1,0,0,0,0-2H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H16.343a4.968,4.968,0,0,0,3.536-1.464l2.656-2.658A4.968,4.968,0,0,0,24,16.343V9.979A1,1,0,0,0,23,8.979ZM18.465,21.122a2.975,2.975,0,0,1-1.465.8V18a1,1,0,0,1,1-1h3.925a3.016,3.016,0,0,1-.8,1.464Z"/></svg>Update</a>
    @endcan

    @can('delete', $menut)
    <a href="{{ route('menut-delete',['code' => $menut['code']]) }}"><svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" width="15" height="15"><path d="M21,4H17.9A5.009,5.009,0,0,0,13,0H11A5.009,5.009,0,0,0,6.1,4H3A1,1,0,0,0,3,6H4V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V6h1a1,1,0,0,0,0-2ZM11,2h2a3.006,3.006,0,0,1,2.829,2H8.171A3.006,3.006,0,0,1,11,2Zm7,17a3,3,0,0,1-3,3H9a3,3,0,0,1-3-3V6H18Z"/><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18Z"/><path d="M14,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>Delete</a>
    @endcan
</nav>

<table>
    <tr>
        <td><strong>Code</strong></td>
        <td><strong class="color">::</strong></td>
        <td>{{$menut['code']}}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td><strong class="color">::</strong></td>
        <td class="name">{{$menut['name']}}</td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td><strong class="color">::</strong></td>
        <td>{{$menut['description']}}</td>
    </tr>
</table>
@endsection