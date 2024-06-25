<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courseQuery = Course::query();

        if ($user->hasRole('teacher')) {
            $courseQuery->whereHas('teacher', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

            $students = CourseStudent::whereIn('course_id', $courseQuery->select('id'))->distinct('user_id')->count('user_id');
        } else {
            $students = CourseStudent::distinct('user_id')->count('user_id');
        }

        $courses = $courseQuery->count();
        $categories = Category::count();
        $transactions = SubscribeTransaction::count();
        $teachers = Teacher::count();

        return view('dashboard', compact('teachers', 'transactions', 'categories', 'students', 'courses'));

    }
}
