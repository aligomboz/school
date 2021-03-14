<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Grade;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Classrooms = Classroom::get();
        $grades = Grade::get();
        return view('pages.classRoom.classRoom',[
            'Classrooms' => $Classrooms,
            'grades' => $grades,
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
    public function store(ClassroomRequest $request)
    {
        //return $request;
        $List_Classes = $request->List_Classes;

        try {

            foreach ($List_Classes as $List_Class) {

                $My_Classes = new Classroom();

                $My_Classes->NameClass = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['NameClass']];

                $My_Classes->grade_id = $List_Class['grade_id'];

                $My_Classes->save();

            }

            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
       // return $request;
        try {
            $Classrooms = Classroom::findOrFail($request->id);
            $Classrooms->update([
                $Classrooms->NameClass = ['ar' => $request->NameClass, 'en' => $request->Name_en],
                $Classrooms->grade_id = $request->grade_id,
            ]);
            toastr()->success(__('The data has been successfully updated'));
            return redirect()->route('classrooms.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Classrooms = Classroom::findOrFail($request->id)->delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('classrooms.index');

    }
    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('classrooms.index');
    }
    public function filter_classes(Request $request)
    {
        $grades = Grade::get();
        $search = Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();
        return view('pages.classRoom.classRoom',compact('grades'))->withDetails($search);

    }
}
