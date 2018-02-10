
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        @include(getThemeTemplate('layout.partical.admin.sidebar.sidebar-ul'), ['list' => $sidebarMenus, 'first' => true, 'highLightMenuIds' => $highLightMenuIds, 'sidebarMenuMaps' => $sidebarMenuMaps])
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR