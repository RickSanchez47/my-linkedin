<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportCandidateDetails($id)
    {
        $candidate = Candidate::findOrFail($id);
        return Excel::download(new CandidateDetailsExport($candidate), 'candidate-details.xlsx');
    }
}
