<?php 
	namespace App\Repositories;

	use DB;
	use App\Answer;
	use App\Question;
	use Illuminate\Http\Request;

	class QuestionRepository
	{
		//用户创建问题
		public function createQuestionBymg_id($d)
		{
			return Question::create($d);
		}

		//获取到所有的问题信息
		public function getAllQuestion()
		{
			return Question::leftJoin('manager','question.mg_id','manager.mg_id')->orderBy('q_id','desc')->paginate(2);
		}

		//去一条问题
		public function getOneQuestionByQ_id($id)
		{
			return Question::find($id);
		}

		//创建答案
		public function createanswer($d)
		{
			$data = array_only($d,['mg_id','content']);
			$answer_id = Answer::insertGetId($data);
			//dd($d);
			return DB::table('question_answer')->insert(['question_id'=>$d['q_id'],'answer_id'=>$answer_id]);
		}
	}
?>