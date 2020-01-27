@extends('apps.layouts.main')
@section('header.title')
Fiber Tekno | Edit Sales Order 
@endsection
@section('header.plugins')
<link href="{{ asset('public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
    <div class="portlet box red ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i> Form Edit Sales Order 
            </div>
        </div>
        <div class="portlet-body form">
            @if (count($errors) > 0) 
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="form-body">
                {!! Form::model($data, ['method' => 'POST','route' => ['sales.update', $data->id],'class' => 'horizontal-form']) !!}
                @csrf
            	<div class="row">
            		<div class="col-md-5">
            			<div class="form-group">
            				<label class="control-label">ID Pelanggan</label>
                            {!! Form::text('client_code', null, array('class' => 'form-control','readonly'=>'true')) !!}
                        </div>
            		</div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Ubah Tgl Pengiriman</label>
                            {!! Form::date('delivery_date', old('delivery_date'), array('id' => 'datepicker','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Catatan</label>
                            {!! Form::textarea('notes', null, array('id' => 'datepicker','class' => 'form-control')) !!}
                        </div>
                    </div>
            		<!--/span-->
            	</div>
                <div class="row">
            		<div class="col-md-12">
	            		<table class="table table-striped table-bordered table-hover" id="sample_2">
	            			<thead>
	            				<tr>
                                    <th>Produk</th>
	            					<th>Jumlah</th>
	            					<th>Satuan</th>
	            					<th>Harga Satuan</th>
                                    <th>Diskon (Rp)</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th></th>
                                </tr>
	            			</thead> 
	            			<tbody>
                                @foreach($items as $key=>$item)
	            				<tr>
                                    <td>{!! Form::text('product_name[]',$item->product_name, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', $item->quantity, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', $uoms,old('uom_id'), array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', $item->sale_price, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', $item->discount, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        {{ Form::hidden('id', $key+1) }}
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                @endforeach
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
                                <tr>
                                    <td>{!! Form::text('product_name[]',null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('kuantitas[]', null, array('placeholder' => 'Quantity','class' => 'form-control')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td>
                    				<td>{!! Form::number('sale_price[]', null, array('placeholder' => 'Harga','class' => 'form-control')) !!}</td>
                                    <td>{!! Form::number('discount[]', null, array('placeholder' => 'Diskon','class' => 'form-control')) !!}</td>
                                    <td>
                                        <input type="button" value="Delete" class="btn red" onclick="deleteRow(this)">
                                    </td>
                    			</tr>
	            			</tbody>
	            		</table>
	            	</div>
            	</div>
            	<div class="form-actions right">
                    <a button type="button" class="btn default" href="{{ route('sales.index') }}">Cancel</a>
                    <button type="submit" class="btn blue">
                    <i class="fa fa-check"></i> Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('public/assets//global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('public/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/form-samples.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){ 
    var route = "{{ route('sales.product') }}";
    $("input[name^='product']").typeahead({
        source:  function (product, process) {
            return $.get(route, { product: product }, function (data) {
                    return process(data);
                });
            }
      });     
    });  
</script>
<script>
function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("sample_2").deleteRow(i);
}
</script>
@endsection