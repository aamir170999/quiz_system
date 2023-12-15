<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Exam;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Exam $exam)
    {
        return view("question.index", compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Exam $exam)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
 {

        if ($request->hasFile('image_file')) {
            dd('image_file');
            $imagePath = $request->file('image_file')->store('exam_images', 'public');

        }
        Question::create($request->validated());
        return $this->success('Question added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Exam $exam)
    {
        return view('question.edit', compact('question', 'exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {

        $question->update($request->validated());
        return response()->json(['status' => 'success', 'msg' => 'Question updated!']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->with('success', 'Quiz deleted successfully');
    }
    public function addQuestion(Exam $exam)
    {

        // $totalQuestions = Question::where('exam_id', $exam->id)->count();
        // $questions = Question::where('exam_id', $exam->id)->paginate(5);
        // we can also try the above method to get the desired output
        $totalQuestions = $exam->questions->count();
        $questions = Question::where('exam_id', $exam->id)->paginate(5);
        return view('question.create', compact('exam', 'questions', 'totalQuestions'));
    }
}
