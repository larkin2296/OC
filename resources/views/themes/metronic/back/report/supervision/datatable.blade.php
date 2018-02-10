<div class="table-tr-buttons">
    <a data-href="{{route('admin.supervision.edit', $id_hash)}}"  data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="立即"><span class="fa fa-chain font-green"></span></a>
    <a data-url="{{route('admin.supervision.destroy', $id_hash)}}"  data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="无需"><span class="fa fa-chain-broken font-green"></span></a>
    <a data-url="{{route('admin.source.download', $id_hash)}}"  data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="其它"><span class="fa fa-gg font-green"></span></a>
</div>