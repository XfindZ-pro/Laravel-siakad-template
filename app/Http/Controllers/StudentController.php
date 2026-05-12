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
        $students = Student::paginate(5);

        // Data for Bar Chart: Students per Prodi
        $prodiData = Student::select('prodi', \DB::raw('count(*) as total'))
            ->groupBy('prodi')
            ->pluck('total', 'prodi')
            ->all();

        // Data for Line Chart: Students per Angkatan
        $angkatanData = Student::select('angkatan', \DB::raw('count(*) as total'))
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->pluck('total', 'angkatan')
            ->all();

        // Data for Chart: Graduated per Angkatan
        $graduatedData = Student::select('angkatan', \DB::raw('count(*) as total'))
            ->where('is_graduated', true)
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->pluck('total', 'angkatan')
            ->all();

        // Data for 4th Chart: Gender Distribution (Pie Chart)
        $genderData = Student::select('gender', \DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender')
            ->all();

        return view('student.index', compact(
            'students',
            'prodiData',
            'angkatanData',
            'graduatedData',
            'genderData'
        ));
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
            'prodi' => 'required',
            'angkatan' => 'required|integer',
            'gender' => 'required',
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
            'email' => 'required|email',
            'prodi' => 'required',
            'angkatan' => 'required|integer',
            'gender' => 'required',
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