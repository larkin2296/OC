<div class="input-group-btn">
    <select class="form-control unit-select-event" style="min-width: 80px;">
        <option value="d" @if(isset($regulation->unit) && $regulation->unit =='d') checked @endif>天</option>
        <option value="h" @if(isset($regulation->unit) && $regulation->unit =='h') checked @endif>小时</option>
    </select>
</div>