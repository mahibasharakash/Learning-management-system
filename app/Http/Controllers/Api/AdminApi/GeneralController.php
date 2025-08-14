<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class GeneralController
{

    public function tutor(Request $request): \Illuminate\Http\JsonResponse
    {
        $tutors = Tutor::query()->get();
        return response()->json($tutors);
    }

    public function department(Request $request): \Illuminate\Http\JsonResponse
    {
        $tutors = Department::query()->get();
        return response()->json($tutors);
    }

    public function course(Request $request): \Illuminate\Http\JsonResponse
    {
        $tutors = Course::query()->get();
        return response()->json($tutors);
    }

    public function student(Request $request): \Illuminate\Http\JsonResponse
    {
        $tutors = Student::query()->get();
        return response()->json($tutors);
    }

}
