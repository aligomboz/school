<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Grade;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();

        $list_Grades = Grade::all();
    
        return view('pages.section.section',compact('grades','list_Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Sections = new Section();
      
            $Sections->name_section = ['ar' => $request->name_section_Ar, 'en' => $request->name_section_En];
            $Sections->grade_id = $request->grade_id;
            $Sections->class_id = $request->class_id;
            $Sections->status = 1;
            $Sections->save();
            toastr()->success(__('The data has been saved successfully'));
      
            return redirect()->route('sections.index');
        }
      
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
            $Sections = Section::findOrFail($request->id);
      
            $Sections->name_section = ['ar' => $request->name_section_Ar, 'en' => $request->name_section_En];
            $Sections->grade_id = $request->grade_id;
            $Sections->class_id = $request->class_id;
      
            if(isset($request->status)) {
              $Sections->status = 1;
            } else {
              $Sections->status = 2;
            }
      
            $Sections->save();
            toastr()->success(__('The data has been successfully updated'));
      
            return redirect()->route('sections.index');
        } 
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('sections.index');
    }
    public function getclasses($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("NameClass", "id");

        return $list_classes;
    }

}
