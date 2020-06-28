<?php
namespace xingyk\helper;

/**
 * Class TFTool （true false tool） 判断工具类
 * @package xingyk\helper
 */
class TFTool
{
    /**
     * Notes: 判断值是否有效，可判断数组中的值
     * User: xingyk
     * Date: 2020/1/9
     * @param $param
     * @param $key
     * @return bool true 有效 false 无效
     */
    public static function isValid($param, $key='')
    {
        if ($key) {
            $value = isset($param[$key]);
        } else {
            $value = $param;
        }
        if (preg_match('/^(\d+)\.(\d+)/', $value)) { // 匹配是小数，主要是匹配"0.00"
            $value = floatval($value);
        }
        return !empty($value);
    }

}
