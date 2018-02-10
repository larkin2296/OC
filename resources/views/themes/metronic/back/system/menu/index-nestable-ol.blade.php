@if($list->isNotEmpty())
	<ol class="dd-list">
		@foreach($list as $info) 
			@include(getThemeTemplate('back.system.menu.index-nestable-li'), ['info' => $info])
		@endforeach
	</ol>	
@endif

