姓名<input type="text" name="name" value="{{isset($datas['basic']['name']) ? $datas['basic']['name'] : ''}}">

年龄<input type="text" name="age" value="{{isset($datas['basic']['age']) ? $datas['basic']['age'] : ''}}">

<table data-id="1">
	<tr>
		<th>作者</th>
		<th>年份</th>
	</tr>

	<tbody>
		@if(isset($datas['tables']) && $datas['tables']['1'])
			@foreach($datas['tables']['1'] as $key => $value)
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