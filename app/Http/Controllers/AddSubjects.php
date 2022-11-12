<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Subject;
use Illuminate\Http\Request;

class AddSubjects extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subjects'] = Subject::orderBy('id', 'desc')->paginate(5);
        return view('subjects.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjectCode' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required'
        ]);
        $subject = new Subject;
        $subject->subjectCode = $request->subjectCode;
        $subject->start = $request->start;
        $subject->end = $request->end;
        $subject->description = $request->description;
        $subject->save();
        return redirect()->route('subjects.index')
            ->with('success', 'Subject has been created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subject.show', compact('subject'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subjectCode' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
        ]);
        $subject = Subject::find($id);
        $subject->subjectCode = $request->subjectCode;
        $subject->start = $request->start;
        $subject->end = $request->end;
        $subject->description = $request->description;
        $subject->save();
        return redirect()->route('subject.index')
            ->with('success', 'Subject Has Been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')
            ->with('success', 'Company has been deleted successfully');
    }
}
