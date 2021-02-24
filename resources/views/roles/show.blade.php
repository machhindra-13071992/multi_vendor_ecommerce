@extends('layouts.default')

@section('content')
    <div class="page-title">
        <h4>Role Details</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group">
                @if($isLoggedIn)
                            @if($userRole['full_edit'])
                <a href="{{ route('roles.edit', $roles->id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> <span class="title">Edit</span></a>
                 @endif
                        @if($userRole['full_delete'])
                <a href="javascript:void(0)" onclick="deleteSweetAlert('roles','{{ $roles->id }}','delete')" class="btn btn-danger" data-toggle="modal-manager"><i class="fa fa-trash-o"></i> <span class="title">Delete</span></a>
                @endif
                <a href="{{ route('roles.index') }}" class="btn btn-info"><i class="fa fa-list"></i> <span class="title">List</span></a>
            @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                        <tbody>
                            <tr>
                                <td class=''><b>Name</b></th>
                                <td class=''>{{ $roles['name'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Created At</b></th>
                                <td class=''>{{ $roles['created_at'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Modified At</b></th>
                                <td class=''>{{ $roles['updated_at'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection