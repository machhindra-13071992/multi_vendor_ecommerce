@extends('layouts.default')
@section('content')
    <div class="page-title">
        <h4>Order Item Details</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">   
                <div class="actions">
                    <div class="">
                        <a href="{{ route('orders.index') }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> <span class="title">Go back</span></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
									<th>OrderID</th>
									<th>Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_items as $key => $cData)
                                <tr>
									<td>
                                        <div class="mrg-top-5">
                                            <span>{{ $cData->order_id }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ $cData->itemname }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ $cData->itemquantity }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ $cData->itemprice }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ $cData->itemtotal }}</span>
                                        </div>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection