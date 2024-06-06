<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Employer;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        // Start with all job posts
        $query = JobPost::query()->with('employer');
        // Apply filters if provided
        if ($request->has('salaryRange')) {
            $query->where('salary', '>=', $request->salaryRange[0])
                  ->where('salary', '<=', $request->salaryRange[1]);
        }

        if ($request->has('jobTitle')) {
            $query->where('title', 'like', '%' . $request->jobTitle . '%');
        }

        if ($request->has('employer')) {
            $query->whereHas('employer', function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->employer . '%');
            });
        }

        // Get filtered job posts
        $jobPosts = $query->get();


        return response()->json($jobPosts);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric',
            'employer_id' => 'required|exists:employers,id',
        ]);

        $employer = Employer::find($request->employer_id);

        if ($employer->jobPosts()->count() >= 5) {
            return response()->json(['message' => 'Employer can only post a maximum of 5 job posts.'], 403);
        }

        $jobPost = $employer->jobPosts()->create($request->all());

        return response()->json($jobPost, 201);
    }

    public function getCandidates($id)
    {
        $jobPost = JobPost::findOrFail($id);
        $candidates = $jobPost->applications()->with('candidate')->get();

        return response()->json($candidates, 200);
    }
}
