<?php

namespace App\Http\Controllers;

use App\Models\AdmissionInquiry;
use App\Models\Branch;
use Illuminate\Http\Request;

class AdmissionsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name'    => 'required|string|max:255',
            'student_phone'   => 'required|string|max:25',
            'guardian_phone'  => 'nullable|string|max:25',
            'batch_name'      => 'nullable|string|max:255',
            'selected_branch' => 'nullable|string|max:255',
        ]);

        // Attempt to match branch
        $branch = Branch::where('name', 'like', '%' . ($validated['selected_branch'] ?? '') . '%')->first();

        AdmissionInquiry::create([
            'branch_id'      => $branch?->id,
            'student_name'   => $validated['student_name'],
            'student_phone'  => $validated['student_phone'],
            'guardian_phone' => $validated['guardian_phone'] ?? null,
            'batch_name'     => $validated['batch_name'] ?? 'HSC Science Special',
            'campus_name'    => $validated['selected_branch'] ?? 'Dhaka Central Campus',
            'status'         => 'pending',
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Application received successfully!']);
        }

        return back()->with('enroll_success', true);
    }
}
