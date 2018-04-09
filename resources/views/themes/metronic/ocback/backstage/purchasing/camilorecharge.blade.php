@extends('themes.metronic.ocback.backstage.index.query')
@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">卡密充值</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 卡密充值 </p>
            </div>
        </div>
    </div>
@endsection
@section('query')
    <div id="camilo_recharge" >
            <div class="panel form-element-padding" id="add_need">
                <div class="panel-heading">
                    <h4>生成订单</h4>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">商品类型</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="goods_type" v-model="platform">
                                @foreach($goods_type as $val)
                                <option value="{{$val['platform_code']}}">{{$val['platform_name']}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">面额</label>
                        <div class="col-sm-2" >
                            <select class="form-control" v-model="price">
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">数量</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="num" v-model="num">
                        </div>
                        <div class="col-sm-2">
                            <button class="submit btn btn-danger" id='add_camilo_need' v-on:click="add_cart">添加订单</button>
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                </div>
            </div>
@endsection
@section('panel')
            <div class="panel" id="shop_cart">
                <div class="panel-heading">
                    <h3>购物车</h3>
                </div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc"style="width: 60px;"></th>
                                            <th class="sorting" style="width: 60px;">序号</th>
                                            <th class="sorting" style="width: 60px;">商品</th>
                                            <th class="sorting" style="width: 60px;">面额</th>
                                            <th class="sorting"  style="width: 60px;">数量</th>
                                            <th class="sorting"  style="width: 60px;">单价</th>
                                            <th class="sorting"  style="width: 60px;">总价</th>
                                            <th class="sorting"  style="width: 60px;">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for='dat in data_list' role="row" class="odd">
                                            <td class="sorting_1"><input type="checkbox" v-bind:name="dat.id"/></td>
                                            <td v-text="dat.id"></td>
                                            <td v-text="dat.platform"></td>
                                            <td v-text="dat.price"></td>
                                            <td v-text="dat.num"></td>
                                            <td v-text="dat.e_price"></td>
                                            <td v-text="dat.total_price"></td>
                                            <td><input class="submit btn btn-danger" type="submit" v-on:click="del_cart($index)" value="删除"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2" >
                        付款金额：<span v-html="p_total"></span>
                        <input class="submit btn btn-danger" type="submit" value="付款">
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('script')
    <script>
        var a = new Vue({
            el:'#camilo_recharge',
            data:{
                d_num:0,
                price:'',
                platform:'',
                num:'',
                data_list:[],
                p_total:0,
        },
            methods:{
                add_cart:function(event){
                    this.d_num = Number(this.d_num)+1;
                    this.data_list.push({id:this.d_num,platform:this.platform,price:this.price,num:this.num,e_price:this.price,total_price:(Number(this.price)*Number(this.num))});
                },
                del_cart:function(index){
                    this.data_list.splice(index,1);
                }
            },
            computed:{
                total:function(val){
                    for(var i in this.data_list){
                        console.log(this.data_list[i].total_price);
                        val += this.data_list[i].total_price;
                    }
                    this.total = val;
                }
            }
        });
    </script>
    @endsection