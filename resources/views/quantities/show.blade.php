@extends('layouts.default')

@section('content')
    <div class="page-title">
        <h4>Category Details</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-title">   
                <div class="actions">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('quantities.edit', $quantities->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i> <span class="title">Edit</span></a>
                        <a href="javascript:void(0)" onclick="deleteSweetAlert('quantities','{{ $quantities->id }}','update')" class="btn btn-sm btn-danger" data-toggle="modal-manager"><i class="fa fa-trash-o"></i> <span class="title">Delete</span></a>
                        <a href="{{ route('quantities.index') }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> <span class="title">quantities</span></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                        <tbody>
                            <tr>
                                <td class=''><b>quantities Details</b></th>
                                <td class=''>{{ $quantities['name'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Active</b></th>
                                <td class=''>@if ($quantities->active == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif</td>
                            </tr>
                            <tr>
                                <td class=''><b>Created At</b></th>
                                <td class=''>{{ $quantities['created_at'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Modified At</b></th>
                                <td class=''>{{ $quantities['updated_at'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection