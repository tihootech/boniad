<?php

function carbon_day($date)
{
    return Illuminate\Support\Carbon::parse($date)->format('Y-m-d');
}

function persian_to_carbon($persian_date)
{
    return $persian_date ? Illuminate\Support\Carbon::createFromTimestamp(timestamp($persian_date)) : null;
}

//persian to timestamp
function timestamp($string_date,$sep='/')
{
    $array = explode($sep, $string_date);
    $gregorian = jalali_to_gregorian($array[0], $array[1], $array[2], true);
    return strtotime($gregorian);
}

function next_month($string_date,$sep='/')
{
    $array = explode($sep, $string_date);
    if($array[1]==12){
        $array[1] = 1;
        $array[0]++;
    }else{
        $array[1]++;
    }
    return implode($sep, $array);
}

function human_time($tatal_seconds, $display_seconds=true)
{
    $seconds = $tatal_seconds % 60;
    $minutes = floor($tatal_seconds / 60);
    $output = $minutes > 0 ? $minutes.' '.__('MINUTE') : '';
    if ($minutes && $seconds && $display_seconds) {
        $output .= __('AND');
    }
    if (!$minutes || $display_seconds) {
        $output .= $seconds > 0 ? $seconds.' '.__('SECOND') : '';
    }
    return $output;
}

function human_date($timestamp)
{
    return \Morilog\Jalali\Jalalian::forge($timestamp)->format('%d %B، %Y');
}

function modern_date($timestamp)
{
    return \Morilog\Jalali\Jalalian::forge($timestamp)->ago();
}


function date_picker_date($income, $sep="/")
{
    return $income ? \Morilog\Jalali\Jalalian::forge($income)->format("%Y$sep%m$sep%d") : null;
}

function ago($income)
{
    return $income ? \Morilog\Jalali\Jalalian::forge($income)->ago() : null;
}

function short_date($timestamp)
{
    return \Morilog\Jalali\Jalalian::forge($timestamp)->format('%y/%m/%d');
}

function get_month($timestamp)
{
    return \Morilog\Jalali\Jalalian::forge($timestamp)->format('%m');
}

function get_total_days($timestamp)
{
    $month = get_month($timestamp);
    $gyear = date('Y',$timestamp);
    if ($month > 1 && $month <= 6) {
        return 31;
    }elseif($month > 6 && $month <= 11){
        return 30;
    }elseif ( (($gyear % 4 == 0) && ($gyear % 100 != 0)) || ($gyear % 400 == 0) ) {
        return 30;
    }else {
        return 29;
    }
}

/*******************************************************************/

function div($a,$b) {
    return (int) ($a / $b);
}

function gregorian_to_jalali ($g_y, $g_m, $g_d,$str)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


   $gy = $g_y-1600;
   $gm = $g_m-1;
   $gd = $g_d-1;

   $g_day_no = 365*$gy+div($gy+3,4)-div($gy+99,100)+div($gy+399,400);

   for ($i=0; $i < $gm; ++$i)
      $g_day_no += $g_days_in_month[$i];
   if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
      /* leap and after Feb */
      $g_day_no++;
   $g_day_no += $gd;

   $j_day_no = $g_day_no-79;

   $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
   $j_day_no = $j_day_no % 12053;

   $jy = 979+33*$j_np+4*div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

   $j_day_no %= 1461;

   if ($j_day_no >= 366) {
      $jy += div($j_day_no-1, 365);
      $j_day_no = ($j_day_no-1)%365;
   }

   for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
      $j_day_no -= $j_days_in_month[$i];
   $jm = $i+1;
   $jd = $j_day_no+1;
 if($str) return $jy.'/'.$jm.'/'.$jd ;
   return array($jy, $jm, $jd);
}

function miladi($string,$sep='/')
{
    $arr = explode($sep,$string);
    return jalali_to_gregorian($arr[0],$arr[1],$arr[2]);
}


function jalali_to_gregorian($j_y, $j_m, $j_d,$str=false)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


   $jy = (int)($j_y)-979;
   $jm = (int)($j_m)-1;
   $jd = (int)($j_d)-1;

   $j_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4);

   for ($i=0; $i < $jm; ++$i)
      $j_day_no += $j_days_in_month[$i];

   $j_day_no += $jd;

   $g_day_no = $j_day_no+79;

   $gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
   $g_day_no = $g_day_no % 146097;

   $leap = true;
   if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
   {
      $g_day_no--;
      $gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
      $g_day_no = $g_day_no % 36524;

      if ($g_day_no >= 365)
         $g_day_no++;
      else
         $leap = false;
   }

   $gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
   $g_day_no %= 1461;

   if ($g_day_no >= 366) {
      $leap = false;

      $g_day_no--;
      $gy += div($g_day_no, 365);
      $g_day_no = $g_day_no % 365;
   }

   for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
      $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
   $gm = $i+1;
   $gd = $g_day_no+1;
    if($str) return $gy.'-'.$gm.'-'.$gd ;
    return array($gy, $gm, $gd);
}

function comparedate($_date_mix_jalaly,$_date_mix_gregorian)
{
  $_date_arr_jalaly = explode('/', $_date_mix_jalaly);
  $_date_arr_gregorian = explode('/', $_date_mix_gregorian);

  $arr_jtg = jalali_to_gregorian($_date_arr_jalaly[0],$_date_arr_jalaly[1],$_date_arr_jalaly[2]);

  if($_date_arr_gregorian[0]> $arr_jtg[0])
    {
	 return  false;
	}

	else if($_date_arr_gregorian[0]== $arr_jtg[0] && $_date_arr_gregorian[1]>$arr_jtg[1])
	{
	 return false;
	}
	else if($_date_arr_gregorian[0]== $arr_jtg[0] && $_date_arr_gregorian[1]==$arr_jtg[1] && $_date_arr_gregorian[2]>$arr_jtg[2])
	{
	 return false;
	}
  return true ;
}


function persian_month_names($i=null)
{
    $list = [
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند',
    ];
    return $i ? (isset($list[$i]) ? $list[$i] : '') : $list;
}
