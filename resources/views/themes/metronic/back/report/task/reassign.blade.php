<form action="{{route('admin.report.task.reassign', [1])}}" method="post">
	{{csrf_field()}}
	人员 : 
	<select name="task_user_id">
		<option value="">aaa</option>
		<option value="">bbb</option>
	</select>

	<input type="submit" value="保存">
</form>