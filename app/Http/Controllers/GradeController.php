<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Grade;
use App\Http\Requests\StoreGradeRequest;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Grade $grade)
    {
        $grades = $grade->get();
        return view('pages.grades.index',[
            'grades' => $grades
        ]);
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
    public function store(StoreGradeRequest $request)
    {
        //return $request;
        try {
            $Grade = new Grade();
            /*
            $translations = [
                'en' => $request->Name_en,
                'ar' => $request->Name
            ];
            $Grade->setTranslations('Name', $translations);
            */
            $Grade->name = ['en' => $request->name_en, 'ar' => $request->name];
            $Grade->note = $request->note;
            $Grade->save();
            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('grades.index');
        }
  
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGradeRequest $request, Grade $grade)
    {
        // return $request;
        try {
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
              $Grades->name = ['ar' => $request->name, 'en' => $request->name_en],
              $Grades->note = $request->note,
            ]);
            toastr()->success(__('The data has been successfully updated'));
            return redirect()->route('grades.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $my_class = Classroom::where('grade_id' , $request->id)->pluck('grade_id');
        if($my_class->count() == 0) {
            Grade::findOrFail($request->id)->delete();
            toastr()->error(__('The data has been deleted successfully'));
            return redirect()->route('grades.index');
        }else{
            toastr()->error(__('The row cannot be deleted because it contains sections'));
            return redirect()->route('grades.index');
        }
        
    }
}
