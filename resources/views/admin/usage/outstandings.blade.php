<!-- index.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
        <table class = "table">
            <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Previous<br>Reading</th>
                <th>Current<br>Reading</th>
                <th>Usage</th>
                <th>Paid Date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($usages as $usage)
                <tr>
                    <td>{{$usage['start_date']}}</td>
                    <td>{{$usage['end_date']}}</td>
                    <td>{{$usage['previous_reading']}}</td>
                    <td>{{$usage['current_reading']}}</td>
                    <td>{{$usage['current_reading'] - $usage['previous_reading']}}</td>
                    <td>{{$usage['paid_date']}}</td>
                    <td>
                        <a href="/usage/invoice/{{$usage['id']}}" class="btn btn-warning">Invoice</a>
                        <a href="/usage/download/{{$usage['id']}}" class="btn btn-warning">Download</a>
                        <a href="/usage/setpaid/{{$usage['id']}}" class="btn btn-warning">Paid</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
