### Version 2.5.4
**2018-10-19**

* 修复:
    * App::table BUG (数据库连接失效)
* 优化:
    * 无法开启会话提示

### Version 2.5.3
**2018-10-15**

* 新增:
    * RESTFul支持
        * [RESTFulServer](https://www.wulaphp.com/guide/restful/server.html)
        * [RESTFulClient](https://www.wulaphp.com/guide/restful/client.html)
    * 文件[上传器](https://www.wulaphp.com/guide/utils/uploader)
    * [存储器](https://www.wulaphp.com/guide/utils/storage)
    
### Version 2.5.2
**2018-09-30**

* 新增:
    * 支持php build-in server
    * ExcelView
    * Module::loadFile方法用于加载模块文件内容
    * 添加存储器`Storage`
* 优化:
    * 调整语言检测逻辑
    * 固化`artisan`命令的`-h`和`--help`参数
    * `service`命令
    * 默认配置项详见[配置文档](http://www.wulaphp.com/guide/config/cfg.html)

### Version 2.5.1
**2018-09-17**
* 新增:
    * 添加module管理子命令
* 修复:
    * 修复queryOne BUG


### Version 2.5.0
**2018-09-14**
* 兼容性调整
    * 向下兼容到PHP5.6.9
* 新功能:
    * App::run()方法添加参数
    * 配置继承加载机制
    * 添加`pview`函数
    * 数据库SQlite支持
    * 添加`admin`子命令 (`#php artisan admin --help`了解更多)
* 优化:
    * 引导过程
    * 优化响应缓冲区处理
    * 添加travis支持
    * 优化路由器
        * 子模块功能
        * URL别名机制
    * artisan命令工具

### Version 2.4.0
**2018-09-05**
* 修复
    * 修复App::db不能接收array参数错误

* 增强
    * DatabaseConnection::trans方法将抛出所有实现了IThrowable接口的异常
* 新增
    * 添加IThrowable接口