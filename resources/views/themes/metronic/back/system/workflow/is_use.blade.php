<div class="md-radio-inline">
    <div class="md-radio">
        <input type="radio" {{getCommonCheckShowValue($is_use, 'checked', '')}} id="radio_{{$id_hash}}" name="datatables-tr-open-radio" class="md-radiobtn" data-url="{{ route('admin.workflow.open',$id_hash) }}" data-method="post" data-type="json">
        <label for="radio_{{$id_hash}}">
            <span></span>
            <span class="check"></span>
            <span class="box"></span> 默认 </label>
    </div>
</div>