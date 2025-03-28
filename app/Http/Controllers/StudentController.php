<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students
    public function index()
    {
        if ($request->ajax()) {
            return view('students.partials.table', ['students' => Student::all()]);
        }
        return view('students.index', ['students' => Student::all()]);
    }

    // Show the form to create a new student
    public function create()
    {
        return view('create');
    }

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);

        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('index')->with('success', 'Student added successfully!');
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $students = Student::where('name', 'LIKE', "%$query%")->get();
        return view('students.partials.table', compact('students'));
    }

    public function filter(Request $request) {
        $query = $request->input('query');
        $minAge = $request->input('minAge');
        $maxAge = $request->input('maxAge');
    
        $students = Student::where('name', 'LIKE', "%$query%")
                           ->when($minAge, fn($q) => $q->where('age', '>=', $minAge))
                           ->when($maxAge, fn($q) => $q->where('age', '<=', $maxAge))
                           ->get();
    
        return view('students.partials.table', compact('students'));
    }
    
    

    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
