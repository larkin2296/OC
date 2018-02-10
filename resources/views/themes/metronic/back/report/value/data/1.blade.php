@if(isset($datas['col'])) 
	@foreach($datas['col'] as $colDatas)
		<div>{{$colDatas['col_name']}}</div>
		姓名<input type="text" name="name" value="{{isset($colDatas['basic']['name']) ? $colDatas['basic']['name'] : ''}}">

		年龄<input type="text" name="age" value="{{isset($colDatas['basic']['age']) ? $colDatas['basic']['age'] : ''}}">

		<table data-id="1">
			<tr>
				<th>作者</th>
				<th>年份</th>
			</tr>

			<tbody>
				@if(isset($colDatas['tables']) &&$colDatas['tables']['1'])
					@foreach($colDatas['tables']['1'] as $key => $value)
						<tr>
							<td><input type="text" name="author[{{$key}}]" value="{{$value['author']}}"></td>
							<td><input type="text" name="author[{{$key}}]" value="{{$value['year']}}"></td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>

		<button>保存</button>

		<script>

		</script>

	@endforeach
@endif