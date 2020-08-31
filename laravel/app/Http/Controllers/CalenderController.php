<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Holiday;
use App\Http\Requests\Holidays;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
  public function index(Request $request)
  {
    $list = Holiday::all();
    $cal = new Calendar($list);
    $tag = $cal->showCalendarTag($request->month,$request->year);

    return redirect('home',['cal_tag'=> $tag]);
  }

    public function getHoliday(Request $request)
    {
      $data = new Holiday();
      $list = Holiday::all();
      $cal = new Calendar($list);
      return view('calendar.holiday',['list' => $list,'data' => $data]);
    }

    public function getHolidayId($id)
    {
      $data = new Holiday();
      if(isset($id)){
        $data = Holiday::where('id', '=', $id)->first();
      }
      $list = Holiday::all();
      return view ('calendar.holiday',['list' => $list, 'data' => $data]);
    }

    public function postHoliday(Holidays $request)
    {
      if(isset($request->id))
      {
        $holiday = Holiday::where('id', '=', $request->id)->first();
        $holiday->day = $request->day;
        $holiday->description = $request->description;
        $holiday->save();
      }else{
        $holiday = new Holiday();
        $holiday->day = $request->day;
        $holiday->description = $request->description;
        $holiday->save();
      }
      $data = new Holiday();
      $list = Holiday::all();
      return view('calendar.holiday',['list' =>$list, 'data' => $data]);
    }

    public function deleteHoliday(Request $request)
    {
      if(isset($request->id)){
        $holiday = Holiday::where('id','=',$request->id)->first();
        $holiday->delete();
      }
      $data = new Holiday();
      $list = Holiday::all();
      return view('calendar.holiday',['list' => $list, 'data' => $data]);
    }

}
