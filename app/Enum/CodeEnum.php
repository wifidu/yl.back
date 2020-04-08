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
    const DELETE_SUCCESS        = [204, '删除成功'];
    const LOGOUT_SUCCESS        = [204, '登出成功'];
    const NOT_PERMISSION        = [401, '权限不足'];
    const NON_EXISTENT          = [500, '信息不存在'];
    const FAIL                  = [999, '操作失败'];
    const DATA_EMPTY            = [998, '信息为空'];
    const PARAMS_MISS           = [997, '参数缺失'];
    const ERR_NAME_OR_PASSWORD  = [996, '用户名或密码错误'];
    const USER_NOT_EXISTENT     = [995, '用户不存在'];
    const REPEAT_OPERATE        = [994, '操作重复'];
    const PARAMES_ERROR         = [993, '参数错误'];

    const WareHouseLog          = [0=>'盘点',1=>'出库',2=>'入库'];
    const UNIT                  = [0=>'支',1=>'个',2=>'包'];
    const EXPENSE_ITEM          = [0=>'床位费',1=>'膳食费',2=>'护理费',3=>'一次性收费',4=>'押金'];
    const IS_CHARGES            = [0=>'未收款',1=>'已收款'];
    const IMAGE_TYPE            = ['avatar'=>0,'other'=>1];
}
