@extends('layouts.default')

@section('content')
<style>
.label-info {background-color: #2bafff !important;}
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('roles.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back To Listing </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Update Roles</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::model($roles, ['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'PATCH','route' => ['roles.update', $roles->id]]) !!}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group required">
												{!! Form::hidden('id', $roles->id, [ ]); !!}
                                                {!! Form::Label('name', 'Role Name') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Menu', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::Label('description', 'Description') !!}
                                                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder'=>'Role description']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="label label-primary"><i>Super User Related Roles</i></span>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('full_add',true,null, array('id'=>'full_add')) }}
                                                    {!! Form::Label('full_add', 'All Add Button') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('full_edit',true,null, array('id'=>'full_edit')) }}
                                                    {!! Form::Label('full_edit', 'All Edit Button') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('full_delete',true,null, array('id'=>'full_delete')) }}
                                                    {!! Form::Label('full_delete', 'All  Delete Button') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('full_view',true,null, array('id'=>'full_view')) }}
                                                    {!! Form::Label('full_view', 'All View Button') !!}
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('super_config',true,null, array('id'=>'super_config')) }}
                                                    {!! Form::Label('super_config', 'Super User') !!}
                                                </div>
                                            </div>
                                        </div>
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="label label-primary"><i>User Related Permission</i></span>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('create_new_user',true,null, array('id'=>'create_new_user')) }}
                                                    {!! Form::Label('create_new_user', 'Create NEW USER’S') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('edit_existing_user',true,null, array('id'=>'edit_existing_user')) }}
                                                    {!! Form::Label('edit_existing_user', 'Edit existing User’s') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('change_status_of_user',true,null, array('id'=>'change_status_of_user')) }}
                                                    {!! Form::Label('change_status_of_user', 'Change status of Users') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('customer_data_entry',true,null, array('id'=>'customer_data_entry')) }}
                                                    {!! Form::Label('customer_data_entry', 'Customer Data Entry') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('stock_data_entry_screen',true,null, array('id'=>'stock_data_entry_screen')) }}
                                                    {!! Form::Label('stock_data_entry_screen', 'Stock Data Entry Screen') !!}                                        
                                                </div>
                                               </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('stock_edit_change_status',true,null, array('id'=>'stock_edit_change_status')) }}
                                                    {!! Form::Label('stock_edit_change_status', 'Stock Edit/Change Status') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('mode_of_shipment',true,null, array('id'=>'mode_of_shipment')) }}
                                                    {!! Form::Label('mode_of_shipment', 'Access to Mode of Shipment') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('shipment_schedule',true,null, array('id'=>'shipment_schedule')) }}
                                                    {!! Form::Label('shipment_schedule', 'Access to Shipment Schedule') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('delivery',true,null, array('id'=>'delivery')) }}
                                                    {!! Form::Label('delivery', 'Access to Delivery') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('payment_terms',true,null, array('id'=>'payment_terms')) }}
                                                    {!! Form::Label('payment_terms', 'Access to Payment Terms') !!}                                        
                                                </div>
                                             </div>
                                        </div>
										<div class="col-md-12">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('access_to_bank',true,null, array('id'=>'access_to_bank')) }}
                                                    {!! Form::Label('access_to_bank', 'Access to Bank') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('port_of_destination',true,null, array('id'=>'port_of_destination')) }}
                                                    {!! Form::Label('port_of_destination', 'Access to Port Of Destination') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('access_to_company',true,null, array('id'=>'access_to_company')) }}
                                                    {!! Form::Label('access_to_company', 'Access to Company') !!}                                        
                                                </div>
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('performa_invoice',true,null, array('id'=>'performa_invoice')) }}
                                                    {!! Form::Label('performa_invoice', 'Access to Performa Invoice') !!}                                        
                                                </div>
												<div class="checkbox checkbox-inline checkbox-primary">
                                                    {{ Form::checkbox('shipment_tracking',true,null, array('id'=>'shipment_tracking')) }}
                                                    {!! Form::Label('shipment_tracking', 'Access to Shipment Tracking') !!}                                        
													{!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
													{!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
													{!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
													{!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
												</div>
                                             </div>
                                        </div>
                                    </div>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                    <a href="{{ route('roles.index')}}" class="btn btn-danger">Cancel</a>
                                <!-- </form> -->
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection