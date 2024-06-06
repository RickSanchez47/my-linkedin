<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string|max:255',
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $candidate = Candidate::find($request->candidate_id);

        if ($candidate->cvs()->count() >= 2) {
            return response()->json(['message' => 'Candidate can only have a maximum of 2 CVs.'], 403);
        }

        $cv = $candidate->cvs()->create($request->all());

        return response()->json($cv, 201);
    }
}
