<div class="card mt-2">
	@if($folder_say == 0)
	<div class="card-header">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Azərbaycanca</th>
					<th>İngiliscə</th>
					<th>Çincə</th>
					<th>Say</th>
					<th>NO.PCS</th>
					<th>KGS</th>
					<th>CBM</th>
					<th>Alıcılar</th>
					<th>Başlanğıc</th>
					<th>Son</th>
				</tr>
			</thead>
			<tbody>
				<span class="error-msg"></span>
				<form method="post" id="sened_info">
				<tr>
					<td><input type="text" name="az" class="form-control" value="{{$fileinfo->az}}"></td>
					<td><input type="text" name="en" class="form-control" value="{{$fileinfo->en}}"></td>
					<td><input type="text" name="ch" class="form-control" value="{{$fileinfo->ch}}"></td>
					<td><input type="text" name="say" class="form-control" value="{{$fileinfo->say}}"></td>
					<td><input type="text" name="no_pcs" class="form-control" value="{{$fileinfo->no_pcs}}"></td>
					<td><input type="text" name="kg" class="form-control" value="{{$fileinfo->kg}}"></td>
					<td><input type="text" name="cbm" class="form-control" value="{{$fileinfo->cbm}}"></td>
					<td><input type="text" name="alicilar" class="form-control" value="{{$fileinfo->alicilar}}"></td>
					<td><input type="number" name="start" class="form-control" value="{{$fileinfo->start}}"></td>
					<td><input type="number" name="end" class="form-control" value="{{$fileinfo->end}}"></td>
				</tr>
			</tbody>
		</table>
		<div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="tercume">
            <label for="customCheckbox2" class="custom-control-label">Tərcümə olunsun</label>
        </div>
		<button type="button" class="btn btn-success" id="sened_info_btn"><i class="far fa-save"></i> Yadda Saxla</button>
		</form>
		<form method="post" enctype="multipart" id="upload_form" action="{{URL::base('fileupload/do')}}">
		 <label for="file" id="file_display" class="btn btn-success" style="display:none;"><input type="file" name="file" id="file" style="display:none"> <i class="far fa-file-excel"></i> Sənəd Yüklə</label>
		</form>
	</div>
	@endif
	<div class="card-body">
		<!-- <div class="alert alert-warning">Heç bir sənəd yüklənmiyib!</div> -->
		@for($i=0;$i<$folder_say;$i++)
		<div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Sənəd</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Sənəd adı</th>
                    <th>Sənəd ölçüsü</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$folder[$i]}}</td>
                    <td>- KB</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
						@if($fileinfo->tercume==0)
                      	<a href="{{URL::base('uploadmanifest')}}" class="btn btn-success"><i class="fas fa-file-excel"></i> Manifest</a>
                        <a href="{{URL::base('uploadinv')}}" class="btn btn-success delete_file"><i class="fas fa-file-excel"></i> Invoice</a>
                        @else 
						<a href="{{URL::base('uploadtranslate')}}" class="btn btn-success"><i class="fas fa-language"></i></a>
						@endif
						<button class="btn btn-danger" id="delete_file"><i class="fas fa-trash"></i> Sil</button>
                      </div>
                    </td>
                 </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
		@endfor
	</div>
	<div class="card-footer"><b><i class="far fa-clock"></i> {{date("H:i")}}</b></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#file").change(function(){
			let files = new FormData(), url = "{{URL::base('fileupload/do')}}";
			files.append('file', $('#file')[0].files[0]);
			$.ajax({
				type:"post",
				url:url,
				processData:false,
				contentType:false,
				data:files,
				success:function(e){
					alert(e);
					setTimeout(function(){window.location.href="{{URL::base('fileupload')}}";},1000);
				}
			});
		});
		$("#sened_info_btn").on("click",function(){
			$.ajax({
				type:"post",
				url:"{{URL::base('fileupload/file_info')}}",
				data:$("#sened_info").serialize(),
				dataType:"json",
				success:function(e){
					if(e.error){
						$(".error-msg").text(e.error);
						$(".error-msg").css({"color":"red","font-weight":"bold"});
					} else if(e.ok){
						$("#file_display").removeAttr("style");
						$("#sened_info_btn").hide();
						$(".error-msg").text("Sənəd Yükləyə bilərsiniz.");
						$(".error-msg").css({"color":"green","font-weight":"bold"});
					}
				}
			});
		});
		$("#delete_file").on("click",function(){
			if(confirm("Silmək istədiyinizdən əminsiniz?")){
				window.location.href="{{URL::base('fileupload/delete')}}";
			}
		});
	});
</script>