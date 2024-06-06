<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InterviewController extends Controller
{
    public function arrange(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'scheduled_at' => 'required|date',
        ]);

        $interview = Interview::create($request->all());

        // Notify candidate via email
        $application = $interview->application;
        $candidate = $application->candidate;
        //Mail::to($candidate->email)->send(new InterviewScheduled($interview));

        return response()->json($interview, 201);
    }

    public function downloadCV($id)
    {
        $interview = Interview::findOrFail($id);
        $cv = $interview->application->cv;

        return Storage::download($cv->file_path);
    }
}
