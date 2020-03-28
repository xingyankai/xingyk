<?php
namespace xingyk\helper;

class Time
{
    /**
	 * 获取季度开始和结束时间戳(默认当季)
	 * @param int $quarter 范围 [1, 2, 3, 4] 对应一到四季度
	 * @return array
	 */
	public static function getQuarterTimestamp($quarter=0)
	{
		if ($quarter == 0) {
			$quarter = ceil((date('n'))/3);
		}
		return [
			mktime(0, 0, 0, $quarter*3-2, 1, date('Y')),
			mktime(0, 0, 0, $quarter*3+1, 1, date('Y')) - 1
		];
	}

	
	/**
	 * Notes: 获取往前推 第N个月的开始和结束时间戳 默认是lastMonth
	 * @param int $number 第几个月
	 * @return array
	 * User: xingyk
	 * Date: 2019/12/14
	 */
	public static function getMonthAgoTimestamp($number = 1)
	{
		$begin = mktime(0, 0, 0, date('n') - $number, 1, date('Y'));
    	$end = mktime(23, 59, 59, date('n') - $number, date('t', $begin), date('Y'));

    	return [$begin, $end];	
	}


	/**
	 * 获取往前推 第N个月的年月份
	 * @param int $number 前第几个月
	 * @return string
	 */
	public static function getMonthAgoMonth($number = 1)
	{
		return date('Y-m', mktime(0, 0, 0, date('n') - $number, 1, date('Y')));
	}

	/**
	 * 获取往前推 第N个月的月开始结束日期
	 * @param int $number 前第几个月
	 * @return array
	 */
	public static function getMonthAgoDate($number = 1)
	{
		$begin = mktime(0, 0, 0, date('n') - $number, 1, date('Y'));
		$end = mktime(23, 59, 59, date('n') - $number, date('t', $begin), date('Y'));

		return [date('Y-m-d', $begin), date('Y-m-d', $end)];
	}

	/**
	 * 获取往前推 第N个月的月开始结束日期
	 * @param int $startTimestamp 开始时间戳
	 * @param int $endTimestamp 结束时间戳
	 * @return array
	 */
	public static function getBetweenDays($startTimestamp, $endTimestamp)
	{
		$days = [];
		while( $startTimestamp <= $endTimestamp ){
			$days[] = date('Y-m-d',$startTimestamp);
			$startTimestamp = strtotime('+1 day', $startTimestamp);
		}
	
		return $days;
	}
	
	/**
	 * 获取往前推 第N个月的月开始结束日期
	 * @param int $startTimestamp 开始时间戳
	 * @param int $endTimestamp 结束时间戳
	 * @return array
	 */
	public static function getBetweenMonths($startTimestamp, $endTimestamp)
	{
		$months = [];
		while( $startTimestamp <= $endTimestamp ){
			$months[] = date('Y-m',$startTimestamp);
			$startTimestamp = strtotime('+1 month', $startTimestamp);
		}
	
		return $months;
	}

	/**
	 * 获取两个日期之间间隔月数
	 * @param string $dateOne 2019-01 以-为分割符
	 * @param string $dateTwo 同上
	 */
	public static function getBetweenMonthNums($dateOne, $dateTwo) {
		list($yearOne, $monthOne) = explode('-', $dateOne);
		list($yearTwo, $monthTwo) = explode('-', $dateTwo);
		
		return abs((($yearOne - $yearTwo) * 12) + ($monthOne - $monthTwo));
	}
}