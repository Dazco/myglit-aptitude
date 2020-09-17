<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    /**
     * Display all exams
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }

    /**
     * Display Exam create form
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('exams.create');
    }

    /**
     * Create a new Exam
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255|unique:exams']);

        $exam = Exam::create(['title' => $request->title]);

        Session::flash('alert-success', "$exam->title exam has been added");

        return redirect()->route('exams.index');
    }

    public function show($exam_id){
        $exam = Exam::findOrFail($exam_id);
        $categories = Exam::$categories;
        $questions = [
          'technical' => $exam->questions()->where('category', 'technical')->get()->all(),
          'aptitude' => $exam->questions()->where('category', 'aptitude')->get()->all(),
          'logical' => $exam->questions()->where('category', 'logical')->get()->all()
        ];
        return view('exams.questions.index', compact('exam', 'categories', 'questions'));
    }

    /**
     * @param $exam_id
     * @return \Illuminate\View\View
     */
    public function edit($exam_id){
        $exam = Exam::findOrFail($exam_id);
        return view('exams.edit', compact('exam'));
    }

    /**
     * @param Request $request
     * @param $exam_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request  $request, $exam_id){
        $request->validate(['title' => 'required|string|max:255|unique:exams']);

        $exam = tap(Exam::findOrFail($exam_id))->update(['title' => $request->title]);

        Session::flash('alert-success', "$exam->title exam has been updated");

        return redirect()->route('exams.index');
    }

    public function destroy($exam_id){
        $exam = tap(Exam::findOrFail($exam_id))->delete();

        Session::flash('alert-danger', "$exam->title exam has been deleted");

        return redirect()->route('exams.index');
    }
}
