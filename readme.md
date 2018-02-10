# readme

## 配置文件
后台通用配置路径 ```config/back/global.php```
后台缓存配置路径 ```config/back/cache.php```
系统加密配置路径 ```config/back/encrypt.php```
菜单种子文件配置路径 ```config/seeder/menu.php```

## helper
存储路径 ```app/helpers/```
获取cache的缓存值 ```app/helpers/cache.php```
通用的方法 ```app/helpers/common.php```
加密的方法 ```app/helpers/encrypt.php```
global配置的方法 ```app/helpers/global.php```

## 目录结构
Trait => app/Traits  
Repositories => app/Repositories 仓库

## 主题
view/themes/metronic

## 报告详情--保存数据格式
```
tab : {
    // 标签id
    id : 5,
    "values" : [
        {
            // 列id，可以为空
            "col_id" : '',
            // 列名称
            "col_name" : '',
            // 数据
            "data" : {
                "key" : "value",
                // 表格
                "tables" : [
                    // {} 代表一个表格
                    {
                        "table_id" : 1,
                        "values" : [
                            {
                                "key" : "value"
                            }
                        ]
                    }
                ]
            }
        }
    ]
}
```

