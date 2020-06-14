@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Notificaciones</h1>
    <div class="row">
        <div class="col-sm-6">
            <h2>No leídas</h2>
                <ul class="list-group">
                    @foreach ($unreadNotifications as $notification)
                       <li class="list-group-item">
                            <a href="{{ $notification->data['link'] }}"> {{$notification->data['text']}} </a>
                       </li>

                    <form action="{{ route('notifications.read', $notification->id) }}" class="pull-right" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-danger btn-xs">X</button>
                    </form>
                    @endforeach
                </ul>
        </div>
        <div class="col-sm-6">
            <h2>Leidas</h2>
            <ul class="list-group">
                @foreach ($readNotifications as $notification)
                   <li class="list-group-item">
                        <a href="{{ $notification->data['link'] }}"> {{$notification->data['text']}} </a>
                   </li>
                   <form action="{{ route('notifications.destroy', $notification->id) }}" class="pull-right" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-xs">X</button>
                </form>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
