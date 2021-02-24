@extends('layouts.default')

@section('content')
    <div class="page-title">
        <h4>Stock Data Details</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">   
                <div class="actions">
                    <div class="">
                        <a href="{{ route('stocks.index') }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> <span class="title">Stock Entries</span></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                        <tbody>
                            <tr>
                                <td class=''><b>Item Full Name</b></th>
                                <td class=''>{{ $stocks['item_full_name'] }}</td>
								<td class=''><b>Item Short Name</b></th>
								<td class=''>{{ $stocks['item_short_name'] }}</td>
								<td class=''><b>Packing</b></th>
								<td class=''>{{ $stocks['packing'] }}</td>
                            </tr>
							<tr>
                                <td class=''><b>Currency</b></th>
                                <td class=''>{{ isset($stocks['currencies']['name']) ? $stocks['currencies']['name'] : "" }}</td>
								<td class=''><b>Item Type</b></th>
								<td class=''>{{ isset($stocks['item_types']['name']) ? $stocks['item_types']['name'] : "" }}</td>
								<td class=''><b>Master Packing</b></th>
								<td class=''>{{ $stocks['master_packing'] }}</td>
                            </tr>
							<tr>
                                <td class=''><b>Master Bags in a 20Ft Container</b></th>
                                <td class=''>{{ isset($stocks['master_bags_in_20ft_container']) ? $stocks['master_bags_in_20ft_container'] : "" }}</td>
								<td class=''><b>Master Bags in a 40Ft Container</b></th>
								<td class=''>{{ isset($stocks['master_bags_in_40ft_container']) ? $stocks['master_bags_in_40ft_container'] : "" }}</td>
								<td class=''><b>Unit Price</b></th>
								<td class=''>{{ $stocks['unit_price'] }}</td>
                            </tr>
                            <tr>
								<th class=''><b>Status</b></th>
								<td class=''>
											@if ($stocks->status == 1) <span class="text-success"><i class="fa fa-check"></i> Active</span> @endif
											@if ($stocks->status == 2) <span class="text-danger"><i class="fa fa-times"></i> Suspend</span> @endif
											@if ($stocks->status == 3) <span class="text-danger"><i class="fa fa-times"></i> Resigned</span> @endif	
											@if ($stocks->status == 4) <span class="text-warning"><i class="fa fa-times"></i> Hold</span> @endif
								</td>
								<td class=''><b>Created At</b></th>
                                <td class=''>{{ $stocks['created_at'] }}</td>
								<td class=''><b>Modified At</b></th>
                                <td class=''>{{ $stocks['updated_at'] }}</td>	
							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<?php if($isUpdateStatusFlag == true){?>
								{!! Form::model($stocks, ['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'PATCH','route' => ['stocks.update', $stocks->id]]) !!}
                                <div class="row">
									<div class="col-md-6">
                                        <div class="form-group">
											{!! Form::hidden('id', $stocks->id, [ ]); !!}
											{!! Form::hidden('update_remarks', 1, [ ]); !!}
											{!! Form::Label('active', 'Status') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '1', true, ['class'=>'radio','id'=>'rad1']) }}
                                                        <label for="rad1">Active</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '2', true, ['class'=>'radio','id'=>'rad2']) }}
                                                        <label for="rad2">Suspend</label>
                                                    </div>
													<div class="radio radio-inline">
                                                        {{ Form::radio('status','3', true, ['class'=>'radio','id'=>'rad3']) }}
                                                        <label for="rad3">Resigned</label>
                                                    </div>
													<div class="radio radio-inline">
                                                        {{ Form::radio('status', '4', true, ['class'=>'radio','id'=>'rad4']) }}
                                                        <label for="rad4">Hold</label>
                                                    </div>
                                               </div>
                                        </div>
                                    </div>
								</div>
                                {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}	
								<button class="btn btn-primary">Submit</button>
                                <a href="{{ route('stocks.index')}}" class="btn btn-danger">Cancel</a>
                                <button class="btn btn-default">Reset</button>
                                {!! Form::close() !!}
							<?php }?>
@endsection