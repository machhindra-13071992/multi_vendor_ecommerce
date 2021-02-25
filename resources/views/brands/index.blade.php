    @extends('layouts.default')
    @section('content')
    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            @if ($isLoggedIn) 
                <a class="btn btn-info" href="{{ route('brands.create') }}"> <i class="fa fa-plus-circle"></i> Add Brand</a>
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
                    <h4 class="card-title">Brands</h4>
                    <div class="table-overflow">
                        {!! $brands->links() !!}
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Brand</th>
									<th>Image</th>
                                    <th>Active</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $key => $videoStatus)
                                <tr>
                                    <td>
                                        <div class="mrg-top-5">
                                            <span>{{ $videoStatus->name }}</span>
                                        </div>
                                    </td>
									<td>
                                        <?php  if(isset($videoStatus['image_file'])  && !empty($videoStatus['image_file'])) {?>
											<img style="width:100px;" src="{{ secure_asset('/storage/app/category_image_files/') }}/<?php echo $videoStatus['image_file']; ?>">
											<?php  }?>
                                    </td>
                                    <td>
                                        <div class="mrg-top-5">
                                            <span>@if ($videoStatus->active == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="mrg-top-5">
                                            <span>{{ $videoStatus->created_at }}</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="mrg-top-5">
                                            <span>{{ $videoStatus->updated_at }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mrg-top-5">
                                            @if($isLoggedIn)
                                               <a class="btn btn-primary btn-sm" href="{{ route('brands.edit',$videoStatus->id) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                               <a class="btn btn-success btn-sm" href="{{ route('brands.show',$videoStatus->id) }}" data-toggle="tooltip" title="View"> <i class="fa fa-search"></i></a>  
                                               <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteSweetAlert('brands','{{ $videoStatus->id }}','update')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i>  </a>
                                            @endif
                                       </div>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        {!! $brands->links() !!}
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