<!DOCTYPE html>
@extends('themes.metronic.ocback.backstage.public.css.p_css')
@yield('p_css')

<body id="mimin" class="dashboard">
<!-- start: Header -->
<!-- end: Header -->

  <!-- end: Left Menu --> 
  
  <!-- start: content -->
  <div id="content">
    <div class="panel">
      <div class="panel-body">
        <div class="col-md-12">
          <h3 class="animated fadeInLeft">油卡查询</h3>
          <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 油卡查询 </p>
        </div>
      </div>
    </div>
    <div class="col-md-12 padding-0 form-element">
      <div class="col-md-12">
       <div class="panel form-element-padding">
            <div class="panel-heading">
              <h4>查询条件</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="form-group">
                  <label class="col-sm-1 control-label text-right">订单类型</label>
                  <div class="col-sm-2">
                    <select class="form-control">
                                @foreach($order_type as $order)
                                <option value="{{$order['value']}}" id="{{$order['key_word']}}">{{$order['chinese']}}</option>
                                @endforeach
                    </select>
                  </div>
                  <label class="col-sm-1 control-label text-right">卡号</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-1 control-label text-right">省份</label>
                  <div class="col-sm-2">
                    <select class="form-control">
                                    <option>option one</option>
                                    <option>option two</option>
                                    <option>option three</option>
                                    <option>option four</option>
                                  </select>
                  </div>
                  <label class="col-sm-1 control-label text-right">姓名</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control">
                  </div>
                  <label class="col-sm-1 control-label text-right">编号</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-sm-2">
                    <input class="submit btn btn-danger" type="submit" value="提交">
                  </div>
                </div>
            </div>
          </div>
        <div class="panel">
          <div class="panel-heading">
            <h3>查询结果</h3>
          </div>
          <div class="panel-body">
            <div class="responsive-table">
              <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                  <div class="col-sm-12">
                    <table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
                      <thead>
                        <tr role="row">
                          <th class="sorting_asc"style="width: 60px;">订单号</th>
                          <th class="sorting" style="width: 60px;">油卡信息</th>
                          <th class="sorting" style="width: 60px;">订单修改时间</th>
                          <th class="sorting" style="width: 60px;">订单状态</th>
                          <th class="sorting"  style="width: 60px;">查看截图</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row" class="odd">
                          <td class="sorting_1">Airi Satou</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>33</td>
                          <td>2008/11/28</td>
                        </tr>
                        <tr role="row" class="even">
                          <td class="sorting_1">Angelica Ramos</td>
                          <td>Chief Executive Officer (CEO)</td>
                          <td>London</td>
                          <td>47</td>
                          <td>2009/10/09</td>
                        </tr>
                        <tr role="row" class="odd">
                          <td class="sorting_1">Ashton Cox</td>
                          <td>Junior Technical Author</td>
                          <td>San Francisco</td>
                          <td>66</td>
                          <td>2009/01/12</td>
                        </tr>
                        <tr role="row" class="even">
                          <td class="sorting_1">Bradley Greer</td>
                          <td>Software Engineer</td>
                          <td>London</td>
                          <td>41</td>
                          <td>2012/10/13</td>
                        </tr>
                        <tr role="row" class="odd">
                          <td class="sorting_1">Brenden Wagner</td>
                          <td>Software Engineer</td>
                          <td>San Francisco</td>
                          <td>28</td>
                          <td>2011/06/07</td>
                        </tr>
                        <tr role="row" class="even">
                          <td class="sorting_1">Brielle Williamson</td>
                          <td>Integration Specialist</td>
                          <td>New York</td>
                          <td>61</td>
                          <td>2012/12/02</td>
                        </tr>
                        <tr role="row" class="odd">
                          <td class="sorting_1">Bruno Nash</td>
                          <td>Software Engineer</td>
                          <td>London</td>
                          <td>38</td>
                          <td>2011/05/03</td>
                        </tr>
                        <tr role="row" class="even">
                          <td class="sorting_1">Caesar Vance</td>
                          <td>Pre-Sales Support</td>
                          <td>New York</td>
                          <td>21</td>
                          <td>2011/12/12</td>
                        </tr>
                        <tr role="row" class="odd">
                          <td class="sorting_1">Cara Stevens</td>
                          <td>Sales Assistant</td>
                          <td>New York</td>
                          <td>46</td>
                          <td>2011/12/06</td>
                        </tr>
                        <tr role="row" class="even">
                          <td class="sorting_1">Cedric Kelly</td>
                          <td>Senior Javascript Developer</td>
                          <td>Edinburgh</td>
                          <td>22</td>
                          <td>2012/03/29</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end: content -->
@extends('themes.metronic.ocback.backstage.public.js.p_js')
@yield('p_js')
</body>
</html>