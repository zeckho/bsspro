<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $courses = Course::whereStatus('enable')->with('user_courses')->get();
        return view('classes.index', compact('courses'));
    }

    public function learn($id)
    {
        $course = Course::findOrFail($id);
        $data = [
            'course_id' => $id,
            'user_id' => Auth::id(),
        ];
        
        UserCourse::create($data);

        return redirect()->route('classes.view', $course->slug);
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function view($slug)
    {
        $courses = Course::whereSlug($slug)->with('user_courses')->first();
        // dd($courses);
        return view('classes.view',compact('courses'));
    }

    public function myClasses()
    {
        $courses = UserCourse::where('user_id', Auth::id())->with('courses')->get();
        // dd($courses);
        return view('classes.myclass',compact('courses'));
    }
}
