<?php


namespace App\Enum;

/**
 * 响应码表
 * 所有接口在使用务必在此定义
 * 将所有的响应码中心化，同时也便于查询
 * Class CodeEnum
 * @package App\Enums
 */
class CodeEnum
{
    const SUCCESS       = [200, '操作成功'];
    const FAIL          = [999, '操作失败'];
    const NON_EXISTENT  = [500, '信息不存在'];
    const DATA_EMPTY    = [201, '信息为空'];
    const PARAMS_MISS   = [202, '参数缺失'];
}
