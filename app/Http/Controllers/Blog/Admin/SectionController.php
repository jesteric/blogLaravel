<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Store\StoreController;
use Illuminate\Http\Request;
#use App\Http\Controllers\Controller;
use App\Models\BlogSection;


class SectionController extends StoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pagination = BlogSection::paginate(10);
      return view('blog.admin.section.index', compact('pagination') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $item = new BlogSection();
      $sectionList = BlogSection::all();

      return view(
          'blog.admin.section.edit',
          compact('item', 'sectionList')
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request -> input();
        $section = new BlogSection($data);
        $section->save();

        if($section){
          return redirect() -> route('blog.admin.section.edit', [$section->id])
            -> with(['msg' => 'Success save']);
        }else{
          return back() ->withErrors(['msg' => 'Error in saving'])
            -> withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogSection::findOrFail($id);
        $sectionList = BlogSection::all();

        return view(
            'blog.admin.section.edit',
            compact('item', 'sectionList')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = BlogSection::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Element not found"])
                ->withInput();
        }

        $data = $request->all();
        //dd($data);
        $result = $item
                    ->fill($data)
                    ->save();
        //dd($result);
        if ($result) {
            return redirect()
                    ->route('blog.admin.section.edit', $item->id)
                    ->with(['success' => 'Successfull update']);
        } else{
            return back()
                    ->withErrors(['msg' => 'Some problems'])
                    ->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
