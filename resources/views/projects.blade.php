@extends('layouts.app')

@section('title', 'Our Projects — BECS')

@section('styles')
    <style>
        /* ===== PORTFOLIO PAGE SPECIFIC STYLES ===== */

        .portfolio { padding: 6rem 0 8rem; background: var(--color-black); }
        
        .portfolio-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 4rem; }
        .portfolio-header h2 { font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); font-weight: 800; letter-spacing: -0.01em; }

        .portfolio-controls { display: flex; align-items: center; justify-content: space-between; gap: 2rem; margin-bottom: 3.5rem; flex-wrap: wrap; }
        .portfolio-filter { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        
        .filter-btn { padding: 0.55rem 1.35rem; background: transparent; border: 1px solid var(--color-border); border-radius: 100px; color: var(--color-text-secondary); font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: var(--transition); font-family: var(--font-body); letter-spacing: 0.02em; }
        .filter-btn.active, .filter-btn:hover { border-color: var(--color-teal); color: var(--color-teal-light); background: var(--color-teal-glow); }

        .portfolio-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; transition: all 0.4s ease; }
        
        .portfolio-card { position: relative; border-radius: 12px; overflow: hidden; background: var(--color-surface); border: 1px solid var(--color-border); cursor: pointer; transition: var(--transition-slow); display: flex; flex-direction: column; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.02); }
        .portfolio-card:hover { border-color: var(--color-border-teal); transform: translateY(-6px); box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06); }

        .portfolio-img-wrap { position: relative; height: 260px; overflow: hidden; }
        .portfolio-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: var(--transition-slow); filter: brightness(0.9); }
        .portfolio-card:hover .portfolio-img-wrap img { transform: scale(1.04); filter: brightness(0.8); }

        .portfolio-card-content { padding: 1.75rem; display: flex; flex-direction: column; flex-grow: 1; background: var(--color-white); }
        
        .portfolio-meta { display: flex; align-items: center; justify-content: space-between; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; color: var(--color-teal-light); margin-bottom: 0.75rem; }
        .portfolio-meta-year { color: var(--color-text-muted); font-weight: 500; }

        .portfolio-card h3 { font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--color-text-primary); line-height: 1.3; transition: var(--transition); }
        .portfolio-card:hover h3 { color: var(--color-teal-light); }
        .portfolio-card p { font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        .portfolio-details-list { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; border-top: 1px solid var(--color-border); padding-top: 1.25rem; }
        .portfolio-details-item { display: flex; flex-direction: column; gap: 0.25rem; }
        .portfolio-details-item span:first-child { font-size: 0.68rem; text-transform: uppercase; color: var(--color-text-muted); letter-spacing: 0.05em; font-weight: 600; }
        .portfolio-details-item span:last-child { font-size: 0.85rem; font-weight: 600; color: var(--color-text-primary); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

        .portfolio-arrow-circle { position: absolute; top: 1.25rem; right: 1.25rem; width: 36px; height: 36px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--color-teal-light); font-size: 0.78rem; transition: var(--transition); z-index: 2; }
        .portfolio-card:hover .portfolio-arrow-circle { background: var(--color-teal); border-color: var(--color-teal); color: white; transform: rotate(-45deg); }

        @media (max-width: 1024px) {
            .portfolio-grid { grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        }
        @media (max-width: 768px) {
            .portfolio-header { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
            .portfolio-controls { flex-direction: column; align-items: flex-start; gap: 1.25rem; }
            .portfolio-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <header class="page-header">
        <div class="container page-header-content">
            <div class="section-tag">Portfolio</div>
            <h1>Engineering a<br><span>Better Tomorrow.</span></h1>
            <p>Explore our successfully delivered contracting works, site developments, and project management operations across Lebanon and the region.</p>
        </div>
    </header>

    <!-- PORTFOLIO SECTION -->
    <section class="portfolio">
        <div class="container">
            <div class="portfolio-controls reveal">
                <!-- Filter Buttons -->
                <div class="portfolio-filter" id="portfolio-filter">
                    <button class="filter-btn active" data-filter="all">All Projects</button>
                    @foreach($categories as $cat)
                        <button class="filter-btn" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
                    @endforeach
                </div>
            </div>

            <!-- PROJECTS GRID -->
            <div class="portfolio-grid reveal reveal-delay-1" id="portfolio-grid">
                @foreach($projects as $project)
                    <div class="portfolio-card"
                         data-category="{{ $project->category?->slug ?? 'commercial' }}"
                         data-title="{{ strtolower($project->title) }}"
                         data-location="{{ strtolower($project->location ?? '') }}"
                         onclick="window.location.href='{{ url('/projects/' . $project->slug) }}'">
                        <div class="portfolio-arrow-circle"><i class="fas fa-arrow-right"></i></div>
                        <div class="portfolio-img-wrap">
                            <img src="{{ $project->featured_image_url ??'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=600&auto=format&fit=crop&q=60' }}" alt="{{ $project->title }}">
                        </div>
                        <div class="portfolio-card-content">
                            <div class="portfolio-meta">
                                <span>{{ $project->category?->name ?? 'Engineering' }}</span>
                                <span class="portfolio-meta-year">{{ $project->completion_date ? \Carbon\Carbon::parse($project->completion_date)->format('Y') : ($project->status === 'ongoing' ? 'In Progress' : 'N/A') }}</span>
                            </div>
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->short_description ?: \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($project->description ?? '')), 160) }}</p>
                            <div class="portfolio-details-list">
                                <div class="portfolio-details-item">
                                    <span>Location</span>
                                    <span>{{ $project->location ?? 'N/A' }}</span>
                                </div>
                                <div class="portfolio-details-item">
                                    <span>Status</span>
                                    <span>{{ ucfirst($project->status ?? 'N/A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- COMMON CTA -->
    <section class="section-cta-block" id="projects-cta-block">
        <div class="container section-cta-content">
            <div class="section-tag" style="justify-content:center;">Collaboration</div>
            <h2>Let's Engineer Your<br><span>Next Project Together</span></h2>
            <p>From architectural coordination and detail modeling to execution supervision, we deliver results you can build on.</p>
            <a href="{{ url('/contact') }}" class="btn-primary">Initiate Your Request</a>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Dynamic filter logic
        const cards = document.querySelectorAll('.portfolio-card');
        const filterBtns = document.querySelectorAll('#portfolio-filter .filter-btn');
        
        let currentFilter = 'all';

        function updateList() {
            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const matchesFilter = (currentFilter === 'all' || category === currentFilter);
                card.style.display = matchesFilter ? 'flex' : 'none';
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.getAttribute('data-filter');
                updateList();
            });
        });
    </script>
@endsection
