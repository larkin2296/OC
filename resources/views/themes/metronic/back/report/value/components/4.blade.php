<form data-url="" data-method="" data-type="json">
    <div class="inner-tab">
        <div class="tab-header clearfix">
            <div class="nav-tools pull-right">
                <div class="btn-group">
                    <a href="javascript:;" class="btn blue"><i class="fa fa-plus"></i>添加</a>
                </div>
            </div>
            <div class="pv-tab-nav nav-header4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide pv-tab-nav_on" data-id="inner-tab4_1">
                        <span class="font-txt">泰莉莎</span>  
                        <span class="pv-tab-close badge badge-danger" title="删除"><i class="fa fa-close font-white"></i></span>
                    </div>
                    <div class="swiper-slide" data-id="inner-tab4_2">
                        <span class="font-txt">泰莉莎</span>  
                        <span class="pv-tab-close badge badge-danger" title="删除"><i class="fa fa-close font-white"></i></span>
                    </div>
                    <div class="swiper-slide" data-id="inner-tab4_3">
                        <span class="font-txt">泰莉莎</span>  
                        <span class="pv-tab-close badge badge-danger" title="删除"><i class="fa fa-close font-white"></i></span>
                    </div>
                </div>
             </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="inner-tab4_1">
                @for ($i = 1; $i <= 3; $i++)
                    @include(getThemeTemplate('back.report.value.components.' . $tab->id . '-' . $i ))
                @endfor
            </div>
            <div class="tab-pane fade" id="inner-tab4_2">2</div>
            <div class="tab-pane fade" id="inner-tab4_3">3</div>
        </div>
    </div>
</form>