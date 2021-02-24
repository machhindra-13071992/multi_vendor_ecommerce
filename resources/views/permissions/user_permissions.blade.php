@extends('layouts.default')

@section('content')
<style>
.label-info {background-color: #2bafff !important;}
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
			<div class="card-heading border bottom">
                    <h4 class="card-title">Add Permission</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
							@if ($message = Session::get('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>{{ $message }}</strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::open(['route' => 'post_user_permission', 'method' => 'POST', 'role'=>'form', 'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::Label('create_new_user', 'User Permitted to Create NEW USER’S?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('create_new_user', '0', isset($userPermissions['create_new_user']) && $userPermissions['create_new_user'] == '0' ? true : false, ['class'=>'radio','id'=>'create_new_user1','required']) }}
                                                        <label for="create_new_user1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('create_new_user', '1', isset($userPermissions['create_new_user']) && $userPermissions['create_new_user'] == '1' ? true : false, ['class'=>'radio','id'=>'create_new_user2','required']) }}
                                                        <label for="create_new_user2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											{!! Form::hidden('id', isset($userPermissions['id'])?$userPermissions['id']:0, [ ]); !!}
                                            {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                        </div>
										<div class="col-md-12">
											<div class="form-group">
                                                {!! Form::Label('create_new_user', 'User Permitted to Create NEW USER’S?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('create_new_user', '0', isset($userPermissions['create_new_user']) && $userPermissions['create_new_user'] == '0' ? true : false, ['class'=>'radio','id'=>'create_new_user1','required']) }}
                                                        <label for="create_new_user1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('create_new_user', '1', isset($userPermissions['create_new_user']) && $userPermissions['create_new_user'] == '1' ? true : false, ['class'=>'radio','id'=>'create_new_user2','required']) }}
                                                        <label for="create_new_user2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::Label('edit_existing_user', 'Edit existing User’s?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('edit_existing_user', '0', isset($userPermissions['edit_existing_user']) && $userPermissions['edit_existing_user'] == '0' ? true : false, ['class'=>'radio','id'=>'edit_existing_user1']) }}
                                                        <label for="edit_existing_user1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('edit_existing_user', '1', isset($userPermissions['edit_existing_user']) && $userPermissions['edit_existing_user'] == '1' ? true : false, ['class'=>'radio','id'=>'edit_existing_user2']) }}
                                                        <label for="edit_existing_user2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('change_status_of_user', 'Change status of Users?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('change_status_of_user', '0', isset($userPermissions['change_status_of_user']) && $userPermissions['change_status_of_user'] == '0' ? true : false, ['class'=>'radio','id'=>'change_status_of_user1']) }}
                                                        <label for="change_status_of_user1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('change_status_of_user', '1', isset($userPermissions['change_status_of_user']) && $userPermissions['change_status_of_user'] == '1' ? true : false, ['class'=>'radio','id'=>'change_status_of_user2']) }}
                                                        <label for="change_status_of_user2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('customer_data_entry', 'Permission for Customer Data Entry ') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('customer_data_entry', '0', isset($userPermissions['customer_data_entry']) && $userPermissions['customer_data_entry'] == '0' ? true : false, ['class'=>'radio','id'=>'customer_data_entry1']) }}
                                                        <label for="customer_data_entry1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('customer_data_entry', '1', isset($userPermissions['customer_data_entry']) && $userPermissions['customer_data_entry'] == '1' ? true : false, ['class'=>'radio','id'=>'customer_data_entry2']) }}
                                                        <label for="customer_data_entry2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('stock_data_entry_screen', 'Access to STOCK DATA ENTRY SCREEN') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('stock_data_entry_screen', '0', isset($userPermissions['stock_data_entry_screen']) && $userPermissions['stock_data_entry_screen'] == '0' ? true : false, ['class'=>'radio','id'=>'stock_data_entry_screen1']) }}
                                                        <label for="stock_data_entry_screen1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('stock_data_entry_screen', '1', isset($userPermissions['stock_data_entry_screen']) && $userPermissions['stock_data_entry_screen'] == '1' ? true : false, ['class'=>'radio','id'=>'stock_data_entry_screen2']) }}
                                                        <label for="stock_data_entry_screen2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('stock_edit_change_status', 'Access to Stock Edit/Change Status') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('stock_edit_change_status', '0', isset($userPermissions['stock_edit_change_status']) && $userPermissions['stock_edit_change_status'] == '0' ? true : false, ['class'=>'radio','id'=>'stock_edit_change_status1']) }}
                                                        <label for="stock_edit_change_status1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('stock_edit_change_status', '1', isset($userPermissions['stock_edit_change_status']) && $userPermissions['stock_edit_change_status'] == '1' ? true : false, ['class'=>'radio','id'=>'stock_edit_change_status2']) }}
                                                        <label for="stock_edit_change_status2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('mode_of_shipment', 'Access to MODE OF SHIPMENT') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('mode_of_shipment', '0', isset($userPermissions['mode_of_shipment']) && $userPermissions['mode_of_shipment'] == '0' ? true : false, ['class'=>'radio','id'=>'mode_of_shipment1']) }}
                                                        <label for="mode_of_shipment1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('mode_of_shipment', '1', isset($userPermissions['mode_of_shipment']) && $userPermissions['mode_of_shipment'] == '1' ? true : false, ['class'=>'radio','id'=>'mode_of_shipment2']) }}
                                                        <label for="mode_of_shipment2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('shipment_schedule', 'Access to SHIPMENT SCHEDULE') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('shipment_schedule', '0', isset($userPermissions['shipment_schedule']) && $userPermissions['shipment_schedule'] == '0' ? true : false, ['class'=>'radio','id'=>'shipment_schedule1']) }}
                                                        <label for="shipment_schedule1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('shipment_schedule', '1', isset($userPermissions['shipment_schedule']) && $userPermissions['shipment_schedule'] == '1' ? true : false, ['class'=>'radio','id'=>'shipment_schedule2']) }}
                                                        <label for="shipment_schedule2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('delivery', 'Access to DELIVERY') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('delivery', '0', isset($userPermissions['delivery']) && $userPermissions['delivery'] == '0' ? true : false, ['class'=>'radio','id'=>'delivery1']) }}
                                                        <label for="delivery1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('delivery', '1', isset($userPermissions['delivery']) && $userPermissions['delivery'] == '1' ? true : false, ['class'=>'radio','id'=>'delivery2']) }}
                                                        <label for="delivery2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('payment_terms', 'Access to PAYMENT TERMS') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('payment_terms', '0', isset($userPermissions['payment_terms']) && $userPermissions['payment_terms'] == '0' ? true : false, ['class'=>'radio','id'=>'payment_terms1']) }}
                                                        <label for="payment_terms1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('payment_terms', '1', isset($userPermissions['payment_terms']) && $userPermissions['payment_terms'] == '1' ? true : false, ['class'=>'radio','id'=>'payment_terms2']) }}
                                                        <label for="payment_terms2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('access_to_bank', 'Access to BANK ?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('access_to_bank', '0', isset($userPermissions['access_to_bank']) && $userPermissions['access_to_bank'] == '0' ? true : false, ['class'=>'radio','id'=>'access_to_bank1']) }}
                                                        <label for="access_to_bank1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('access_to_bank', '1', isset($userPermissions['access_to_bank']) && $userPermissions['access_to_bank'] == '1' ? true : false, ['class'=>'radio','id'=>'access_to_bank2']) }}
                                                        <label for="access_to_bank2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('port_of_destination', 'Access to PORT OF DESTINATION? ') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('port_of_destination', '0', isset($userPermissions['port_of_destination']) && $userPermissions['port_of_destination'] == '0' ? true : false, ['class'=>'radio','id'=>'port_of_destination1']) }}
                                                        <label for="port_of_destination1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('port_of_destination', '1', isset($userPermissions['port_of_destination']) && $userPermissions['port_of_destination'] == '1' ? true : false, ['class'=>'radio','id'=>'port_of_destination2']) }}
                                                        <label for="port_of_destination2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('access_to_company', 'Access to COMPANY ?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('access_to_company', '0', isset($userPermissions['access_to_company']) && $userPermissions['access_to_company'] == '0' ? true : false, ['class'=>'radio','id'=>'access_to_company1']) }}
                                                        <label for="access_to_company1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('access_to_company', '1', isset($userPermissions['access_to_company']) && $userPermissions['access_to_company'] == '1' ? true : false, ['class'=>'radio','id'=>'access_to_company2']) }}
                                                        <label for="access_to_company2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('performa_invoice', 'User has the permission to access Performa Invoice?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('performa_invoice', '0', isset($userPermissions['performa_invoice']) && $userPermissions['performa_invoice'] == '0' ? true : false, ['class'=>'radio','id'=>'performa_invoice1']) }}
                                                        <label for="performa_invoice1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('performa_invoice', '1', isset($userPermissions['performa_invoice']) && $userPermissions['performa_invoice'] == '1' ? true : false, ['class'=>'radio','id'=>'performa_invoice2']) }}
                                                        <label for="performa_invoice2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group">
                                                {!! Form::Label('shipment_tracking', 'User has the permission to access Shipment Tracking?') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('shipment_tracking', '0', isset($userPermissions['shipment_tracking']) && $userPermissions['shipment_tracking'] == '0' ? true : false, ['class'=>'radio','id'=>'shipment_tracking1']) }}
                                                        <label for="shipment_tracking1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('shipment_tracking', '1', isset($userPermissions['shipment_tracking']) && $userPermissions['shipment_tracking'] == '1' ? true : false, ['class'=>'radio','id'=>'shipment_tracking2']) }}
                                                        <label for="shipment_tracking2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection