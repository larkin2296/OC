@if($list->isNotEmpty())
	@if($first) 
		<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	@else
		<ul class="sub-menu">
	@endif
			@foreach($list as $menu)
				@if(checkMenuPosition($menu->position))
					@include(getThemeTemplate('layout.partical.admin.sidebar.sidebar-li'), ['menu' => $menu, 'highLightMenuIds' => $highLightMenuIds])
				@endif
			@endforeach
		</ul>
@endif