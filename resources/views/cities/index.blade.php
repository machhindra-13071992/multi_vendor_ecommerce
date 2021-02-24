@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            @if ($isLoggedIn && $userRole['full_add'] ) 
            <a class="btn btn-info" href="{{ route('cities.create') }}"> <i class="fa fa-plus-circle"></i> Add City </a>
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
                <h4 class="card-title">States</h4>
                <div class="table-overflow">
                {!! $data->links() !!}
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Country Name</th>
                            <th>State Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $cities)   
                        <tr>
                            <td>{{ $cities->name }}</td>
                            <td>{{ $cities['countries']['name'] }}</td>
                            <td>{{ $cities['states']['name'] }}</td>
                            <td>@if ($cities->active == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif </td>
                            <td>
                                @if($isLoggedIn)
                                            @if($userRole['full_edit'])
                               <a class="btn btn-primary btn-sm" href="{{ route('cities.edit',$cities->id) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                @endif
                                        @if($userRole['full_view'])
                               <a class="btn btn-success btn-sm" href="{{ route('cities.show',$cities->id) }}" data-toggle="tooltip" title="View"> <i class="fa fa-search"></i></a>
                               @endif
                                               @if($userRole['full_delete'])
                               <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteSweetAlert('cities','{{ $cities->id }}','update')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i>  </a>
                                 @endif
                                    @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $data->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ secure_asset('resources/assets/vendors/datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ secure_asset('resources/assets/js/table/data-table.js') }}"></script>

@yield('scripts')  
@endsection