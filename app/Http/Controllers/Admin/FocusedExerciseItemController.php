<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\FocusedExerciseItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\FocusedExerciseItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FocusedExerciseItemController extends Controller
{
    public function create(Request $request)
    {
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $focusedExerciseItem = new FocusedExerciseItem([
            'focused_exercise_id' => $request->input('focused_exercise_id'),
        ]);

        return view('admin.focused_exercise_item.add')->with([
            'companyData' => $companyData,
            'focusedExerciseItem' => $focusedExerciseItem,
        ]);
    }

    public function store(FocusedExerciseItemRequest $request)
    {
        $focusedExerciseItem = FocusedExerciseItem::query()
            ->create($request->validated());
        Session::flash('success_message', 'El ejercicio focalizado se creo Correctamente');
        return redirect()->route('focused.show', $focusedExerciseItem->focused_exercise_id);
    }

    public function edit(FocusedExerciseItem $focusedExerciseItem)
    {
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused_exercise_item.edit')->with([
            'companyData' => $companyData,
            'focusedExerciseItem' => $focusedExerciseItem,
        ]);
    }

    public function update(FocusedExerciseItem $focusedExerciseItem, FocusedExerciseItemRequest $request)
    {
        $focusedExerciseItem->update($request->validated());
        Session::flash('success_message', 'El ejercicio focalizado se modifico correctamente');
        return redirect()->route('focused.show', $focusedExerciseItem->focused_exercise_id);
    }

    public function destroy(FocusedExerciseItem $focusedExerciseItem)
    {
        $focusedExerciseItem->delete();
        Session::flash('success_message', 'El ejericio focalizado se elimino correctamente');
        return redirect()->route('focused.show', $focusedExerciseItem->focused_exercise_id);
    }
}
