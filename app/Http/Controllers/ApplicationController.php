<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Candidate;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'job_post_id' => 'required|exists:job_posts,id',
            'cv_id' => 'required|exists:cvs,id',
        ]);

        $application = Application::create($request->all());

        return response()->json($application, 201);
    }
    public function applications($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        $applications = $candidate->applications;
        
        if ($applications) {
            return response()->json($applications);
        } else {
            return response()->json(['message' => 'CV not found for the candidate.'], 404);
        }
    }
}
