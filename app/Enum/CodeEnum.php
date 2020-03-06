<?php


namespace App\Enum;

use App\Model\WareHouseLog;

/**
 * 响应码表
 * 所有接口在使用务必在此定义
 * 将所有的响应码中心化，同时也便于查询
 * Class CodeEnum
 * @package App\Enums
 */
class CodeEnum
{
    const SUCCESS               = [200, '操作成功'];
    const INC_SUCCESS           = [201, '新增成功'];
    const FAIL                  = [999, '操作失败'];
    const NON_EXISTENT          = [500, '信息不存在'];
    const DATA_EMPTY            = [998, '信息为空'];
    const PARAMS_MISS           = [997, '参数缺失'];
    const ERR_NAME_OR_PASSWORD  = [996, '用户名或密码错误'];
    const NOT_PERMISSION        = [401, '权限不足'];

    const WareHouseLog          =[0=>'盘点',1=>'出库',2=>'入库'];
    const UNIT                  =[0=>'支',1=>'个',2=>'包'];
}
