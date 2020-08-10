<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plamodel;
use App\Http\Requests\Plamodels;
use Illuminate\Pagination\LengthAwarePaginator;

class PlamodelController extends Controller
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

      $query = Plamodel::query();

      if(!empty($keyword))
      {
        $query->where('name','LIKE','%'.$keyword.'%')
                ->orWhere('maker','LIKE','%'.$keyword.'%');
      }

      $plamodels = $query->get();

      $plamodelsPaginate = new LengthAwarePaginator(
            $plamodels->forPage($request->page, 5),
            $plamodels->count(),
            5,
            $request->page,
            array('path' => $request->url())
            );

      return view('plamodels.index',['plamodels' => $plamodelsPaginate]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plamodels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Plamodels $request)
    {
      Plamodel::create($request->all());
      return redirect()->route('plamodels.index')->with('success','新規登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $plamodels = Plamodel::find($id);
      return view('plamodels.show', compact('plamodels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $plamodels = Plamodel::find($id);
      return view('plamodels.edit', compact('plamodels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Plamodels $request, $id)
    {
      $update = [
        'name' => $request->name,
        'maker' => $request->maker,
        'price' => $request->price,
        'released' => $request->released,
        'point' => $request->point,
        'comment' => $request->comment
      ];
      Plamodel::where('id', $id)->update($update);
      return redirect()->route('plamodels.index')->with('success', '編集完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Plamodel::where('id',$id)->delete();
      return redirect()->route('plamodels.index')->with('success', '削除完了しました。');
    }

}
