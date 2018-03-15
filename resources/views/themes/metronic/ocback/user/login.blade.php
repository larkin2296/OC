<html>
<head></head>
<style>
    html,body{
        width:100%;
        height:100%;
        margin:0px;
        padding:0px;
        background-color: #CFCFCF;
    }
    .contian{
        width:540px;
        height:50em;
        margin:5% auto;

    }
    .re_title{
        width: 100%;
        height: 4em;
        background-color: #87CEFA;
        color:white;
        font-family:"微软雅黑";
        text-align: center;
        font-size: 130%;
        line-height: 4em;
        letter-spacing: 10px;
        border:1px solid #87CEFA;
        border-radius: 10px 10px 0px 0px;
    }
    .re_content{
        width:100%;
        height: 88%;
        background-color: white;
        margin:0px auto;
        border-top:2px solid red;
        border-radius: 0px 0px 10px 10px;
    }
    .re_content form{
        width:80%;
        height:95%;
        margin:0 auto;
        text-align: center;
    }
    .re_content form ul{
        width:100%;
        height:90%;
        margin:0px;
        padding:0px;
    }
    .re_content form ul li{
        width:100%;
        list-style: none;
        height:4em;
        margin-top:2em;
        text-align: left;
        line-height: 4em;
    }
    .re_content form ul li input{
        height:3em;
        border:2px solid #969696;
        border-radius: 5px;
        background-color: #F0F0F0;
    }
    .psd,.psd_check{
        width:9em;
        margin-right:2em;
    }
    .sub{
        width: 15em;
        height: 3em;
        border: none;
        background-color: red;
        color: white;
        border-radius: 10px;
        font-size: 100%;
    }
</style>
@extends(getThemeTemplate('layout.admin'))

@section('content')
<body>
<div class="contian">
    <div class="re_title">
        OC油卡管理平台
    </div>
    <div class="re_content">
        <form>
            <ul>
                <li>账号：<input type="text" class="username" name="username"/></li>
                <li>密码：<input type="password" class="psd" name="psd"/>确认密码：<input type="password" class="psd_check" name="psd_check"/></li>
                <li>地区：<select class="area">

                    </select>
                    <select class="city">

                    </select>
                    <select class="detail_city">

                    </select>
                </li>
                <li>公司：<input type="text" class="company"/></li>
                <li>联系方式：<input type="text" class="connect_number"/></li>
                <li>推荐人账号：<input type="text" class="o_user_code"/></li>
            </ul>
            <input type="submit" class="sub" value="提交"/>
        </form>
    </div>
</div>
</body>
</html>