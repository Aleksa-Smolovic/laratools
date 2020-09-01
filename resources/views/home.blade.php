@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Logged user channel messages</div>

                <div class="card-body" id="app-user-msg">
                  
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Specific user messages</div>

                <div class="card-body" id="specific-user-msg">
                  
                </div>
            </div>
        </div>

        <script type="application/javascript">
        // Channel names can be dynamic. Ie. post_id
        Echo.private('application-event-3')
            .listen('.app-user-notification', (e) => {
                console.log(e);
                $element = '<div class="alert alert-success" role="alert">' + e.message + '</div>';
                $('#app-user-msg').append($element);
            });
        Echo.private('specific-user-event-' + {{Auth::id()}})
            .listen('.specific-user-notification', (e) => {
                console.log(e);
                $element = '<div class="alert alert-success" role="alert">' + e.message + '</div>';
                $('#specific-user-msg').append($element);
            });
        </script>

    </div>
</div>
@endsection
