<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\StoreQuizRequest;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("exam.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuizRequest $request)
    {
        Exam::create($request->validated());
        return $this->success('Quiz added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function datatable(Request $request){
        // return json
    }
}
