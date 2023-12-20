@if(empty($error))
<form method="post" id="add_form">
<div class="card card-success mt-2">
	<div class="card-header"><h5><b><i class="fas fa-plus"></i> Manifest əlavə et</b></h5></div>
	<div class="card-body">
		<label for="siyahi">Adlar</label>
		<textarea class="form-control" rows="30" name="siyahi" id="siyahi"></textarea>
	</div>
	<div class="card-footer"><button type="button" class="btn btn-primary" id="add_btn"><i class="fas fa-plus"></i> Əlavə et</button></div>
</div>
</form>
<script>
$(document).ready(function(){
	$("#add_btn").on("click",function(){
		$.ajax({
			type:"post",
			url:"{{URL::base('manifest/add_do')}}",
			data:$("#add_form").serialize(),
			dataType:"json",
			success:function(e){
				alert(e.ok);
				setTimeout(function(){window.location.href="{{URL::base('manifest')}}";},1500);
			}
		});
	});
});
</script>
@else
<div class="alert alert-danger mt-3">{{$error}}</div>
<button class="btn btn-danger" id="manifest_sil"><i class="fas fa-trash-alt"></i> Sil</button>
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
@endif