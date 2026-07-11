<?php

use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

// Home — featured projects + first 3 services
Route::get('/', function () {
    $services         = Service::orderBy('order')->take(3)->get();
    $featuredProjects = Project::with('category')
        ->where('is_featured', true)
        ->latest()
        ->take(3)
        ->get();

    return view('home', compact('services', 'featuredProjects'));
});

// About
Route::get('/about', function () {
    return view('about');
});

// Services — all services ordered
Route::get('/services', function () {
    $services = Service::orderBy('order')->get();
    return view('services', compact('services'));
});

// Projects — all valid projects with category
Route::get('/projects', function () {
    $projects   = Project::with('category')
        ->whereNotNull('description')
        ->where('description', '!=', '')
        ->orderBy('is_featured', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();
    $categories = \App\Models\ProjectCategory::orderBy('name')->get();

    return view('projects', compact('projects', 'categories'));
});

// Project detail — by slug
Route::get('/projects/{slug}', function ($slug) {
    $project = Project::with(['category', 'images'])
        ->where('slug', $slug)
        ->firstOrFail();

    return view('project-detail', compact('project'));
});

// Contact
Route::get('/contact', function () {
    return view('contact');
});

use App\Http\Controllers\ContactController;
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


