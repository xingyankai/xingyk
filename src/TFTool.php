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
            $value = isset($param[$key]) ? $param[$key] : false;
        } else {
            $value = $param;
        }
        if (is_string($value) && preg_match('/^(\d+)\.(\d+)/', $value)) { // 匹配是小数，主要是匹配"0.00"
            $value = floatval($value);
        }
        return !empty($value);
    }


    /**
     * Notes: 检测以分隔符串联的字符串是否有效，且返回有效值
     * User: xingyk
     * Date: 2020/12/9
     * @param $explodeString
     * @param string $delimiter
     * @return bool|false|string[]
     */
    function checkExplodeString($explodeString, $delimiter=',')
    {
        if (empty($explodeString)) {
            return false;
        }
        $exArr = explode($delimiter, $explodeString);
        $exArr = array_unique($exArr);
        if (count($exArr) == 1 && empty($exArr[0])) {
            return false;
        }

        return $exArr;
    }
}
