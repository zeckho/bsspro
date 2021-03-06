<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\CoursesDataTable;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = '';
        return view('courses.create', compact('course'));
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
        ]);

        $request->merge([
            'status' => $request->status=='on' ? 'enable' : 'disable',
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id()
        ]);

        $course = Course::create($request->all());
        
        return redirect()->route('courses.index')->with(['status' => 'success', 'message' => 'Course has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.create', compact('course'));
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
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
        ]);

        $course = Course::findOrFail($id);
        $request->merge([
            'status' => $request->status=='on' ? 'enable' : 'disable',
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id()
        ]);
        $course->update($request->all());
        
        return redirect()->route('courses.index')->with(['status' => 'success', 'message' => 'Course has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')->with(['status' => 'success', 'message' => 'Course has been deleted']);
    }
}
