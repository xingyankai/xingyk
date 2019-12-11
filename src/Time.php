<?php
namespace xingyk\helper;

class Time
{
    /**
     * Notes: 获取季度的开始和结束时间戳
     * User: xingyk
     * @return array
     */
    public static function getQuarterTimestamp()
    {
        $quarter = ceil((date('n'))/3);

        return [
            mktime(0, 0, 0, $quarter*3-2, 1, date('Y')),
            mktime(0, 0, 0, $quarter*3+1, 1, date('Y')) - 1
        ];
    }
}