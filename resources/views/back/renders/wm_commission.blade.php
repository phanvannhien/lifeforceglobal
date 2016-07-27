@if (count($data) > 0 )
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">WM report alert for 3 month ago</h3>
		</div>
		<div class="box-body">
			<table class="table">
	            <thead>
	            	<tr>
			            <th style="width: 10px">#</th>
			            <th>Email</th>
			            <th>Member Code</th>
			            <th>Total</th>
			        </tr>
			    </thead>
			    <tbody>
					@foreach ($data as $item)
					<tr>
                      <td style="width: 10px">#</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->membership_number }}</td>
                      <td><span class="badge bg-red">{{ PriceHelper::formatPrice($item->totals) }}</span></td>
                    </tr>
					@endforeach
				</tbody>
          	</table>
		</div>
	</div>

@endif