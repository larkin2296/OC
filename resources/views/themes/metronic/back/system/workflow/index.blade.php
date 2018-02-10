@extends(getThemeTemplate('layout.admin'))

@section('content')
	<div class="portlet light bordered">
		<div class="portlet-body">
			<div class="table-toolbar">
		        <div class="row">
		            <div class="col-md-6">
		                <div class="btn-group">
		                    <a href="{{route('admin.workflow.create')}}" class="btn sbold green"><i class="fa fa-plus"></i>@lang('module/workflow.index.create')</a>
		                </div>
		            </div>
		        </div>
		    </div>
			{!! $html->table() !!}
		</div>
	</div>
@endsection

@push('js')
	<script src="/themes/metronic/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/vendor/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    
    {!! $html->scripts() !!}

    <script>
    	//删除
    	$(document).on('click', '.destroy', function() {
    		$this = $(this);
    		layer.confirm('@lang('module/workflow.index.destroy.confirm')', function(index){
    		  $.ajax({
    		  	url: $this.data('url'),
    		  	type: $this.data('method'),
    		  	dataType: $this.data('type'),
    		  	headers: {
			        'X-CSRF-TOKEN':'{{ csrf_token() }}',
			    },
    		  })
    		  .done(function(res) {
    		  	layer.msg(res.message);
    		  	if(res.result) {
    		  		window.LaravelDataTables['dataTableBuilder'].draw();
    		  	}
    		  })
    		  .fail(function() {
    		  	layer.msg('@lang('module/workflow.index.destroy.destroy')');
    		  })
    		  .always(function(){
	    		  layer.close(index);
    		  });
    		});  
    	});
    </script>
@endpush