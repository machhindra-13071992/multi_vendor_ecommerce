    @extends('layouts.default')
    @section('content')
    <div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-right">
				@if ($isLoggedIn) 
					<a class="btn btn-info" href="{{ route('products.create') }}"> <i class="fa fa-plus-circle"></i> Add Product</a>
				@endif
			</div>
		</div>
    </div>
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
                    <h4 class="card-title">Products</h4>
                    <div class="table-overflow">
                        {!! $products->links() !!}
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
									<th>Name</th>
									<th>Image</th>
									<th>Code</th>
									<th>Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $cData)
                                <tr>
                                    
									<td>
                                        <div class="mrg-top-5">
                                            <span>{{ $cData->product_name }}</span>
                                        </div>
                                    </td>
									<td>
                                        <?php  if(isset($cData['image_file'])  && !empty($cData['image_file'])) {?>
											<img style="width:100px;" src="{{ secure_asset('/storage/app/product_image_files/') }}/<?php echo $cData['image_file']; ?>">
											<?php  }?>
                                    </td>
									<td>
                                        <div class="mrg-top-5">
                                            <span>{{ $cData->product_code }}</span>
                                        </div>
                                    </td>
									<td>
                                        <div class="mrg-top-5">
                                            <span>
											{{ isset($cData['categories']['name']) ? $cData['categories']['name'] : "" }}
											</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mrg-top-5">
                                            @if ($cData['status'] == 1) <span class="text-success"><i class="fa fa-check"></i> Active</span> @endif
											@if ($cData['status'] == 2) <span class="text-danger"><i class="fa fa-times"></i> Suspend</span> @endif
											@if ($cData['status'] == 3) <span class="text-danger"><i class="fa fa-times"></i> Resigned</span> @endif	
											@if ($cData['status'] == 4) <span class="text-warning"><i class="fa fa-times"></i> Hold</span>@endif
                                        </div> 
                                    </td>
									<td>
                                        <div class="mrg-top-5">
                                            @if($isLoggedIn)
                                               <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$cData->id) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                               <a class="btn btn-success btn-sm" href="{{ route('products.show',$cData->id) }}" data-toggle="tooltip" title="View"> <i class="fa fa-eye"></i></a>
											   @if($userRole['stock_edit_change_status'])
												<a class="btn btn-warning btn-sm" href="{{ route('products.show',$cData->id) }}?update_status_flag=1" data-toggle="tooltip" title="Change Status"> <i class="fa fa-refresh"></i></a>
												@endif	
                                            @endif
                                       </div>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ secure_asset('resources/assets/vendors/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/table/data-table.js') }}"></script>
    @yield('scripts') 
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection