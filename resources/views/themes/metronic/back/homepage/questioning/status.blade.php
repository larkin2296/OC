@if($status == 0)
<span class="label label-sm label-danger">已关闭</span>
@elseif($status == 1)
<span class="label label-sm label-info">已发送</span>
@elseif($status == 2)
<span class="label label-sm label-success">进行中</span>
@endif