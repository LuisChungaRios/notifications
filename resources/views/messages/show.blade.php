@extends('layouts.app')
@section('content')
    <h1> Mensaje </h1>

    <p> {{ $message->body }} </p>

    <small> enviado por: {{ $message->sender->name }} </small>

@endsection

