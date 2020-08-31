<?php

namespace App;
class Calendar
{
    private $holidays;
    private $html;
    function __construct($holidays)
    {
      $this->holidays = $holidays;
    }

    public function showCalendarTag($m,$y)
    {
      $year = $y;
      $month = $m;
      if($year == null){
        $year = date("Y");
        $month = date("m");
      }
      $firstWeekDay = date("w", mktime(0,0,0, $month, 1, $year));
      $lastDay = date("t", mktime(0,0,0, $month, 1, $year));

      $prev = strtotime('-1 month',mktime(0,0,0, $month, 1, $year));
      $prev_year = date("Y",$prev);
      $prev_month = date("m",$prev);

      $next = strtotime('+1 month',mktime(0,0,0, $month, 1, $year));
      $next_year = date("Y",$next);
      $next_month = date("m",$next);

      $day = 1 - $firstWeekDay;
      $this->html = <<< EOS
      <div class="container">
      <h1>
      <a class="btn btn-primary" href="/home?year={$prev_year}&month={$prev_month}" role="button">&lt;前月</a>
      {$year}年{$month}月
      <a class="btn btn-primary" href="/home?year={$next_year}&month={$next_month}" role="button">翌月&gt;</a>
      </h1>
      <table class="table table-bordered">
      <tr class="col-md-4">
      <th class="m-5">日</th>
      <th>月</th>
      <th>火</th>
      <th>水</th>
      <th>木</th>
      <th>金</th>
      <th>土</th>
      </tr>
      EOS;

      while($day<=$lastDay){
        $this->html .= "<tr>";

        for($i = 0;$i<7;$i++){
          if($day <=0 || $day > $lastDay){
            $this->html .= "<td>&nbsp;</td>";
          }else{
            $this->html .= "<td>" . $day . "&nbsp<br>";
            $target = date("Y-m-d", mktime(0,0,0, $month, $day, $year));
            foreach ($this->holidays as $val) {
              if($val->day == $target){
                $this->html .= $val->description;
                break;
              }
            }
            $this->html .= "</td>";
          }
          $day++;
        }
        $this->html .= "</tr>";
      }
      return $this->html .= '</div></table></div>';

    }
}
