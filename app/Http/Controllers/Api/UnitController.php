<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Question;
use App\Unit;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('title', 'ASC')->get([
            'id',
            'title',
            'content',
            'is_activated',
            'order',
            'course_id',
            'url_icon'
        ]);
        return response()->json([
            'data' => $units
        ], 200);
    }

    public function questionsByUnit($id)
    {
        $user = User::find(Auth::user()->id);
        $questions = Question::where('unit_id', intval($id))->orderBy('order')->with('type_answers')->get([
            'id',
            'slug',
            'title',
            'code',
            'unit_id',
            'order'
        ]);
        foreach ($questions as $question) {
            $list = new Collection();
            foreach ($question->type_answers as $answer) {
                if (isset($answer)) {
                    $data = [
                        'series' => $answer->series,
                        'reps' => $answer->reps,
                    ];
                    $list->push($data);
                }
            }
            $progress_user = $user->progress()->where(['unit_id' => $id, 'question_id' => $question->id])->first();
            $question->flag_completed = $progress_user->pivot->flag_complete_question ?? 0;
            $question->series_reps = $list[0] ?? json_decode('{}');
            unset($question->type_answers);
        }
        return response()->json(
            $questions,
            200
        );
    }


    public function getUnitDetail(Request $request, $slug = null)
    {
        $data = $request->all();
        $unitDetail = Unit::select('id', 'title', 'code', 'subtitle', 'level', 'mobile_image', 'frequency', 'duration', 'max_time', 'time_rest', 'url_image', 'course_id')
            ->where('slug', $slug)
            ->where('course_id', $data['course_id'])->first();
        return response()->json($unitDetail, 200);
    }

    function findIndexArray($array, $filter)
    {
        foreach ($array as $key => $value) {
            if ($filter == $value->serie)
                return $key;
        }
        return false;
    }

    public function finishQuestion(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data = $request->all();
        $unit = Unit::find($data['unit_id']);
        $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));
        $question = $unit->questions->firstWhere('id', $data['question_id']);
        $questionDetail = Question::find($data['question_id']);
        $answers = $questionDetail->type_answers[0];
        if (is_null($question)) {
            return response()->json([
                'statusCode' => 404,
                'code' => 'UNIT_NOT_FOUND_ON_COURSE',
                'message' => 'No se encontro el ejercicio'
            ], 404);
        }
        $res_question = $user->progress()->where('question_id', $question->id)->where('answer_id', $answers->id)->where('flag_complete_question', 0)->first();
        // if (isset($res_question)) {}
        if (isset($res_question)) {
            $total_sets = json_decode($res_question->pivot->sets);
            // echo "Sets del ejercicio: ". json_encode($total_sets, true);
            $index = $this->findIndexArray($total_sets, $data['set_number']);
            $total_sets[$index]->flag_complete = 1;
            $res_question->pivot->update(['sets' => json_encode($total_sets)]);
            $progress_user = $user->progress()->where('question_id', $question->id)->where('answer_id', $answers->id)->first();
            $quantity_sets_finishes = array_filter(json_decode($progress_user->pivot->sets), function ($item) {
                return $item->flag_complete == 1;
            });
            if (count($quantity_sets_finishes) === $answers->series) {
                $res_question->pivot->update(['flag_complete_question' => 1, 'date_answered' => $date_now]);
                $progress_user = $this->questionsByUnit($unit->id);
                $result = json_decode($progress_user->getContent());
                $quantity_question_finishes = array_filter($result, function ($item) {
                    return $item->flag_completed == 1;
                });
                if (count($quantity_question_finishes) === count($result)) {
                    $data_send = [
                        'course_id' => $unit->course_id,
                    ];
                    $request = new Request($data_send);
                    return $this->finishUnit($request, $questionDetail->unit_id);
                } else {
                    return response()->json([
                        'statusCode' => 200,
                        'code' => 'EXCERCISE_FINISH_SUCCESS',
                        'message' => 'Ejercicio finalizado con exíto'
                    ], 200);
                }
            }
            return response()->json([
                'statusCode' => 200,
                'code' => 'SET_FINISH_SUCCESS',
                'message' => 'Set finalizado con exíto'
            ], 200);
        }
    }

    private function finishUnit(Request $request, $id)
    {
        $data = $request->all();
        $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));
        $user = User::find(Auth::user()->id);
        $course = Course::find($data['course_id']);
        $unit = $course->units->firstWhere('id', $id);
        if (is_null($unit)) {
            return response()->json([
                'statusCode' => 404,
                'code' => 'DAY_NOT_FOUND_ON_COURSE',
                'message' => 'No se encontro el en el curso ' . $course->title
            ], 404);
        }
        $res_unit = DB::table('unit_users_course')->where('user_id', $user->id)->where('unit_id', $unit->id)->where('course_id', $course->id)->first();
        if (!isset($res_unit)) {
            $user_course_unit = [
                'user_id' => $user->id,
                'unit_id' => $unit->id,
                'course_id' => $unit->course_id,
                'flag_complete_unit' => 1,
                'date_answered' => $date_now,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ];
            DB::table('unit_users_course')->insert($user_course_unit);
            $unit_finish = DB::table('unit_users_course')->where('user_id', $user->id)->where('course_id', $unit->course_id)->get('id');
            if (count($course->units) == count($unit_finish)) {
                $flag_completed = ['flag_completed' => 1, 'final_date' => $date_now];
                DB::table('user_courses')->where('user_id', $user->id)->where('course_id', $course->id)->update($flag_completed);
                return response()->json([
                    'statusCode' => 200,
                    'code' => 'CHALLENGE_FINISH_SUCCESS',
                    'message' => 'Reto finalizado con exíto',
                    'certification' => $course->file_url,
                ], 200);
            } else {
                return response()->json([
                    'statusCode' => 200,
                    'code' => 'DAY_FINISH_SUCCESS',
                    'message' => 'Dia finalizado con exíto'
                ], 200);
            }
        }
        return response()->json([
            'statusCode' => 400,
            'code' => 'ALREADY_DAY_IS_FINISH',
            'message' => 'Esta dia ya a sido marcada como terminda'
        ], 400);
    }
}
