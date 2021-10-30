<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use App\Course;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Database\Eloquent\Collection;
use App\Comments;
use App\Events\updateRateChallenge;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('order', 'ASC')->get(['id', 'title', 'content', 'is_activated', 'unit_id']);
        return response()->json([
            'data' => $questions
        ], 200);
    }

    public function questionDetail(Request $request, $code)
    {
        $user = User::find(Auth::user()->id);
        $data = $request->all();
        $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));
        $questionDetail = Question::select('id', 'title', 'code', 'subtitle', 'level', 'frequency', 'duration', 'max_time', 'time_rest', 'unit_id', 'mobile_image', 'content', 'url_image', 'url_video')->where('code', $code)->first();
        $question_answer = $questionDetail->type_answers->first();
        $progress_user = $user->progress()->firstWhere('question_id', $questionDetail->id);
        $questionDetail->id_serie_rep = $question_answer->id;
        if (!isset($progress_user)) {
            $list_series = new Collection();
            for ($i = 1; $i <= $question_answer->series; $i++) {
                $serie = [
                    'serie' => $i,
                    'reps' => $question_answer->reps,
                    'flag_complete' => 0
                ];
                $list_series->push($serie);
            }
            $questionDetail->series = $list_series;
            $user_questions_answers = [
                'user_id' => $user->id,
                'question_id' =>  $questionDetail->id,
                'sets' => $list_series,
                'answer_id' => $question_answer->id,
                'flag_complete_question' => 0,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ];
            DB::table('user_questions_answers')->insert($user_questions_answers);
        } else {
            $question_finish_by_user = $progress_user->pivot;
            $questionDetail->series = json_decode($question_finish_by_user->sets);
        }
        unset($questionDetail->type_answers);
        return response()->json($questionDetail, 200);
    }
}
