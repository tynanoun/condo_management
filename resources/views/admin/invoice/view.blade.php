@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Invoice</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Invoice</a>
            </li>
            <li class="active">
                View
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
    @include('admin.invoice.invoiceContent')
@endsection

