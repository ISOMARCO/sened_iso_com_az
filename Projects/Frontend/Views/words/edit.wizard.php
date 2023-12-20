<form method="post" action="{{URL::base('words/edit_do')}}">
<div class="card mt-5">
	<div class="card-body">
	<div class="form-group">
	<label for="az">Azərbaycan</label>
	<input type="text" class="form-control" id="az" placeholder="Azərbaycan" name="az" required="required"value="{{$w->w_az}}">
	</div>
	<div class="form-group">
	<label for="en">İngilis</label>
	<input type="text" class="form-control" id="en" placeholder="İngilis" name="en" required="required"value="{{$w->w_en}}">
	</div>
	<div class="form-group">
	<label for="ch">Çin</label>
	<input type="text" class="form-control" id="ch" placeholder="Çin" name="ch" required="required"value="{{$w->w_ch}}">
	</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Edit</button>
	</div>
</div> 
<input type="hidden" name="id" value="{{$id}}">
</form>