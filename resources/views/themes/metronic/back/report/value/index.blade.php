@extends(getThemeTemplate('layout.admin'))

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('libs/swiper/swiper-4.1.0.min.css') }}">
@endpush

@section('content')
	<div class="portlet light bordered">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="icon-layers font-green"></i>
	            <span class="caption-subject font-green sbold uppercase">报告详情</span>
	        </div>
	    </div>
	    <div class="portlet-body">
	    	{{-- table-toolbar --}}
	        <div class="table-toolbar">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="btn-group pull-right">
	                    	@if($saveBtn)
		                    <a href="javascript:;" class="btn sbold green"><i class="fa fa-save"></i>保存</a>
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-check"></i>提交</a>
		                    @endif
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-chevron-left"></i>回退</a>
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-calendar-check-o"></i>逻辑核查</a>
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-check-square-o"></i>ADR核查</a>
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-cutlery"></i>QC</a>
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-exclamation-triangle"></i>稽查</a>
							<a href="javascript:;" class="btn sbold green"><i class="fa fa-external-link-square"></i>导出</a>
	                    </div>
	                </div>
	            </div>
	        </div>
	        {{-- table-toolbar end --}}
	        {{-- note start --}}
	        <div class="note note-info">
	        	<div class="row">
	        		<div class="col-md-10 clearfix">"201712MS00001" | 中国 | 首次报告 | 自发报告 | 数据录入中 | 张飞 <span class="pull-right">报告倒计时： <i class="label label-sm label-success">7天12时55分</i></span></div>
	        		<div class="col-md-2 text-right">报告优先级: <span class="label label-sm label-success">1级</span></div>
	        	</div>
	        </div>
	        {{-- note end --}}
	        {{-- tab start --}}
	        <div class="tabbable-custom nav-justified">
	        	{{-- tab header --}}
	        	<ul class="nav nav-tabs nav-justified" id="main-tab-header">
	        		@if($tabs->isNotEmpty()) 
	        			@foreach($tabs as $tab)
			        		@include(getThemeTemplate('back.report.value.tab', ['reportId' => $reportId, 'tab' => $tab]))
	        			@endforeach
	        		@endif
                </ul>
	        	{{-- tab header end --}}
	        	{{-- tab content --}}
	        	<div class="tab-content pv-report-tab">
	        		@each(getThemeTemplate('back.report.value.tab-content'),$tabs, 'tab')
	        	</div>
	        	{{-- tab content end --}}
	        </div>
	        {{-- tab end --}}
	    </div>
	</div>
	
@endsection

@push('js')
<script src="{{ asset('libs/swiper/swiper-4.1.0.min.js') }}"></script>
<script>
	$(function(){
		PVJs.tooltip($(document));
		var swipe = function(el){
			return  new Swiper(el, {
				freeMode : true,
				slidesPerView : 'auto',
				freeModeSticky : true ,
			});
		}
		
		$('#main-tab-header').on('click','[data-toggle="tab"]',function(){
			var that = $(this);
			var innerTab = $(this.href).find('.inner-tab');
			var swiperTab = innerTab.find('.tab-header .pv-tab-nav');
			
			if(innerTab.length >0 || !swiperTab.hasClass('swiper-container-horizontal')){
				swipe(swiperTab);
			}
		});
		// 初始化打开第一个tab
		$('#main-tab-header [data-toggle="tab"]')[0].click();
		
	});
	$(function(){
		//内部 tab 切换
        $('#nav-header4 .swiper-slide').click(function(){
            var that = $(this);
            var tab_cont = that.parents('.inner-tab').find('.tab-content .tab-pane');
            var id = that.attr('data-id');
            if(!that.hasClass('pv-tab-nav_on')){
                that.siblings('.pv-tab-nav_on').removeClass('pv-tab-nav_on');
                that.addClass('pv-tab-nav_on')
                tab_cont.removeClass('active in');
                $('#'+id).addClass('active in');
            }
        });
    })
</script>

@endpush