<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cycling;
use App\Http\Requests\Cyclings;
use Illuminate\Pagination\LengthAwarePaginator;

class CyclingController extends Controller
{
  public function __construct(){
  $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
      $keyword = $request->input('keyword');

      $query = Cycling::query();

      if(!empty($keyword))
      {
        $query->where('place','LIKE','%'.$keyword.'%')
                ->orWhere('address','LIKE','%'.$keyword.'%');
      }

      $cyclings = $query->get();

      $cyclingsPaginate = new LengthAwarePaginator(
            $cyclings->forPage($request->page, 5),
            $cyclings->count(),
            5,
            $request->page,
            array('path' => $request->url())
            );

      return view('cyclings.index',['cyclings' => $cyclingsPaginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('cyclings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cyclings $request)
    {
      Cycling::create($request->all());
      return redirect()->route('cyclings.index')->with('success','新規登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cyclings = Cycling::find($id);
      return view('cyclings.show', compact('cyclings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $cyclings = Cycling::find($id);
      return view('cyclings.edit', compact('cyclings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cyclings $request, $id)
    {
      $update = [
        'place' => $request->place,
        'address' => $request->address,
        'comment' => $request->comment
      ];
      Cycling::where('id', $id)->update($update);
      return redirect()->route('cyclings.index')->with('success', '編集完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Cycling::where('id',$id)->delete();
      return redirect()->route('cyclings.index')->with('success', '削除完了しました。');
    }
}
