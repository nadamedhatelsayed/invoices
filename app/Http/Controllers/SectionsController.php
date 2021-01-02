<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectionRequest;

class SectionsController extends Controller
{

    public function index()
    {
        $sections = sections::all();
        return view('sections.sections', compact('sections'));
    }


    public function create()
    {
        //
    }


    public function store(SectionRequest $request)
    {
        $validated = $request->validated();


        sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'Created_by' => (Auth::user()->name),

        ]);

        return redirect()->back()->with(['Add' => 'تم اضافه العرض بنجاح ']);
    }


    public function show(sections $sections)
    {
        //
    }


    public function edit(sections $sections)
    {
        //
    }


    public function update(Request $request)
    {
        // $section = sections::find($id);
        // if (!$section)
        //    return redirect()->back();

        //  //update data

        // $section->update($request->all());

        // return redirect()->back()->with(['edit' => '  تم تعديل القسم بنجاح     ']);


        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $sections = sections::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with(['edit' => '  تم تعديل القسم بنجاح     ']);
     }


    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        return redirect()->back()->with(['delete' => '   تم حذف العنصر بنجاح     ']);
    }
}
