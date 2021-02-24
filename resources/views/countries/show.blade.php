@extends('layouts.default')

@section('content')
    <div class="page-title">
        <h4>Country Details</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-title">   
                <div class="actions">
                    <div class="btn-group">
                        @if($isLoggedIn)
                                @if($userRole['full_edit'])
                            <a href="{{ route('countries.edit', $countries->id) }}" class="btn  btn-primary"><i class="fa fa-pencil-square-o"></i> <span class="title">Edit</span></a>
                            @endif
                                @if($userRole['full_delete'])
                            <a href="javascript:void(0)" onclick="deleteSweetAlert('countries','{{ $countries->id }}','update')" class="btn btn-sm btn-danger" data-toggle="modal-manager"><i class="fa fa-trash-o"></i> <span class="title">Delete</span></a>
                            @endif
                         @endif
                        <a href="{{ route('countries.index') }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> <span class="title">Countries</span></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                        <tbody>
                            <tr>
                                <td class=''><b>Pitch Details</b></th>
                                <td class=''>{{ $countries['name'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Is Domestic Country</b></th>
                                <td class=''>@if ($countries->is_domestic_country == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif</td>
                            </tr>
                            <tr>
                                <td class=''><b>Alpha 2 Code</b></th>
                                <td class=''>{{ $countries['alpha_2_code'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Alpha 3 Code</b></th>
                                <td class=''>{{ $countries['alpha_3_code'] }}</td>
                            </tr>
                            

                            <tr>
                                <td class=''><b>Active</b></th>
                                <td>@if ($countries->active == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif</td>
                            </tr>
                            <tr>
                                <td class=''><b>Created At</b></th>
                                <td class=''>{{ $countries['created_at'] }}</td>
                            </tr>
                            <tr>
                                <td class=''><b>Modified At</b></th>
                                <td class=''>{{ $countries['updated_at'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection