@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>

    let event = new  EventSource( "{{ route('notifications.event') }}" );
    console.log(event)

    event.addEventListener('message' ,  e => {
        console.log(e)
        console.log(e.data)
    })
    // event.onmessage(e => {
    //     console.log(e)
    //     alert(e.data);
    // });

        event.document.addEventListener('error',  e => {
            console.error(e)
        })
    // event.onerror(e => {
    //     console.error(e)
    // })

</script>

@endsection
