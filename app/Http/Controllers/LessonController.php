<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Lesson;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\LessonsDataTable;

class LessonController extends Controller
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
    public function index(LessonsDataTable $dataTable)
    {
        return $dataTable->render('lessons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $lesson='';
        $courses = Course::whereStatus('enable');
        if ($id) {
            $courses = $courses->whereId($id);
        }
        $courses = $courses->pluck('title', 'id');
        $trainers = User::role('trainer')->pluck('name', 'id');
        return view('lessons.create', compact('lesson', 'courses', 'trainers'));
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
            'video' => ['string', 'max:125'],
            'status' => ['string'],
            'course_id' => ['required', 'string'],
        ]);

        $request->merge([
            'status' => $request->status=='on' ? 'enable' : 'disable',
            'slug' => Str::slug($request->title, '-'),
        ]);

        $lesson = Lesson::create($request->all());
        
        if($request->c_id)
        {
            return redirect()->route('courses.show', $request->c_id)->with(['status' => 'success', 'message' => 'Lesson has been created']);
        }else{
            return redirect()->route('lessons.index')->with(['status' => 'success', 'message' => 'Lesson has been created']);
        }
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
        $courses = Course::whereStatus('enable')->pluck('name', 'id');
        $lesson = Lesson::findOrFail($id);
        $trainers = User::role('trainer')->pluck('name', 'id');
        return view('lessons.create', compact('lesson','courses', 'trainers'));
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
            'video' => ['string', 'max:125'],
            'status' => ['string'],
            'course_id' => ['required', 'string'],
        ]);

        $request->merge([
            'status' => $request->status=='on' ? 'enable' : 'disable',
            'slug' => Str::slug($request->title, '-'),
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());

        return redirect()->route('lessons.index')->with(['status' => 'success', 'message' => 'Lesson has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return redirect()->route('lessons.index')->with(['status' => 'success', 'message' => 'Lesson has been deleted']);
    }
}
