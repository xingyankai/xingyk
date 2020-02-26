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
     * @return bool
     */
    public static function isValid($param, $key=false)
    {
        if ($key) {
            $value = $param[$key];
        } else {
            $value = $param;
        }
        
        return isset($value) && !empty($value) && (floatval($value) != 0);
    }

}
