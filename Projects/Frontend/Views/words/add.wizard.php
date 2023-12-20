<form method="post" action="{{URL::base('words/add_do')}}">
<div class="card">
<div class="card-body">
	<div class="form-group">
		<label for="az">Azərbaycan</label>
		<input type="text" class="form-control" name="az" id="az" required="required" autocomplete="off">
	</div>
	<div class="form-group">
		<label for="en">İngilis</label>
		<input type="text" name="en" id="en" class="form-control" required="required" autocomplete="off">
	</div>
	<div class="form-group">
		<label for="ch">Çin</label>
		<input type="text" name="ch" id="ch" class="form-control" required="required" autocomplete="off">
	</div>
</div>
<div class="card-footer">
	<button type="submit" class="btn btn-primary">Add &nbsp;<i class="fas fa-plus"></i></button>
</div>
</div>
</form>