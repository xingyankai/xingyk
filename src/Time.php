<?php
namespace xingyk\helper;

class Time
{
    /**
	 * 获取季度开始和结束时间戳(默认当季)
	 * @param int $quarter 范围 [1, 2, 3, 4] 对应一到四季度
	 * @return array
	 */
	function getQuarterTimestamp($quarter=0)
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
	 * Notes: 获取往前推 第N个月的开始和结束时间 默认是lastMonth
	 * @param int $number 第几个月
	 * @return array
	 * User: xingyk
	 * Date: 2019/12/14
	 */
	function getMonthAgoTime($number=0)
	{
		$year = date('Y');
		$month = date('n');

		if ($number >= $month) {
			$diffMonth = ($number - $month) % 12;
			$yearDiff = ($diffMonth > 0) ? ceil( ($number-$month) / 12 ) : 1;
			$year -= $yearDiff;
			$month = 12 - $diffMonth;
		}else{
			$month = $month - $number;
		}
		if ( empty($number) ) {
			$month = date('n') - 1;
		}

		$beginTime = $year . '-'. $month . '-01';
		$begin = mktime(0, 0, 0, $month, 1, $year);
		$end = mktime(23, 59, 59, $month, date('t', $begin), $year);
		$endTime = date( 'Y-m-d', $end );

		return [
			'date' => [$beginTime, $endTime],  
			'timestamp' => [$begin, $end]
		];
	}
}