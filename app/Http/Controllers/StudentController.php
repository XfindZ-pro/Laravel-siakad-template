<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\DBLogActivity;

class StudentController extends Controller
{
    // CRUD function
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $student = Student::create($request->all());

        DBLogActivity::create([
            'action' => 'Create Student',
            'description' => 'Added new student: ' . $student->name,
        ]);

        return redirect('/student');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        DBLogActivity::create([
            'action' => 'Update Student',
            'description' => 'Updated student ID ' . $id . ' to name: ' . $student->name,
        ]);

        return redirect('/student');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $name = $student->name;
        $student->delete();

        DBLogActivity::create([
            'action' => 'Delete Student',
            'description' => 'Deleted student: ' . $name . ' (ID: ' . $id . ')',
        ]);

        return redirect('/student');
    }

}