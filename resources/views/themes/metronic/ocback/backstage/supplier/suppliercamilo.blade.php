@extends('themes.metronic.ocback.backstage.index.query')
@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">卡密供货</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 卡密供货 </p>
            </div>
        </div>
    </div>
@endsection
@section('choose')
    <div class="panel form-element-padding">
        <div class="panel-heading">
            <h4>油卡平台选择</h4>
        </div>
        <div class="panel-body" style="padding-bottom:30px;">
            @include('themes.metronic.ocback.backstage.index.platform')
        </div>
    </div>
    @endsection

@section('panel')
    <div class="panel">
        <div class="panel-heading">
            <h3>提交卡密</h3>
        </div>
        <div class="panel-body" style="height: 500px;overflow-y:scroll;">
            <div class="responsive-table">
                <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="large">您当前选择是：</div>
                            <div class="c_title large"></div>
                            {!! Form::open(['url'=>'','class'=>'sub_form']) !!}
                            <ul>
                                <li v-for="add_data in data_list">
                                    卡密：
                                    <input type="text" class="camilo" v-model="add_data.c_camilo" v-bind:name="add_data.c_name"/>
                                    金额：
                                    <input type="text" class="price" v-model="add_data.p_price" v-bind:name="add_data.p_name"/>
                                </li>
                            </ul>
                            {!! Form::hidden("platform","",array('class'=>'platform large')) !!}
                            卡密：
                            {!! Form::text("camilo_detail","",['class'=>'camilo','v-model'=>'camilo']) !!}
                            金额：
                            {!! Form::text("price","",['class'=>'price','v-model'=>'price']) !!}
                            {!! Form::button('添加',['class'=>'submit btn btn-danger add_button','v-on:click'=>'addmessage']); !!}
                            <div>
                                {!! Form::submit('提交',['class'=>'submit btn btn-danger']); !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection

@section('script')
<script>
    new Vue({
        el:'.sub_form',
        data:{
            num:0,
            data_list:[]
        },
        methods:{
            addmessage:function(){
                this.num = Number(this.num)+1;
                this.data_list.push({c_camilo:this.camilo,p_price:this.price,c_name:'camilo_detail_'+(this.num),p_name:'price_'+(this.num)});
                this.camilo = '';
                this.price = '';
            },
            modify_message:function(){

            },
            submit:function(){
                console.log(this.data_list);
            }
        }
    })
    $('.p_choose').click(function(){
        $('.c_title').html($(this).val());
        $('.platform').val($(this).attr('id'));
    })
    {{--$('.add_button').click(function(){--}}

        {{--var detail = $('.camilo_detail').val();--}}
        {{--var price = $('.price').val();--}}
        {{--var html = '';--}}
        {{--html += "卡密：{{ Form::text("camilo_detail","",array('class'=>'camilo')) }}";--}}
        {{--html += '金额：{{Form::text("price","",array('class'=>'price'))}}';--}}
        {{--html += '{{Form::button('修改',['class'=>'submit btn btn-danger modify_button'])}}';--}}
        {{--$('.s_table').append(html);--}}
    {{--})--}}
</script>
    @endsection

@section('css')
    <style>
        .large{
            font-size:20px;
        }
        .c_title{
            padding-bottom:50px;
        }
    </style>
    @endsection