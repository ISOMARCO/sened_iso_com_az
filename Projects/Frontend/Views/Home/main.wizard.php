<form method="get" action="{{URL::base('home')}}">
<div class="card mt-3">
<div class="card-body">
	<div class="form-group row">
		<div class="col-md-4"><input type="text" name="az" class="form-control" placeholder="Azərbaycan" value="{{Get::az()}}" autocomplete="off"></div>
		<div class="col-md-4"><input type="text" name="en" class="form-control" placeholder="İngilis" value="{{Get::en()}}" autocomplete="off"></div>
		<div class="col-md-4"><input type="text" name="ch" class="form-control" placeholder="Çin" value="{{Get::ch()}}" autocomplete="off"></div>
	</div>
</div>
<div class="card-footer">
	<button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-search"></i></button>
</div>
</div>
</form>
@if(Get::az() || Get::en() || Get::ch())
<table class="table table-bordered mt-3">
<thead>
	<tr>
		<th style="width: 10px">#</th>
		<th>Azərbaycan</th>
		<th>İngilis</th>
		<th>Çin</th>
		<th>Action</th>
	</tr>
</thead>
@foreach($data as $row)
<tbody>
	<td>{{$sayy++}}</td>
	<td>{{$row->w_az}}</td>
	<td>{{$row->w_en}}</td>
	<td>{{$row->w_ch}}</td>
	<td><a href="{{URL::base('words/edit/'.$row->w_id)}}"><i class="fas fa-pen fa-lg"></i></a> &nbsp;<a href="{{URL::base('words/delete/'.$row->w_id)}}" onclick="return confirm('Silmək istədiyinizdən əminsiniz?');"><i class="fas fa-trash fa-lg"></i></a></td>
</tbody>
@endforeach
</table>
@endif