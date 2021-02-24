    @extends('layouts.default')
    @section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Manage Orders</h4>
                    <div class="table-overflow">
                        {!! $orders->links() !!}
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
									<th>OrderID</th>
									<th>Name</th>
									<th>Mobile Number</th>
									<th>Area</th>
									<th>Address</th>
                                    <th>Payment Status</th>
									<th>Payment Type</th>
									<th>Order Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $cData)
                                <tr>
									<td>
                                        <div class="mrg-top-5">
                                            <span>{{ $cData->id }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ isset($cData['users']['f_name']) ? $cData['users']['f_name'] : "" }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ isset($cData['users']['mobile_no']) ? $cData['users']['mobile_no'] : "" }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ isset($cData['users']['landmark']) ? $cData['users']['landmark'] : "" }}</span>
                                        </div>
                                    </td>
									<td>
                                       <div class="mrg-top-5">
                                            <span>{{ isset($cData['users']['address']) ? $cData['users']['address'] : "" }}</span>
                                        </div>
                                    </td>
									<td>
                                        <div class="mrg-top-5">
                                            @if ($cData['is_payment_done'] == '0') <span class="text-danger">Pending</span> @endif
											@if ($cData['is_payment_done'] == '1') <span class="text-success">Done</span> @endif
											@if ($cData['status'] == 3) <span class="text-danger"><i class="fa fa-times"></i> Resigned</span> @endif	
											@if ($cData['status'] == 4) <span class="text-warning"><i class="fa fa-times"></i> Hold</span>@endif
                                        </div> 
                                    </td>
                                    <td>
                                        <div class="mrg-top-5">
                                            @if ($cData['is_payment_online'] == '0') <span class="text-success"><i class="fa fa-check"></i> Cash</span> @endif
											@if ($cData['is_payment_online'] == '1') <span class="text-danger"><i class="fa fa-times"></i> Online</span> @endif
											@if ($cData['status'] == 3) <span class="text-danger"><i class="fa fa-times"></i> Resigned</span> @endif	
											@if ($cData['status'] == 4) <span class="text-warning"><i class="fa fa-times"></i> Hold</span>@endif
                                        </div> 
                                    </td>
									<td>
                                        <div class="mrg-top-5">
										{!! Form::select('order_status_id', ['' => 'Select'] + $order_statuses, isset($cData['order_status_id']) ? $cData['order_status_id'] : "",['onchange'=>"updateOrderStatus(this.value,$cData[id])",'class' => 'noSelect2 form-control']) !!}
										</div> 
                                    </td>
									<td>
                                        <div class="mrg-top-5">
                                            @if($isLoggedIn)
                                               <a class="btn btn-warning btn-sm" href="{{ route('orders.show',$cData->id) }}?update_status_flag=1" data-toggle="tooltip" title="View"> <i class="fa fa-eye"></i>View Order</a>
                                            @endif
                                       </div>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        {!! $orders->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ secure_asset('resources/assets/vendors/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/table/data-table.js') }}"></script>
    @yield('scripts') 
    <script type="text/javascript">
		function updateOrderStatus(order_status_id,order_id) {
			$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}}); 
			$.ajax({
				url: webrootUrl+'update_order_status/'+order_id+'/'+order_status_id,
				type: "GET",
				dataType: "json",
				success:function(data) {
					alert("Status has been updated.");
				}
			});
		 }
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection