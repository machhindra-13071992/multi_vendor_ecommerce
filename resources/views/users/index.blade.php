@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            @if ($isLoggedIn) 
            <a class="btn btn-info" href="{{ route('users.create') }}"> <i class="fa fa-plus-circle"></i> Add New </a>
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
                <h4 class="card-title">Users</h4>
                <div class="table-overflow">
                    {!! $data->links() !!}
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>UN</th>
                                <th>Name</th>
                                <th>Email</th>
								<th>Role</th>
                                <th>Contact Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach ($data as $key => $user)   
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user['f_name'] }} {{ $user['l_name'] }}</td>
								<td>{{ $user['email'] }}</td>
                                <td>{{ isset($user['user_permissions']['name']) ? $user['user_permissions']['name'] : "" }}</td>
                                <td>{{ $user['mobile_no'] }}</td>
								<td>
									@if ($user->status == 1) <span class="text-success"><i class="fa fa-check"></i> Active</span> @endif
									@if ($user->status == 0) <span class="text-danger"><i class="fa fa-times"></i> InActive</span> @endif
								</td>
                                <td>
                                    @if($isLoggedIn)  
										<a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection