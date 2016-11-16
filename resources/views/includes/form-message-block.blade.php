@if(count($errors) > 0)
    <section class="row">
        <div class="alert alert-danger col-md-12" role="alert">
            @foreach($errors->all() as $error)
                <div>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    </section>
@endif

@if(Session::has('message'))
    <section class="row">
        <div class="alert alert-success col-md-12" role="alert">
            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
            <span class="sr-only">Success:</span>
            {{ Session::get('message') }}
        </div>
    </section>
@endif