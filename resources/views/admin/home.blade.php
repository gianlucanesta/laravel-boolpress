@extends('layouts.dashboard')

@section('content')
    <h1>Benvenuto <strong>{{ $user->name}}</strong> nell'area di amministrazione</h1>
   
    @if ($userInfo)
        <div><strong>Telefono: </strong> {{$userInfo->phone}}</div>
        <div><strong>Indirizzo: </strong> {{$userInfo->address}} </div>
    @endif


@endsection