<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SearchnoteRepository;

class SearchNoteController extends Controller
{
    //私有属性
    protected $searchnoteRepository;

    //构造函数
    public function __construct(SearchnoteRepository $searchnoteRepository)
    {
        $this->searchnoteRepository = $searchnoteRepository;
    }         
    
    //列表显示
    public function index(Request $request)
    {
        error_reporting(0);
        $whereData['date'] = !empty($request->get('date')) ? $request->get('date'):date('Y-m-d',time());
        $whereData['mg_name'] = !empty($request->get('mg_name')) ? $request->get('mg_name'):'';
        $whereData['mg_id'] = $this->searchnoteRepository->getMgId($whereData['mg_name']);
        $notes = $this->searchnoteRepository->getNoteFeeds($whereData);

        
        return view('admin.search.index',compact('notes','whereData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
