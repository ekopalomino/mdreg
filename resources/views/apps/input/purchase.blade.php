@extends('apps.layouts.main')
@section('header.title')
Fiber Tekno | Add Purchase Request
@endsection
@section('header.plugins')
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
    <div class="portlet box red ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i> Form Permintaan Pembelian 
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
            {!! Form::open(array('route' => 'request.store','method'=>'POST', 'class' => 'horizontal-form')) !!}
            @csrf
            <div class="form-body">
            	<div class="row">
            		<div class="col-md-5">
            			<div class="form-group">
            				<label class="control-label">Supplier</label>
            				{!! Form::select('supplier_code', [null=>'Please Select'] + $suppliers,[], array('class' => 'form-control')) !!}
            			</div>
            		</div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Estimasi Penerimaan</label>
                    {!! Form::date('delivery_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
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
	            					<th></th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<tr>
	            					<td>{!! Form::text('product[]', null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control','required')) !!}</td>
                    				<td>{!! Form::text('quantity[]', null, array('placeholder' => 'Jumlah','class' => 'form-control','required')) !!}</td>
                    				<td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control','required')) !!}</td>
                    				<td>{!! Form::text('purchase_price[]', null, array('placeholder' => 'Harga Satuan','class' => 'form-control','required')) !!}</td>
                    				<td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td>
	            				</tr>
	            			</tbody>
	            		</table>
	            	</div>
            	</div>
            	<div class="form-actions right">
                    <a button type="button" class="btn default" href="{{ route('purchase.index') }}">Cancel</a>
                    <button type="submit" class="btn blue">
                    <i class="fa fa-check"></i> Save</button>
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets//global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/form-samples.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){      
      var route = "{{ route('purchase.product') }}";
      $("input[name^='product']").typeahead({
        source:  function (product, process) {
            return $.get(route, { product: product }, function (data) {
                    return process(data);
                });
            }
      }); 
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#sample_2').append('<tr id="row'+i+'" class="dynamic-added"><td>{!! Form::text('product[]', null, array('placeholder' => 'Produk','id' => 'product','class' => 'form-control','required')) !!}</td><td>{!! Form::text('quantity[]', null, array('placeholder' => 'Jumlah','class' => 'form-control')) !!}</td><td>{!! Form::select('uom_id[]', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}</td><td>{!! Form::text('purchase_price[]', null, array('placeholder' => 'Harga Satuan','class' => 'form-control')) !!}</td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>').find('input[type=text]').typeahead({
                source:  function (product, process) {
                return $.get(route, { product: product }, function (data) {
                    return process(data);
                });
            } 
             }); 
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });    
    });  
</script>
@endsection