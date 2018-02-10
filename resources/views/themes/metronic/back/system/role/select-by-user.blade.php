<div>
	@if($roles->isNotEmpty())
		@foreach($roles as $role)
			<input @if(in_array($role->id, $selected)) checked @endif type="checkbox" name="role[]" value="{{ $role->id }}">{{$role->name}}
		@endforeach
	@endif
</div>