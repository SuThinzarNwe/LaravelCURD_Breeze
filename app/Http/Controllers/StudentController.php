<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Place;
use App\Models\Category;
use App\Http\Requests\StoreStudent;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->search()->with(['place', 'categories'])->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Create a new Student
     *
     * @return view
     */
    public function create()
    {
        $places = Place::all();
        $categories = Category::all();
        return view('students.create', compact('places', 'categories'));
    }

    /**
     * Save the Student data to the database
     *
     * @param StoreStudent $request
     * @return view
     */
    public function store(StoreStudent $request)
    {
        $students = $request->all();
        info($students);
        $cats = $request->cat;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(storage_path('app/public/images'), $imageName);
        }

        $students = Student::create([
            'name' => $request->name,
            'image' => $imageName,
            'place_id' => $request->place_id,
        ]);

        $students->categories()->sync($cats);
        return redirect('students')->with('success', 'Student Added!');
    }


    /**
     * Show the student
     *
     * @param [int] $id
     * @return view
     */
    public function show($id)
    {
        $students = Student::find($id);
        $places = Place::all();
        $categories = Category::all();
        //$students = $students->categories();
        //return view('students.show')->with('students', $students);
        return view('students.show', compact('places', 'categories', 'students'));
    }

    /**
     * Edit the student data
     *    
     * @param [int] $id
     * @return view
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $places = Place::all();
        $categories = Category::all();
        return view('students.edit', compact('places', 'categories', 'student'));
    }

    /**
     * Update the student data
     *
     * @param StoreStudent $request
     * @param [int] $id
     * @return view
     */
    public function update(StoreStudent $request, $id)
    {
        $student = Student::find($id);
        $cats = $request->cat;
        if ($request->hasFile('image')) {
            unlink(storage_path('app/public/images/') . $student->image);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(storage_path('app/public/images'), $imageName);
        } else {
            $imageName = $student->image;
        }

        $student->update([
            'name' => $request->name,
            'image' => $imageName,
            'place_id' => $request->place_id,
        ]);

        $student->categories()->sync($cats);
        return redirect('students')->with('success', 'Student Updated!');
    }

    /**
     * Delete the student
     *
     * @param [int] $id
     * @return view
     */
    public function delete($id)
    {
        $student = Student::find($id);
        // if ($student->hasFile('image')) {
        //     unlink(storage_path('app/public/images/') . $student->image);
        // }
        unlink(storage_path('app/public/images/') . $student->image);
        $student->categories()->detach();
        $student->delete();

        return redirect('students')->with('success', 'Student deleted!');
    }
}
