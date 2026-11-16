@extends('layouts.app')

@section('title', $project->title . ' — Projects — BECS')

@section('styles')
    <style>
        /* ===== PROJECT DETAIL PAGE SPECIFIC STYLES ===== */
        .project-detail { padding: 8rem 0; background: var(--color-black); }
        
        /* Breadcrumb Navigation */
        .breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; font-weight: 500; color: var(--color-text-secondary); margin-bottom: 2rem; }
        .breadcrumb a { transition: var(--transition); }
        .breadcrumb a:hover { color: var(--color-teal); }
        .breadcrumb span { color: var(--color-text-muted); }
        .breadcrumb i { font-size: 0.65rem; color: var(--color-text-muted); }

        .project-header-layout { margin-bottom: 3.5rem; }
        .project-header-layout h1 { font-family: var(--font-heading); font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.1; margin-bottom: 0.75rem; letter-spacing: -0.02em; }
        .project-header-layout h1 span { background: linear-gradient(135deg, var(--color-teal-light), var(--color-teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .project-category-tag { display: inline-block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-teal-light); letter-spacing: 0.1em; margin-bottom: 0.5rem; }

        /* Grid Layout */
        .project-grid { display: grid; grid-template-columns: 1.3fr 0.7fr; gap: 4rem; }

        /* Gallery Column */
        .gallery-container { display: flex; flex-direction: column; gap: 1.5rem; }
        .featured-image-wrap { position: relative; width: 100%; height: 500px; border-radius: 12px; overflow: hidden; border: 1px solid var(--color-border); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); }
        .featured-image { width: 100%; height: 100%; object-fit: cover; transition: var(--transition-slow); }
        .thumbnail-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap: 0.85rem; }
        .thumbnail-card { position: relative; height: 75px; border-radius: 8px; overflow: hidden; border: 2px solid transparent; cursor: pointer; transition: var(--transition); }
        .thumbnail-card img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.85); transition: var(--transition); }
        .thumbnail-card:hover img { filter: brightness(1); }
        .thumbnail-card.active { border-color: var(--color-teal); }
        
        /* Overview */
        .overview-section { margin-top: 3rem; }
        .overview-title { font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; color: var(--color-text-primary); margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border); padding-bottom: 0.5rem; }
        .overview-description { font-size: 1.05rem; color: var(--color-text-secondary); line-height: 1.8; }
        .overview-description p { margin-bottom: 1rem; }
        .overview-description ul, .overview-description ol { padding-left: 1.5rem; margin-bottom: 1rem; }
        .overview-description ul { list-style: disc; }
        .overview-description ol { list-style: decimal; }
        .overview-description li { margin-bottom: 0.5rem; }
        .overview-description a { color: var(--color-teal); text-decoration: underline; }

        /* Info Card Column */
        .info-sidebar { display: flex; flex-direction: column; gap: 2rem; position: sticky; top: 100px; }
        .info-card { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: 12px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); }
        .info-card-title { font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--color-text-primary); }
        
        .info-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .info-item { display: flex; gap: 1rem; align-items: flex-start; }
        .info-icon { width: 40px; height: 40px; border-radius: 8px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); display: flex; align-items: center; justify-content: center; color: var(--color-teal-light); font-size: 1rem; }
        .info-details h4 { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); margin-bottom: 0.25rem; }
        .info-details p { font-size: 0.95rem; font-weight: 600; color: var(--color-text-primary); line-height: 1.4; }

        /* Sidebar CTA */
        .sidebar-cta { background: linear-gradient(135deg, var(--color-surface-2), var(--color-surface-3)); border: 1px solid var(--color-border-teal); border-radius: 12px; padding: 2.5rem; text-align: center; }
        .sidebar-cta h3 { font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; margin-bottom: 0.75rem; color: var(--color-text-primary); }
        .sidebar-cta p { font-size: 0.875rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; line-height: 1.6; }
        .sidebar-cta .btn-primary { width: 100%; justify-content: center; }
        
        .btn-back-portfolio { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; font-weight: 600; color: var(--color-teal); transition: var(--transition); margin-top: 1rem; }
        .btn-back-portfolio:hover { color: var(--color-teal-light); transform: translateX(-4px); }

        @media (max-width: 1024px) {
            .project-grid { grid-template-columns: 1fr; gap: 3rem; }
            .info-sidebar { position: static; }
        }
        
        @media (max-width: 768px) {
            .featured-image-wrap { height: 350px; }
            .thumbnail-grid { grid-template-columns: repeat(4, 1fr); gap: 0.75rem; }
        }
    </style>
