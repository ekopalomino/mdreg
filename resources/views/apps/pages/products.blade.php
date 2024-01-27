@extends('apps.layouts.main')
@section('header.title')
Asset Management | Asset Database
@endsection
@section('header.styles')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-database"></i>Asset Database 
                    </div>
                </div>
                <div class="portlet-body">
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
                    @can('Can Create Asset')
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="{{ route('asset.create') }}"><button id="sample_editable_1_new" class="btn red btn-outline sbold"> Add New
                            </button></a>
                            <a href="{{ route('asset.page') }}"><button id="sample_editable_2_new" class="btn blue btn-outline sbold"> Import Excel
                            </button></a>
                        </div>
                    </div>
                    @endcan
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                                <th>Product EPC</th>
                                <th>SAP Code</th>
                                <th>Image</th>
                				<th>Name</th>
                                <th>Category</th>
                                <th>Branch</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Status</th>
                				<th>Doc User</th>
                				<th>Doc Date</th>
                				<th></th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $product)
                			<tr>
                				<td>{{ $key+1 }}</td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sap_code }}</td>
                                <td><img src="http://fibertekno.iteos.tech/public/products/{{$product->image}}" width="75" height="100" ></td>
                				<td>{{ $product->name }}</td>
                                <td>{{ $product->Categories->name }}</td>
                                <td>{{ $product->Branches->name }}</td>
                                <td>{{ $product->Departments->name }}</td>
                                <td>{{ $product->Locations->location_name }}</td>
                                <td>
                                    @if(!empty($product->deleted_at))
                                    <label class="label label-sm label-danger">Inactive</label>
                                    @else
                                    <label class="label label-sm label-success">Active</label>
                                    @endif
                                </td>
                				<td>{{ $product->Author->name }}</td>
                                <td>{{date("d F Y H:i",strtotime($product->updated_at)) }}</td>
                				<td>
                                    <a class="btn btn-xs btn-success" href="{{ route('asset.show',$product->id) }}" title="Show Product" ><i class="fa fa-search"></i></a>
                                    @can('Can Edit Asset')
                                    <a class="btn btn-xs btn-success" href="{{ route('asset.edit',$product->id) }}" title="Edit Product" ><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('Can Delete Asset')
                                    {!! Form::open(['method' => 'POST','route' => ['asset.destroy', $product->id],'style'=>'display:inline','onsubmit' => 'return ConfirmDelete()']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>',['type'=>'submit','class' => 'btn btn-xs btn-danger','title'=>'Disable Product']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                			</tr>
                            @endforeach
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
<script>
    function ConfirmDelete()
    {
    var x = confirm("Are you sure you want to deactivate?");
    if (x)
        return true;
    else
        return false;
    }
</script>
@endsection