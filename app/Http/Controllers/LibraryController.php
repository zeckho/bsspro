<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\LibrariesDataTable;

class LibraryController extends Controller
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
    public function index(LibrariesDataTable $dataTable)
    {
        return $dataTable->render('libraries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $library = '';
        return view('libraries.create', compact('library'));
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
            'status' => ['string'],
        ]);

        $request->merge([
            'status' => $request->status=='on' ? 'enable' : 'disable',
            'slug' => $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->title, '-'),
        ]);

        $library = Library::create($request->all());
        
        return redirect()->route('libraries.index')->with(['status' => 'success', 'message' => 'Library has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        return view('libraries.create', compact('library'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['string'],
        ]);

        $request->merge([
            'status' => $request->status=='on' ? 'enable' : 'disable',
            'slug' => $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->title, '-'),
        ]);
        $library->update($request->all());
        
        return redirect()->route('libraries.index')->with(['status' => 'success', 'message' => 'Library has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        $library->delete();
        return redirect()->route('libraries.index')->with(['status' => 'success', 'message' => 'Library has been deleted']);
    }
}
