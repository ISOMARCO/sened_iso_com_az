<table class="table table-bordered">
	<thead>
		<tr>
			<th>№</th>
			<th>Action</th>
			<th>Date</th>
			<th>Ip</th>
			<th>User Agent</th>
			<th>Result</th>
			<th>Details</th>
		</tr>
	</thead>
	<tbody>
		@for($i=0;$i<$say;$i++)
		<tr>
			<td>{{$num++}}</td>
			<td>{{logs_icon($logs[$i]->action)}}</td>
			<td>{{$logs[$i]->date}}</td>
			<td>{{$logs[$i]->ip}}</td>
			<td>{{$logs[$i]->user_agent}}</td>
			<td>
				@if($logs[$i]->result)
				<i class="fas fa-check-circle text-success fa-lg"></i>
				@else
				<i class="fas fa-times text-danger"></i>
				@endif
			</td>
			<td>
				@if(!$logs[$i]->details)
				<i class="fas fa-minus-circle fa-lg text-info"></i>
				@else
				{{$logs[$i]->details}}
				@endif
			</td>
		</tr>
		@endfor
	</tbody>
</table>
{{$pagination}}