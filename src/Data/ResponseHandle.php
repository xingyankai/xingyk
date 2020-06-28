<?php
namespace xingyk\helper\Data;

use Closure;

class ResponseHandle
{
    /**
     * 将所有类型(数字)转换为字符串
     * @param $responseData mixed 返回的数据
     * @param $closure Closure 处理函数
     */
    public static function transToString(&$responseData, $closure=null)
    {
        if (is_array($responseData) || $responseData instanceof \ArrayObject) {
            foreach ($responseData as $key => $value) {
                if (is_array($value)) {
                    self::transToString($responseData[$key], $closure);
                } else if(!is_bool($responseData[$key]) && !is_object($responseData[$key])){
                    if (!empty($closure) && $closure instanceof Closure) {
                        $value = $closure($value);
                    }
                    $responseData[$key] = (string)$value;
                }
            }
        } else if(!is_bool($responseData) && !is_object($responseData)){
            if (!empty($closure) && $closure instanceof Closure) {
                $responseData = $closure($responseData);
            }
            $responseData = (string)$responseData;
        }
    }

}
