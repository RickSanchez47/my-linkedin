<?php

use App\Http\Controllers\JobPostController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ExportController;

Route::get('/job-posts', [JobPostController::class, 'index']);
Route::post('/job-posts', [JobPostController::class, 'store']);
Route::get('/job-posts/{id}/candidates', [JobPostController::class, 'getCandidates']);

Route::post('/cvs', [CVController::class, 'store']);

Route::post('/applications', [ApplicationController::class, 'apply']);

Route::post('/interviews', [InterviewController::class, 'arrange']);
Route::get('/interviews/{id}/download-cv', [InterviewController::class, 'downloadCV']);

Route::get('/exports/{id}/candidate-details', [ExportController::class, 'exportCandidateDetails']);
