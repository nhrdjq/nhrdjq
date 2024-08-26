<?php
// +----------------------------------------------------------------------
// | 文件:index.php
// +----------------------------------------------------------------------
// | 功能：提供待办事项api接口
// +----------------------------------------------------------------------
// | 时间: 2021-11-15 16:20
// +----------------------------------------------------------------------
// | 作者:rangangwei<gangweiran@tencent.com >
// +----------------------------------------------------------------------

命名空间app \控制器；

使用错误；
使用例外；
使用app \型号\计数器；
使用思考\响应\ Html
使用思考\回应\ Json
使用think \ facade \ Log

班级索引
{

    /**
* 主页静态页面
* @返回Html
     */
    公众的 功能 指数():Html
    {
        # html路径：../view/index.html
        返回 反应(文件获取内容(目录名(目录名(__文件_ _))./view/index.html '));
    }


    /**
* 获取待办事项列表
* @返回Json
     */
    公众的 功能 获取计数():Json
    {
        尝试 {
$data =(新的计数器)->发现(1);
            如果 ($data ==空) {
$count =0;
            }其他 {
$count = $data["计数"];
            }
$res =[
                "代码" => 1,
                "数据"=> $count
            ];
日志::写(getCount rsp:'.json_encode($res));
            返回 json($res);
        } 捕捉 (错误$e) {
$res =[
                "代码" => -1,
                "数据" => [],
                "错误消息" => ("查询计数异常" . $e->getMessage())
            ];
日志::写(getCount rsp:'.json_encode($res));
            返回 json($res);
        }
    }


    /**
* 根据身份证明（identification）查询待办事项数据
* @param $action `string '类型,枚举值,等于` " inc "时,表示计数加一；等于`“重置”`时,表示计数重置（清零)
* @返回Json
     */
    公众的 功能 更新计数($行动):Json
    {
        尝试 {
            如果 ($action =="公司") {
$data =(新的计数器)->发现(1);
                如果 ($data ==空) {
$count =1;
                }其他 {
$count = $data["计数"] + 1;
                }
    
                $counters = new Counters;
                $counters->create(
                    ["count" => $count, 'id' => 1],
                    ["count", 'id'],
                    true
                );
            }else if ($action == "clear") {
                Counters::destroy(1);
                $count = 0;
            }

            $res = [
                "code" => 1,
                "data" =>  $count
            ];
            Log::write('updateCount rsp: '.json_encode($res));
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("更新计数异常" . $e->getMessage())
            ];
            Log::write('updateCount rsp: '.json_encode($res));
            return json($res);
        }
    }
}
