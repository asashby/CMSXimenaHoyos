<?php


namespace App\Transformers;


use App\Question;
use App\TypeAnswer;
use App\Unit;
use League\Fractal\TransformerAbstract;

class TypeAnswerTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'question'
    ];

    public function transform(TypeAnswer $typeAnswer)
    {
        return [
            'id' => $typeAnswer->id,
            'title' => $typeAnswer->title,
            'message' => $typeAnswer->message,
            'status' => $typeAnswer->status,
            'is_activated' => $typeAnswer->is_activated,
            'question_id' => $typeAnswer->question_id,
        ];

    }

    /**
     * Include Category
     *
     * @param Unit $unit
     * @return \League\Fractal\Resource\Collection
     */
    public function includeQuestion(TypeAnswer $typeAnswer)
    {
        if ($question = $typeAnswer->question) {
            return $this->item($question, new QuestionTransformer());
        }
    }

}
