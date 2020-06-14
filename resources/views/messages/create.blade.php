@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-heading">Enviar mensaje</div>

            <form action="{{ route('messages.store')  }}" method="POST">
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <select name="recipient_id" id="" class="form-control {{  $errors->has('recipient_id') ? 'is-invalid' : '' }}">
                            <option value="">Selecciona un usuario</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">   {{$user->name}} </option>
                            @endforeach
                        </select>
                        @if ( $errors->has('recipient_id'))
                            <div class="invalid-feedback d-block" >
                                {{  $errors->first('recipient_id'," :message ") }}

                            </div>
                        @endif
                    </div>
                <div class="form-group ">
                        <textarea name="body" id="" cols="30" rows="10" class="form-control {{  $errors->has('body') ? 'is-invalid' : '' }}"></textarea>

                        @if ( $errors->has('body'))
                            <div class="invalid-feedback d-block" >
                                {{  $errors->first('body'," :message ") }}

                            </div>
                        @endif

                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
