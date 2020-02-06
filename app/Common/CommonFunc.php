<?php


namespace App\Common;

/**
 * Class CommonFunc
 * @package App\Common
 * @author YanJiGang
 */
class CommonFunc
{
    /**
     * 转义搜索中的 % 和 _ 来做数据库模糊搜索
     * @param $str
     * @return string|string[]
     */
    public static function escapeLikeStr($str)
    {
        $like_escape_char = '!';

        return str_replace([$like_escape_char, '%', '_'], [
        $like_escape_char.$like_escape_char,
        $like_escape_char.'%',
        $like_escape_char.'_',
        ], $str);
    }

}