<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NoteRepository;

class NoteController extends Controller
{
	//私有属性
	protected $noteRepository;

	//构造方法
	public function __construct(NoteRepository $noteRepository){

		$this->noteRepository = $noteRepository;
	}

    //显示笔记
    public function index(Request $request)
    {
        $data = $this->noteRepository->getWxsList();
    	return view('admin.note.index',compact('data'));
    }

    //添加笔记
    public function addnote(Request $request)
    {
        $html = $this->noteRepository->createNoteHeaderHtml($request->all(),'input');
        return ['code'=>1,'html'=>$html];
    }

    //保存笔记
    public function savenote(Request $request)
    {
        $data = $request->all();
        if(!is_null($data['note_id'])){
            //编辑
            $this->noteRepository->savenoteToDBByEdit($data);

        }else{
            //新建
            $this->noteRepository->savenoteToDB($data);
        };
        $html = $this->noteRepository->showTdData($data);
        
        return ['code'=>1,'html'=>$html];
    }

    //自动加载未提交笔记
    public function loading(Request $request)
    {
        $mg_id = \Auth::guard('back')->user()->mg_id;
        $data = $this->noteRepository->loadingNotSubmitNote($mg_id);

        $html = '';
        for ($i=0; $i < count($data); $i++) { 
            $html .= $this->noteRepository->createNoteHeaderHtml($data[$i],'show');
        }
        return ['code'=>1,'html'=>$html];
    }

    //编辑笔记数据
    public function editnote(Request $request)
    {
        
        $tr = $this->noteRepository->createNoteInputHtml($request->get('note_id'));
        return ['code'=>1,'tr'=>$tr];
    }

    //提交笔记数据
    public function tjnote(Request $request)
    {
        $note_ids = $request->get('note_ids');
        $z = $this->noteRepository->setIs_submit($note_ids);
        return ['code'=>1];
    }
}
