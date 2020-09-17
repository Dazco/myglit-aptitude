<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExamQuestionController extends Controller
{
    //
    public function store(Request $request, $exam_id)
    {
        $categories = join(',', Exam::$categories);
        $request->validate([
            'description' => 'required|string',
            'category' => "required|string|in:$categories",
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
        ]);
        $exam = Exam::findOrFail($exam_id);
        $exam->questions()->create($request->all());
        Session::flash('alert-success', "A new question has been added to $exam->title exam.");
        return response()->json(['status' => 'success']);
    }
}
