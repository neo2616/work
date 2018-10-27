<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChecknoteRepository;

class ChecknoteController extends Controller
{

	protected $checknoteRepository;

	public function __construct(ChecknoteRepository $checknoteRepository){

		$this->checknoteRepository = $checknoteRepository;
	}
    //查看提交笔记信息
    public function index()
    {
    	return view('admin.checknote.index');
    }

    //获取提交笔记数据
    public function datainit(Request $request)
    {

    	$date = $request->get('date')?$request->get('date'):'';
    	//$keyword = $request->get('keyword')?$request->get('keyword'):'';
    	if(!$date){
    		$date = date('Y-m-d',time());
    	};
    	$mg_id = \Auth::guard('back')->user()->mg_id;
    	
    	if(is_root()){
    		$html = '';
    		$mgAndWxs = $this->checknoteRepository->getmgAndWxsByIdExcep();
    		for ($i=1; $i < count($mgAndWxs); $i++) { //不带admin111 玩
    			$noteWithWx = $this->checknoteRepository->getNoteWithWx($mgAndWxs[$i]['mg_id'],$date);
    			$html .= $this->checknoteRepository->createCheckCollapse($mgAndWxs[$i],$noteWithWx);
    		}
    	}else{
    		$mgAndWxs = $this->checknoteRepository->getmgAndWxsById($mg_id);
	    	$noteWithWx = $this->checknoteRepository->getNoteWithWx($mg_id,$date);
	    	$html = $this->checknoteRepository->createCheckCollapse($mgAndWxs,$noteWithWx);
    	}
    	//return $html;
    	return ['code'=>1,'html'=>$html];
    }
    //退回提交
    public function tuihui(Request $request)
    {
    	$z = $this->checknoteRepository->setIssubmitTRUE($request->get('note_id'));
    	return $z ? ['code'=>1] : ['code'=>0];
    }
}
 