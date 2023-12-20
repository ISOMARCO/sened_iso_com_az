<div class="card card-success mt-2">
	<div class="card-header">
		<a href="{{URL::base('manifest/add')}}" class="btn btn-danger"><i class="fas fa-users"></i> Adlar Əlavə Et</a>
		<a href="{{URL::base('manifest/add_say')}}" class="btn btn-primary"><i class="fas fa-list-ol"></i> Say Əlavə Et</a>
		<a href="{{URL::base('manifest/add_kilo')}}" class="btn btn-secondary"><i class="fas fa-balance-scale-right"></i> Kilo Əlavə Et</a>
		<a href="{{URL::base('manifest/add_hecm')}}" class="btn btn-warning"><i class="fas fa-cube"></i> Həcm Əlavə Et</a>
		<a href="{{URL::base('manifest/add_tercume')}}" class="btn btn-info"><i class="fas fa-language"></i> Tərcümələri Əlavə Et</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead class="table-secondary">
				<tr>
					<th>#</th>
					<th>Adlar</th>
					<th>Telefon</th>
					<th>Saylar</th>
					<th>Kilo</th>
					<th>Həcm</th>
					<th>Tərcümə</th>
				</tr>
			</thead>
			<tbody>
				@if($adlar != false)
				@for($i=0;$i< count($adlar);$i++)
				<tr>
					<th>{{$i+1}}</th>
					<th>{{siyahi()[$i]}}</th>
					<th>{{siyahi("tel")[$i]}}</th>
					@if($saylar != false)
					<th>{{$saylar[$i]}}</th>
					@else
					<th>-</th>
					@endif
					@if($kilo != false)
					<th>{{$kilo[$i]}}</th>
					@else
					<th>-</th>
					@endif
					@if($hecm != false)
					<th>{{$hecm[$i]}}</th>
					@else
					<th>-</th>
					@endif
					@if($tercume != false)
					<th>{{$tercume[$i]}}</th>
					@else
					<th>-</th>
					@endif
				</tr>
				@endfor
				@else
				<div class="alert alert-warning">Manifest əlavə edilməyib.</div>
				@endif
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-md-6"><button class="btn btn-danger" id="manifest_sil"><i class="fas fa-trash-alt"></i> Sil</button></div>
			<div class="col-md-6"><a href="{{URL::base('excel')}}" class="btn btn-success" id="excel" onclick="return confirm('Yükləmək istədiyinizə əminsiniz?')"><i class="fas fa-download"></i> Manifest</a></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#manifest_sil").on("click",function(){
		if(confirm("Silmək istədiyinizə əminsiniz?")){
			$.ajax({
			type:"post",
			url:"{{URL::base('manifest/delete')}}",
			success:function(e){
				alert(e);
				setTimeout(function(){window.location.href="{{URL::base('manifest')}}";},1500);
			}
			});
		}
		
	});
});
</script>
