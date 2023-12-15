<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\StoreQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Exam::all());
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
        return $this->success('exam added successfully');
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
        return view('exam.edit',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuizRequest $request, Exam $exam, $msg = "updated")
    {

        $exam->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'msg' => $msg]);
        } else {
            return redirect()->back()->with(['status' => 'success', 'msg' => $msg]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam, $msg = "Deleted Successfully")
    {
        $exam->delete();
        return response()->json(['status' => 'danger', 'msg' => $msg]);
    }

    public function dataTable(Request $request)
    {
        $exams = Exam::select(['*']);

        return DataTables::of($exams)


        ->addColumn('action', function ($exam) {

                $actions = '<a class="btn btn-primary btn-sm p-2 m-1" style="border-radius:100%;" href="' . route('exams.edit', $exam->id) . '" title="Edit"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            >
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                            </path>
                        </svg></a>';

                $actions .=  '<a  href="' . route('question.add', $exam->id) . '" class="btn  btn-success btn-sm p-2 m-1" title="Add Question"  style="border-radius:25%;">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>';



                $actions .='<a class="btn btn-danger btn-sm p-2 m-1"  title="Delete Question"  onclick="handleDelete(' . $exam->id . ')" style="border-radius:100%;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-trash p-1 br-8 mb-1">
                                     <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                </svg></a>';
                return '<div>
                ' . $actions . '
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
