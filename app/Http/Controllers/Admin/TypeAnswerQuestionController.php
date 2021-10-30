<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeAnswerQuestionRequest;
use App\Question;
use App\Scopes\ActivatedScope;
use App\TypeAnswer;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeAnswerQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeAnswerQuestionRequest $request)
    {
        $data = $request->all();
        DB::table('type_answers_questions')->insert($data);
        return response()->json([
            'message' => 'Registro exitoso'
        ], 200);
    }


    public function show($id)
    {
        $question = Question::withoutGlobalScope(ActivatedScope::class)->find($id);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.questions.table_answers', compact('question','companyData'))->render();
    }


    public function edit($id)
    {
        $question_answer = DB::table('type_answers_questions')->where('id', $id)->first();
        $questions = Question::orderBy('title', 'ASC')->pluck('title', 'id');
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->pluck('name', 'id');
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.answer.edit', compact('type_answers', 'questions', 'question_answer','companyData'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'id' => $id,
            'question_id' => $request->question_id,
           // 'title' => $request->title,
           // 'message' => $request->message,
            'type_answer_valid' => $request->type_answer_valid,
            'status' => $request->status
        ];
        //$data = $request->all();
        DB::table('type_answers_questions')->where('id', $id)->update($data);
        return redirect()->route('questions.index')->with('status', '¡Modificado con exíto¡');

    }


    public function destroy($id)
    {
        try {
            DB::table('type_answers_questions')->where('id', $id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Eliminado con exíto'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }


    }

    public function changeValid($id)
    {

        $answer_question = DB::table('type_answers_questions')->where('id', $id)->first();
        $value = 0;
        if ($answer_question->type_answer_valid == 0) {
            $value = 1;
        }
        DB::table('type_answers_questions')->where('id', $id)->update(['type_answer_valid' => $value]);
        return $value;
    }

    public function changeStatus($id)
    {
        $answer_question = DB::table('type_answers_questions')->where('id', $id)->first();
        $value = 0;
        if ($answer_question->status == 0) {
            $value = 1;
        }
        DB::table('type_answers_questions')->where('id', $id)->update(['status' => $value]);
        return $value;
    }

}
