<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $students = User::where('user_type', 'student')
            ->with(['branch', 'enrollments.batch'])
            ->paginate(15);

        return response()->json([
            'status' => 'success',
            'data' => $students
        ]);
    }

    public function show(User $student): JsonResponse
    {
        if ($student->user_type !== 'student') {
            return response()->json(['message' => 'User is not a student'], 404);
        }

        $student->load(['branch', 'attendances', 'fees', 'aiInsights']);

        return response()->json([
            'status' => 'success',
            'data' => $student
        ]);
    }
}
