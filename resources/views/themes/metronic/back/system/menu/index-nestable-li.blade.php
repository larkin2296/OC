<li class="dd-item" data-id="{{ $info->id_hash}}">
    <div class="dd-handle"> {{ $info->name}} 
        <div class="pull-right action-buttons dd-nodrag">
            <a class="green" data-target="#php-ajax-modal" data-toggle="modal tooltip" data-placement="bottom" href="{{ route('admin.menu.create', ['id' => $info->id_hash]) }}"  title="新增子菜单">
                <i class="fa fa-plus font-green"></i>
            </a>
            <a class="blue" data-target="#php-ajax-modal" data-toggle="modal tooltip" data-placement="bottom" href="{{ route('admin.menu.edit', $info->id_hash) }}" title="修改">
                <i class="fa fa-pencil font-blue"></i>
            </a>
            <a class="red" href="javascripts:;" data-url="{{ route('admin.menu.destroy', $info->id_hash) }}" data-method="delete" data-confirm="" data-toggle="tooltip" data-placement="bottom" title="删除">
                <i class="fa fa-trash-o font-red"></i>
            </a>
        </div>
    </div>
    @include(getThemeTemplate('back.system.menu.index-nestable-ol'), ['list' => $menuMaps[$info->id]->sonMenus])
</li>