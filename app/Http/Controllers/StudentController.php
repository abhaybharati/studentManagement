<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        // If request data found the the response would be in json other wise it will load the home page
        if (request()->ajax()) {
            $students = Student::latest()->get();
            return response()->json(['students' => $students]);
        }

        return view('home');
    }

    // create or update the student data
    public function store(Request $request)
    {

        // find the student data by student id if found then update.

        $student = Student::find($request->student_id);

        if ($student) {
            // Update the existing record
            $student->update([
                'name' => $request->name,
                'subject' => $request->subject,
                'marks' => $request->marks
            ]);
        } else {
            // Create a new record if not any id found
            $student = Student::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'marks' => $request->marks
            ]);
        }

        return response()->json(['student' => $student]);
    }

    // find the student by id and return response to json to populat in modal.
    public function edit($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }
    
    // delete function to find the data of student by id and if found delete it
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
