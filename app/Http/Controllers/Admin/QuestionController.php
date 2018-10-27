<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
	//私有属性
	protected $questionRepository;

	//构造函数
	public function __construct(QuestionRepository $questionRepository){

		$this->questionRepository = $questionRepository;
	}

    //问题显示
    public function index()
    {
    	$q = $this->questionRepository->getAllQuestion();
    	
    	return view('admin.question.index',compact('q'));
    }

    //问题添加显示
    public function getaddview()
    {
    	return view('admin.question.getaddview');
    }

    //问题保存
    public function createquestion(Request $request)
    {
    	$date = $request->all();
    	$date['mg_id'] = \Auth::guard('back')->user()->mg_id;
    	$z = $this->questionRepository->createQuestionBymg_id($date);

    	return $z ? ['code'=>1] : ['cpde'=>0];
    }

    //显示回答问题页面
    public function getanswerview($id)
    {
    	$question = $this->questionRepository->getOneQuestionByQ_id($id);
    	$answer_mg_id = \Auth::guard('back')->user()->mg_id;

    	return view('admin.question.getanswerview',compact('question','answer_mg_id'));
    }

    //保存答案数据
    public function createanswer(Request $request)
    {	
    	//dd($request->all());
 		$z = $this->questionRepository->createanswer($request->all());
    	return $z ? ['code'=>1] : ['code'=>0];
    }
}
