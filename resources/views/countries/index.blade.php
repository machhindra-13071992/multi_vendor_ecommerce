    @extends('layouts.default')
    @section('content')
    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
             @if ($isLoggedIn && $userRole['full_add'] ) 
            <a class="btn btn-info" href="{{ route('countries.create') }}"> <i class="fa fa-plus-circle"></i> Add Country </a>
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
                    <h4 class="card-title">Countries</h4>
                    <div class="table-overflow">
                        {!! $countries->links() !!}
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Alpha 2 Code</th>
                                    <th>Alpha 3 Code</th>
                                    <th>Active</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $key => $country)
                                <tr>
                                    <td>
                                        <div class="mrg-top-15">
                                            <span>{{ $country->name }}</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="mrg-top-15">
                                            <span>{{ $country->alpha_2_code }}</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="mrg-top-15">
                                            <span>{{ $country->alpha_3_code }}</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="mrg-top-15">
                                            <span>@if ($country->active == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mrg-top-15">
                                            <span>{{ $country->created_at }}</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="mrg-top-15">
                                            <span>{{ $country->updated_at }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($isLoggedIn)
                                                @if($userRole['full_edit'])
                                       <a class="btn btn-primary btn-sm" href="{{ route('countries.edit',$country->id) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                       @endif
                                                @if($userRole['full_view'])
                                       <a class="btn btn-success btn-sm" href="{{ route('countries.show',$country->id) }}" data-toggle="tooltip" title="View"> <i class="fa fa-search"></i></a>
                                       @endif
                                               @if($userRole['full_delete'])
                                       <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteSweetAlert('countries','{{ $country->id }}','update')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i>  </a>
                                       @endif
                                    @endif
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        {!! $countries->links() !!}
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