@endsection

@section('content')
    <!-- BREADCRUMB HEADER -->
    <section class="project-detail">
        <div class="container">
            <!-- Breadcrumbs -->
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ url('/projects') }}">Projects</a>
                <i class="fas fa-chevron-right"></i>
                <span>{{ $project->title }}</span>
            </div>

            <!-- Page Title -->
            <div class="project-header-layout reveal">
                <div class="project-category-tag">{{ $project->category?->name ?? 'Engineering' }}</div>
                <h1>{{ $project->title }}</h1>
            </div>

            <!-- Main Layout Grid -->
            <div class="project-grid">
                <!-- Gallery Column -->
                <div class="gallery-container reveal reveal-delay-1">
                    @php
                        $allImages = [];
                        if ($project->featured_image) {
                            $allImages[] = $project->featured_image;
                        }
                        foreach ($project->images as $img) {
                            if ($img->image !== $project->featured_image) {
                                $allImages[] = $img->image;
                            }
                        }
                    @endphp

                    @if(count($allImages) > 0)
                        <div class="featured-image-wrap">
                            <img id="featured-img" class="featured-image" src="{{ $allImages[0] }}" alt="{{ $project->title }}">
                        </div>
                        <div class="thumbnail-grid">
                            @foreach($allImages as $index => $img)
                                <div class="thumbnail-card {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage('{{ $img }}', this)">
                                    <img src="{{ $img }}" alt="Project image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Overview Section -->
                    <div class="overview-section">
                        <div class="overview-title">Project Overview</div>
                        <div class="overview-description">
                            @if(filled(strip_tags($project->description ?? '')))
                                {!! $project->description !!}
                            @else
                                <p>No description provided for this project. Please contact our offices for technical specs and engineering details.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info Sidebar Column -->
                <div class="info-sidebar reveal reveal-delay-2">
                    <div class="info-card">
                        <div class="info-card-title">Key Information</div>
                        <div class="info-list">
                            <!-- Location -->
                            @if($project->location)
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="info-details">
                                    <h4>Location</h4>
                                    <p>{{ $project->location }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Category -->
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-folder-open"></i></div>
                                <div class="info-details">
                                    <h4>Sector</h4>
                                    <p>{{ $project->category?->name ?? 'Engineering Contracting' }}</p>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-hard-hat"></i></div>
                                <div class="info-details">
                                    <h4>Status</h4>
                                    <p>{{ ucfirst($project->status ?? 'N/A') }}</p>
                                </div>
                            </div>

                            <!-- Client -->
                            @if($project->client)
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-building"></i></div>
                                <div class="info-details">
                                    <h4>Client</h4>
                                    <p>{{ $project->client }}</p>
                                </div>
                            </div>
                            @endif

                            @if($project->completion_date)
                            <!-- Year Completed -->
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-calendar-check"></i></div>
                                <div class="info-details">
                                    <h4>Year Completed</h4>
                                    <p>{{ \Carbon\Carbon::parse($project->completion_date)->format('Y') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar CTA -->
                    <div class="sidebar-cta">
                        <h3>Interested in our work?</h3>
                        <p>Discuss details, technical specifications, or initiate an inquiry for a similar engineering project.</p>
                        <a href="{{ url('/contact') }}" class="btn-primary">Initiate Your Request</a>
                    </div>

                    <!-- Back Navigation Link -->
                    <a href="{{ url('/projects') }}" class="btn-back-portfolio">
                        <i class="fas fa-arrow-left"></i> Back to Portfolio
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function changeMainImage(url, element) {
            document.getElementById('featured-img').src = url;
            
            // Remove active class from all thumbnails
            const thumbs = document.querySelectorAll('.thumbnail-card');
            thumbs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumbnail
            element.classList.add('active');
        }
    </script>
@endsection
