<?php
namespace xingyk\helper\Data;

class ResponseHandle
{
    /**
     * 将所有类型(数字)转换为字符串
     * @param $responseData mixed 返回的数据
     * @param $closure \Closure 处理函数
     */
    public static function transToString(&$responseData, $closure=null)
    {
        if (is_array($responseData)) {
            foreach ($responseData as $key => $value) {
                if (!empty($closure) && $closure instanceof \Closure) {
                    $value = $closure($value);
                }
                $responseData[$key] = (string)$value;
            }
        } else if(!is_bool($responseData) && !is_object($responseData)){
            $responseData = (string)$responseData;
        }
    }

}
