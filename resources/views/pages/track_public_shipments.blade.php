@extends('layouts.master')
@section('content')
<style type="text/css">
	.table > thead > tr > th {padding: 5px;}
	.table > tbody > tr > td {padding: 8px;}
</style>
<div class="container-fluid">
<div class="page-title">
	<h4>Track Your Shipment</h4>
</div>
<div class="row" @if($is_show_input_search == true) style="display:block;" @else style="display:none;"  @endif>
	<div class="col-md-12">
		<div id="accordion-1" class="accordion panel-group" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div id="collapseOne" class="panel-collapse collapse show">
					<div class="panel-body pad-no">
						<div class="col-md-12" style="padding:20px;">
							{!! Form::open(['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'GET']) !!}
								 <div class="row">
									<div class="col-md-4">
										<div class="form-group">
											{!! Form::text('invoice_id', Input::get('invoice_id'), ['class' => 'form-control', 'placeholder'=>'Search By PI umber','required']) !!}
											{!! Form::hidden('is_from_menu',1) !!}
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<button class="btn btn-danger btn-sm"><i class="fa fa-filter"></i>&nbsp;Search</button>&nbsp;&nbsp;
										</div>
									</div>
								</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	 </div>
</div>
<?php if(count($sts_transactions) > 0){ ?>   
<div class="row" @if($is_show_hide_view == true) style="display:block;" @else style="display:none;"  @endif>
	<div class="col-md-12">
		<div class="card">
			<div class="card-block" id="print_invoice">
				<div class="row">
					<div class="col-md-6">
						<p>
							<b class="text-dark" style="font-size:15px;">PI Number:<span class=""> {{ $invoices['invoice_number'] }}</span></b><br>
							<b class="text-dark">Date:</b><span class=""> {{ date('l, F d Y',strtotime($invoices['invoice_date'])) }}</span><br>
							<b class="text-dark">Delivery :</b> <span class=""> {{ isset($invoices['deliveries']['name']) ? $invoices['deliveries']['name'] : "" }}</span></br>
							<b class="text-dark">Country of Origin </b>: <span class="">{{ isset($invoices['countries']['name']) ? $invoices['countries']['name'] : "" }}</span></br>
							<b class="text-dark">Port of Destination </b>: <span class="">{{ isset($invoices['port_of_destinations']['name']) ? $invoices['port_of_destinations']['name'] : "" }}</span></br>
							<b class="text-dark">Customer Name</b>: <span class="">{{ isset($invoices['customers']['short_name']) ? $invoices['customers']['short_name'] : "" }}</br>
						</p>
					</div>
					<!--<div style="" class="col-md-6">
						<p class="pull-right">
							<b class="text-dark">Country of Origin </b>: <span class="">{{ isset($invoices['countries']['name']) ? $invoices['countries']['name'] : "" }}</span></br>
							<b class="text-dark">Port of Destination </b>: <span class="">{{ isset($invoices['port_of_destinations']['name']) ? $invoices['port_of_destinations']['name'] : "" }}</span></br>
							<b class="text-dark">Customer Name & Address </b>: <span class="">{{ isset($invoices['customers']['short_name']) ? $invoices['customers']['short_name'] : "" }}</br>{{ isset($invoices['buyer_name_address']) ? $invoices['buyer_name_address'] : "" }}</span>
						</p>
					</div>-->	
				</div>				
				<div class="table-overflow">
					<table class="table table-bordered table-hover table-sm">
						<tbody>
						<?php $serial_number = count($sts_transactions); ?>
						@foreach ($stsDatewise as $stsDate => $sts_transactions)
							<tr>
								<th class="text-dark">{{ date('l, F d Y',strtotime($stsDate)) }} </th>
								<th class="text-dark">Activity </th>
								<th class="text-dark">Location </th>
								<th class="text-dark">Time</th>
								<th class="text-dark">Remarks for Customers</th>
								<th class="text-dark">Attachments</th>
							</tr>
							@foreach ($sts_transactions as $key => $cData)
							<tr>
								<td>
									<div class="mrg-top-5">
											<span>
											{{ $serial_number }}
											</span>
									</div>
								</td>
								<td>
									<div class="mrg-top-5">
										<span>
										{{ isset($cData['sts_activities']['name']) ? $cData['sts_activities']['name'] : "" }}
										</span>
									</div>
								</td>
								<td>
									<div class="mrg-top-5">
										<span>
										{{ isset($cData['location']) ? $cData['location'] : "" }}
										</span>
									</div>
								</td>
								<td>
									<div class="mrg-top-5">
										<span>
										{{ isset($cData['created_at']) ? date("H:i:s",strtotime($cData['created_at'])) : "" }}
										</span>
									</div>
								</td>
								<td>
									<div class="mrg-top-5">
										<span>
										{{ isset($cData['public_remark']) ? $cData['public_remark'] : "" }}
										</span>
									</div>
								</td>
								<td>
									<div class="mrg-top-5">
                                            <?php  if(isset($cData['attachment_file'])  && !empty($cData['attachment_file'])) {
												$files = explode(",",$cData['attachment_file']);
												foreach($files as $file_path) {
													if($file_path != ""){
												?> 
												<a  class="btn btn-success btn-sm" target="__blank" href="{{ secure_asset('/storage/app/sts_transaction_attachments/') }}/<?php echo $file_path; ?>" data-toggle="tooltip" title="<?php echo $file_path; ?>" ><i class="fa fa-download"></i></a>
											<?php } } }?>
                                    </div>
								</td>
							</tr>
							<?php $serial_number--; ?>
							@endforeach
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }else {?>
<div class="row" @if($is_show_hide_view == true) style="display:block;" @else style="display:none;"  @endif>
	<div class="col-md-6">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>No STS Transaction Found.</strong>
		</div>
	</div>
</div>
<?php }?>
</div> 
@endsection