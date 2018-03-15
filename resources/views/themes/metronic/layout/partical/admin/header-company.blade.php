<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN PAGE ACTIONS -->
<!-- DOC: Remove "hide" class to enable the page header actions -->
<div class="page-actions">
    <div class="btn-group">
        <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="hidden-sm hidden-xs">切换公司&nbsp;</span>
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('admin.company.exchange', 0) }}">
                    <i class="icon-share"></i> 管理员界面 </a>
            </li>
            <li class="divider"> </li>
            @if($headerCompanies)
                @foreach($headerCompanies as $company)
                    <li>
                        <a href="{{ route('admin.company.exchange', $company->id_hash) }}">
                            <i class="icon-share"></i> {{ $company->name }} </a>
                    </li>
                    <li class="divider"> </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
<!-- END PAGE ACTIONS -->