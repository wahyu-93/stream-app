@extends('layouts.base')

@section('title', 'Transaction')

@section('content-wrapper')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Transaction</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>package</th>
                                    <th>user</th>
                                    <th>Amount</th>
                                    <th>Transaction Code</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()