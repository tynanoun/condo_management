@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Error</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                Error
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="text-center p-t-10">
                <h1 class="text-error m-t-50 p-t-10">404</h1>
                <h2 class="text-uppercase text-danger m-t-30">Page Not Found</h2>
                <p class="text-muted m-t-30">It's looking like you may have taken a wrong turn. Don't worry... it
                    happens to the best of us. You might want to check your internet connection. Here's a
                    little tip that might help you get back on track.</p>
                <a class="btn btn-md btn-primary waves-effect waves-light m-t-20" href="/usage"> Return Home</a>
            </div>

        </div><!-- end col -->
    </div>
@endsection