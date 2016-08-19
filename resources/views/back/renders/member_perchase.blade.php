
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">BM User report not purchase for 2 month ago</h3>
		</div>
		<div class="box-body">
			<form action="{{ route('back.admin.send.mail') }}" method="post">
			<input type="hidden" value="{{ csrf_token() }}" name="_token">
			<table class="table">
	            <thead>
	            	<tr>
			            <th><input type="checkbox" name="checkall"></th>
			            <th>Email</th>
			            <th>Member Code</th>
			            <th>User Refferal</th>
			        </tr>
			    </thead>
			    <tbody>
			    	
			    	
			    	@if (count($data) > 0 )
					@foreach ($data as $item)
					<tr>
                       <td><input class="checkBoxItem" value="{{ $item->id }}" type="checkbox" name="userids[]"></td>
                       <td>{{ $item->email }}</td>
                       <td>{{ $item->membership_number }}</td>
                       <td>{{ $item->user_refferal }}</span></td>
                     
                    </tr>
					@endforeach

					<tr>
						<td colspan="5">
						<button class="btn btn-primary" type="submit" name="">Send mail alert to Upline Member</button>
						</td>
					</tr>
					@else
					<tr>
						<td colspan="5">No BM user not purchase in now to month ago</td>
					</tr>
					@endif
					
					
				</tbody>
          	</table>
          	</form>
		</div>
	</div>
