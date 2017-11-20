<h1>Travellsss</h1>

<div class="row">
<table class="table" border='1'>
	<tr>
		<td>
			Start point
		</td>
		<td>
			End point
		</td>
		<td> 
			Price
		</td>
		@foreach($travels as $travel)
	<tr>
		<td>
		{{ $travel->city_start }}				
		</td>
		<td>
			{{ $travel->city_end }}
		</td>
		<td>
			{{ $travel->price }}
		</td>
		
	</tr>
@endforeach
	</table>
	