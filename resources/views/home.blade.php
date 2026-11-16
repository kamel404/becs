@extends('layouts.app')

@section('title', 'BECS — Bureau of Engineering & Contracting Services')

@section('styles')
    <style>
        /* ===== HERO ===== */
        .hero { position: relative; min-height: 100vh; display: flex; align-items: center; overflow: hidden; padding: calc(var(--nav-height) + 4rem) 0 4rem; }
        .hero-bg { position: absolute; inset: 0; z-index: 0; }
        .hero-bg img { width: 100%; height: 100%; object-fit: cover; opacity: 0.22; filter: saturate(0.9) brightness(1.08); }
        .hero-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(246,248,249,0.92) 0%, rgba(246,248,249,0.74) 42%, rgba(58,124,121,0.08) 72%, rgba(246,248,249,0.96) 100%); }
        .hero-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(58,124,121,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(58,124,121,0.06) 1px, transparent 1px); background-size: 60px 60px; }

        .hero-content { position: relative; z-index: 1; width: 100%; }

        .hero-eyebrow { display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.4rem 1rem 0.4rem 0.5rem; background: rgba(58,124,121,0.12); border: 1px solid var(--color-border-teal); border-radius: 100px; margin-bottom: 1.5rem; animation: fadeSlideUp 0.8s ease both; }
        .hero-eyebrow-dot { width: 8px; height: 8px; background: var(--color-teal); border-radius: 50%; animation: pulse-dot 2s infinite; }
        .hero-eyebrow span { font-size: 0.72rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-teal-light); }

        .hero-title { font-family: var(--font-heading); font-size: clamp(3rem, 6vw, 5.5rem); font-weight: 800; line-height: 1.08; letter-spacing: -0.02em; margin-bottom: 1.5rem; animation: fadeSlideUp 0.8s 0.1s ease both; }
        .hero-title .highlight { background: linear-gradient(135deg, var(--color-teal-light), var(--color-teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        .hero-subtitle { font-size: 1.1rem; color: var(--color-text-secondary); max-width: 540px; line-height: 1.75; margin-bottom: 2.5rem; animation: fadeSlideUp 0.8s 0.2s ease both; }
        .hero-actions { display: flex; align-items: center; gap: 1rem; margin-bottom: 4rem; animation: fadeSlideUp 0.8s 0.3s ease both; flex-wrap: wrap; }

        .hero-stats { display: flex; align-items: center; gap: 3rem; padding-top: 3rem; border-top: 1px solid var(--color-border); animation: fadeSlideUp 0.8s 0.4s ease both; flex-wrap: wrap; }
        .hero-stat-value { font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 0.25rem; }
        .hero-stat-value span { color: var(--color-teal-light); }
        .hero-stat-label { font-size: 0.78rem; color: var(--color-text-muted); letter-spacing: 0.05em; text-transform: uppercase; }

        .scroll-indicator { position: absolute; bottom: 2.5rem; right: 2.5rem; z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 0.5rem; animation: fadeSlideUp 1s 1s ease both; }
        .scroll-indicator span { font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-text-muted); writing-mode: vertical-rl; }
        .scroll-line { width: 1px; height: 55px; background: linear-gradient(to bottom, var(--color-teal), transparent); animation: scroll-anim 1.5s ease infinite; }

        /* ===== ABOUT ===== */
        .about { padding: 8rem 0; background: var(--color-surface); position: relative; overflow: hidden; }
        .about::before { content: ''; position: absolute; top: -200px; right: -200px; width: 600px; height: 600px; background: radial-gradient(circle, var(--color-teal-glow) 0%, transparent 70%); pointer-events: none; }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; }

        .about-image-wrap { position: relative; }
        .about-image-main { width: 100%; height: 500px; object-fit: cover; border-radius: 8px; }
        .about-image-badge { position: absolute; bottom: -2rem; right: -2rem; background: var(--color-teal); color: white; padding: 1.75rem; border-radius: 8px; text-align: center; }
        .about-image-badge-num { font-family: var(--font-heading); font-size: 2.75rem; font-weight: 800; line-height: 1; display: block; }
        .about-image-badge-txt { font-size: 0.72rem; opacity: 0.85; letter-spacing: 0.05em; text-transform: uppercase; }

        .about-content h2 { font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); font-weight: 800; line-height: 1.15; letter-spacing: -0.01em; margin-bottom: 1.5rem; }
        .about-content p { color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 1rem; }

        .about-features { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin: 2rem 0; }
        .about-feature { display: flex; align-items: flex-start; gap: 0.75rem; }
        .about-feature-icon { width: 34px; height: 34px; min-width: 34px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--color-teal-light); font-size: 0.8rem; }
        .about-feature-text { font-size: 0.875rem; color: var(--color-text-secondary); font-weight: 500; }

        /* ===== SERVICES ===== */
        .services { padding: 8rem 0; background: var(--color-black); }
        .section-header { text-align: center; margin-bottom: 4rem; }
        .section-header h2 { font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); font-weight: 800; letter-spacing: -0.01em; margin-bottom: 1rem; }
        .section-header p { color: var(--color-text-secondary); max-width: 530px; margin: 0 auto; line-height: 1.7; }

        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5px; background: var(--color-border); border: 1px solid var(--color-border); border-radius: 12px; overflow: hidden; }
        .service-card { background: var(--color-surface); padding: 2.5rem; transition: var(--transition); position: relative; overflow: hidden; cursor: pointer; }
        .service-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent, var(--color-teal), transparent); transform: scaleX(0); transition: var(--transition); }
        .service-card:hover { background: var(--color-surface-2); }
        .service-card:hover::before { transform: scaleX(1); }

        .service-icon { width: 56px; height: 56px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--color-teal-light); margin-bottom: 1.5rem; transition: var(--transition); }
        .service-card:hover .service-icon { background: var(--color-teal); color: white; border-color: var(--color-teal); box-shadow: 0 0 30px var(--color-teal-glow-strong); }
        .service-number { position: absolute; top: 1.5rem; right: 1.75rem; font-family: var(--font-heading); font-size: 3.5rem; font-weight: 900; color: rgba(255,255,255,0.03); line-height: 1; }
        .service-card h3 { font-family: var(--font-heading); font-size: 1.15rem; font-weight: 700; margin-bottom: 0.75rem; }
        .service-card p { font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.7; margin-bottom: 1.5rem; }
        .service-link { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.78rem; font-weight: 600; color: var(--color-teal-light); letter-spacing: 0.05em; text-transform: uppercase; transition: var(--transition); }
        .service-card:hover .service-link i { transform: translateX(4px); }
        .service-link i { transition: var(--transition); }

        /* ===== PROJECTS ===== */
        .projects { padding: 8rem 0; background: var(--color-surface); position: relative; }
        .projects::before { content: ''; position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, var(--color-teal-glow) 0%, transparent 70%); pointer-events: none; }
        .projects-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 4rem; }
        .projects-header h2 { font-family: var(--font-heading); font-size: clamp(2.25rem, 4vw, 3rem); font-weight: 800; letter-spacing: -0.02em; line-height: 1.15; }
        .projects-header h2 span { background: linear-gradient(135deg, var(--color-teal-light), var(--color-teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        
        .projects-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
        
        .project-card { position: relative; border-radius: 12px; overflow: hidden; background: var(--color-black); border: 1px solid var(--color-border); transition: var(--transition-slow); cursor: pointer; display: flex; flex-direction: column; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.02); }
        .project-card:hover { transform: translateY(-8px); border-color: var(--color-border-teal); box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); }
        
        .project-img-wrap { position: relative; height: 300px; overflow: hidden; }
        .project-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: var(--transition-slow); filter: brightness(0.9); }
        .project-card:hover .project-img-wrap img { transform: scale(1.05); filter: brightness(0.8); }
        
        .project-card-content { padding: 1.75rem; position: relative; display: flex; flex-direction: column; flex-grow: 1; background: var(--color-white); }
        .project-category { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--color-teal-light); letter-spacing: 0.08em; margin-bottom: 0.5rem; }
        .project-title { font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; color: var(--color-text-primary); line-height: 1.3; margin-bottom: 0.75rem; transition: var(--transition); }
        .project-card:hover .project-title { color: var(--color-teal-light); }
        .project-desc { font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        
        .project-footer-meta { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--color-border); padding-top: 1.25rem; }
        .project-meta-item { display: flex; align-items: center; gap: 0.5rem; font-size: 0.78rem; color: var(--color-text-muted); font-weight: 500; }
        .project-meta-item i { color: var(--color-teal-light); font-size: 0.85rem; }
        
        .project-action-arrow { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); color: var(--color-teal-light); font-size: 0.78rem; transition: var(--transition); }
        .project-card:hover .project-action-arrow { background: var(--color-teal); border-color: var(--color-teal); color: white; transform: rotate(-45deg); }

        /* ===== CAPABILITIES ===== */
        .capabilities { padding: 8rem 0; background: var(--color-black); }
        .capabilities-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; }
        .capabilities-content h2 { font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); font-weight: 800; letter-spacing: -0.01em; margin-bottom: 1.5rem; }
        .capabilities-content p { color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 2rem; }

        .capabilities-list { display: flex; flex-direction: column; gap: 0.875rem; }
        .capability-item { display: flex; align-items: center; gap: 1.25rem; padding: 1.1rem 1.5rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: 8px; transition: var(--transition); }
        .capability-item:hover { border-color: var(--color-border-teal); background: var(--color-surface-2); }
        .capability-num { font-size: 0.72rem; font-weight: 700; color: var(--color-teal-light); min-width: 28px; background: var(--color-teal-glow); border-radius: 4px; padding: 0.2rem 0.4rem; text-align: center; }
        .capability-name { font-weight: 600; font-size: 0.9rem; }
        .capability-item i { margin-left: auto; color: var(--color-teal-light); font-size: 0.8rem; }

        .capabilities-visual { position: relative; }
        .cap-image { width: 100%; height: 540px; object-fit: cover; border-radius: 12px; filter: brightness(0.75); }
        .cap-overlay-card { position: absolute; top: 2rem; left: -2.5rem; background: rgba(8,8,8,0.92); border: 1px solid var(--color-border-teal); backdrop-filter: blur(20px); border-radius: 12px; padding: 1.5rem; min-width: 220px; }
        .cap-overlay-title { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-teal-light); margin-bottom: 1rem; font-weight: 600; }
        .cap-stat { margin-bottom: 1rem; }
        .cap-stat-bar-wrap { height: 3px; background: rgba(255,255,255,0.1); border-radius: 2px; margin-top: 0.4rem; }
        .cap-stat-bar { height: 100%; background: linear-gradient(90deg, var(--color-teal-dark), var(--color-teal-light)); border-radius: 2px; }
        .cap-stat-label { display: flex; justify-content: space-between; font-size: 0.78rem; }
        .cap-stat-label span:first-child { color: var(--color-text-secondary); }
        .cap-stat-label span:last-child { color: var(--color-teal-light); font-weight: 600; }

        /* ===== WHY US ===== */
        .why-us { padding: 8rem 0; background: var(--color-surface); position: relative; overflow: hidden; }
        .why-us::before { content: ''; position: absolute; bottom: -100px; left: -200px; width: 500px; height: 500px; background: radial-gradient(circle, var(--color-teal-glow) 0%, transparent 70%); pointer-events: none; }
        .why-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5px; background: var(--color-border); border: 1px solid var(--color-border); border-radius: 12px; overflow: hidden; }
        .why-card { background: var(--color-surface); padding: 2.5rem 2rem; transition: var(--transition); }
        .why-card:hover { background: var(--color-surface-2); }
        .why-icon { width: 52px; height: 52px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--color-teal-light); margin-bottom: 1.5rem; }
        .why-card h3 { font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; margin-bottom: 0.75rem; }
        .why-card p { font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.7; }

        /* ===== CTA ===== */
        .cta { padding: 8rem 0; background: var(--color-black); position: relative; overflow: hidden; text-align: center; }
        .cta::before { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; height: 800px; background: radial-gradient(circle, rgba(58,124,121,0.1) 0%, transparent 70%); pointer-events: none; }
        .cta-content { position: relative; z-index: 1; }
        .cta h2 { font-family: var(--font-heading); font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; letter-spacing: -0.02em; line-height: 1.1; margin-bottom: 1.5rem; }
        .cta h2 .line-teal { background: linear-gradient(135deg, var(--color-teal-light), var(--color-teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .cta p { color: var(--color-text-secondary); font-size: 1.1rem; max-width: 480px; margin: 0 auto 2.5rem; line-height: 1.7; }
        .cta-actions { display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; }

        @media (max-width: 1024px) {
            .about-grid, .capabilities-grid { grid-template-columns: 1fr; gap: 3rem; }
            .about-image-badge { bottom: -1rem; right: -1rem; }
            .services-grid { grid-template-columns: 1fr 1fr; }
            .why-grid { grid-template-columns: 1fr 1fr; }
            .cap-overlay-card { left: 0; }
            .projects-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .projects-grid { grid-template-columns: 1fr; gap: 2rem; }
        }
        @media (max-width: 768px) {
            .hero-stats { gap: 1.5rem; }
            .services-grid { grid-template-columns: 1fr; }
            .project-card:nth-child(n) { grid-column: span 12; }
            .project-card img, .project-card:nth-child(1) img, .project-card:nth-child(2) img { height: 260px; }
            .why-grid { grid-template-columns: 1fr; }
            .projects-header { flex-direction: column; gap: 1.5rem; align-items: flex-start; }
            .about-features { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <!-- HERO -->
    <section class="hero" id="hero">
        <div class="hero-bg">
            <img src="{{ asset('assets/hero_bg.png') }}" alt="BECS Modern Office Building and Reflecting Pool">
            <div class="hero-overlay"></div>
            <div class="hero-grid"></div>
        </div>

        <div class="container hero-content">
            <h1 class="hero-title" id="hero-title">
                Engineering<br>with <span class="highlight">Precision.</span>
            </h1>

            <p class="hero-subtitle" id="hero-subtitle">
                Providing world-class structural engineering, BIM-driven project execution, GIS spatial analysis, and premium construction finishing across Lebanon and the region.
            </p>

            <div class="hero-actions" id="hero-actions">
                <a href="{{ url('/projects') }}" class="btn-primary" id="hero-cta-explore">
                    Explore Our Work <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                </a>
                <a href="{{ url('/services') }}" class="btn-outline" id="hero-cta-services">Our Services</a>
            </div>

            <!-- <div class="hero-stats" id="hero-stats">
                <div class="hero-stat" id="stat-1">
                    <div class="hero-stat-value">15<span>+</span></div>
                    <div class="hero-stat-label">Years of Experience</div>
                </div>
                <div class="hero-stat" id="stat-2">
                    <div class="hero-stat-value">200<span>+</span></div>
                    <div class="hero-stat-label">Projects Completed</div>
                </div>
                <div class="hero-stat" id="stat-3">
                    <div class="hero-stat-value">50<span>+</span></div>
                    <div class="hero-stat-label">Expert Engineers</div>
                </div>
                <div class="hero-stat" id="stat-4">
                    <div class="hero-stat-value">12<span>+</span></div>
                    <div class="hero-stat-label">Countries Served</div>
                </div>
            </div> -->
        </div>

        <div class="scroll-indicator" aria-hidden="true">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- MARQUEE BAND -->
    <div class="marquee-band" aria-hidden="true">
        <div class="marquee-track">
            <div class="marquee-item"><i class="fas fa-cubes"></i> BIM-Driven Construction <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-map-marked-alt"></i> GIS Spatial Analysis <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-paint-roller"></i> Construction Finishes <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-drafting-compass"></i> Structural Engineering <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-hard-hat"></i> Project Management <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-ruler-combined"></i> Site Planning <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-cubes"></i> BIM-Driven Construction <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-map-marked-alt"></i> GIS Spatial Analysis <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-paint-roller"></i> Construction Finishes <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-drafting-compass"></i> Structural Engineering <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-hard-hat"></i> Project Management <span class="marquee-dot"></span></div>
            <div class="marquee-item"><i class="fas fa-ruler-combined"></i> Site Planning <span class="marquee-dot"></span></div>
        </div>
    </div>

    <!-- ABOUT PREVIEW -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-image-wrap reveal" id="about-img-wrap">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80" alt="BECS engineering team at work" class="about-image-main" id="about-main-img">
                    <div class="about-image-badge" id="about-badge">
                        <span class="about-image-badge-num">15+</span>
                        <span class="about-image-badge-txt">Years<br>of Excellence</span>
                    </div>
                </div>

                <div class="about-content" id="about-content">
                    <div class="section-tag reveal" id="about-tag">About BECS</div>
                    <h2 class="reveal reveal-delay-1" id="about-heading">Built on Precision,<br>Driven by Innovation</h2>
                    <p class="reveal reveal-delay-2" id="about-p1">
                        BECS — Bureau of Engineering & Contracting Services — is a leading Lebanese engineering and construction firm with over 15 years of proven excellence. We combine deep technical expertise with cutting-edge technology to deliver outstanding results.
                    </p>
                    <p class="reveal reveal-delay-2" id="about-p2">
                        From BIM-driven project delivery to GIS-based spatial intelligence and high-quality finishing works, we bring holistic engineering solutions to every project we undertake.
                    </p>

                    <div class="about-features reveal reveal-delay-3" id="about-features">
                        <div class="about-feature" id="af-1">
                            <div class="about-feature-icon"><i class="fas fa-check"></i></div>
                            <span class="about-feature-text">ISO-certified processes</span>
                        </div>
                        <div class="about-feature" id="af-2">
                            <div class="about-feature-icon"><i class="fas fa-check"></i></div>
                            <span class="about-feature-text">BIM Level 2 & 3 ready</span>
                        </div>
                        <div class="about-feature" id="af-3">
                            <div class="about-feature-icon"><i class="fas fa-check"></i></div>
                            <span class="about-feature-text">200+ completed projects</span>
                        </div>
                        <div class="about-feature" id="af-4">
                            <div class="about-feature-icon"><i class="fas fa-check"></i></div>
                            <span class="about-feature-text">Pan-regional experience</span>
                        </div>
                    </div>

                    <a href="{{ url('/about') }}" class="btn-primary reveal reveal-delay-4" id="about-cta">
                        Learn More About Us <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES PREVIEW -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header">
                <div class="section-tag reveal" id="services-tag">What We Do</div>
                <h2 class="reveal reveal-delay-1" id="services-heading">Our Core Services</h2>
                <p class="reveal reveal-delay-2" id="services-desc">Comprehensive engineering and contracting services, from initial concept to final delivery.</p>
            </div>

            <div class="services-grid reveal reveal-delay-1" id="services-grid">
                @foreach($services as $i => $service)
                <div class="service-card" id="svc-{{ $service->id }}-{{ $service->slug }}">
                    <span class="service-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="service-icon"><i class="{{ $service->icon ?? 'fas fa-cog' }}"></i></div>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->short_description }}</p>
                    <a href="{{ url('/services#' . $service->slug) }}" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
                @endforeach
            </div>
            
            <div style="text-align:center; margin-top: 4rem;" class="reveal" id="view-services-wrap">
                <a href="{{ url('/services') }}" class="btn-primary" id="view-all-services-btn">
                    View All Services <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- PROJECTS PREVIEW -->
    <section class="projects" id="projects">
        <div class="container">
            <div class="projects-header reveal" id="projects-header">
                <div>
                    <div class="section-tag">Our Work</div>
                    <h2>Featured <span>Projects</span></h2>
                </div>
            </div>

            <div class="projects-grid reveal reveal-delay-1" id="projects-grid">
                @foreach($featuredProjects as $project)
                <div class="project-card" id="proj-{{ $project->id }}" onclick="window.location.href='{{ url('/projects/' . $project->slug) }}'">
                    <div class="project-img-wrap">
                        <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}">
                    </div>
                    <div class="project-card-content">
                        <div class="project-category">{{ $project->category?->name ?? 'Engineering' }}</div>
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-desc">{{ $project->short_description }}</p>
                        <div class="project-footer-meta">
                            <div class="project-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $project->location ?? 'N/A' }}</span>
                            </div>
                            <div class="project-action-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="text-align:center; margin-top: 4rem;" class="reveal" id="view-all-wrap">
                <a href="{{ url('/projects') }}" class="btn-outline" id="view-all-btn">
                    View All Projects <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CAPABILITIES -->
    <section class="capabilities" id="capabilities">
        <div class="container">
            <div class="capabilities-grid">
                <div class="capabilities-content" id="cap-content">
                    <div class="section-tag reveal" id="cap-tag">Technical Expertise</div>
                    <h2 class="reveal reveal-delay-1" id="cap-heading">Technical Capabilities<br>Built for Modern Engineering</h2>
                    <p class="reveal reveal-delay-2" id="cap-desc">
                        Our team commands a broad set of technical disciplines, ensuring we can tackle any challenge from preliminary design to final delivery with confidence and precision.
                    </p>

                    <div class="capabilities-list reveal reveal-delay-3" id="cap-list">
                        <div class="capability-item" id="cap-item-1">
                            <span class="capability-num">01</span>
                            <span class="capability-name">Revit & AutoCAD BIM Modeling</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                        <div class="capability-item" id="cap-item-2">
                            <span class="capability-num">02</span>
                            <span class="capability-name">ArcGIS & QGIS Spatial Analysis</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                        <div class="capability-item" id="cap-item-3">
                            <span class="capability-num">03</span>
                            <span class="capability-name">Structural Analysis (SAP2000 / ETABS)</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>

                <div class="capabilities-visual reveal reveal-delay-2" id="cap-visual">
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=800&auto=format&fit=crop&q=80" alt="Engineering team collaborating on BIM model" class="cap-image" id="cap-img">
                    <div class="cap-overlay-card" id="cap-overlay-card">
                        <div class="cap-overlay-title">Project Excellence Rate</div>
                        <div class="cap-stat" id="cap-stat-1">
                            <div class="cap-stat-label"><span>On-Time Delivery</span><span>97%</span></div>
                            <div class="cap-stat-bar-wrap"><div class="cap-stat-bar" style="width:97%"></div></div>
                        </div>
                        <div class="cap-stat" id="cap-stat-2">
                            <div class="cap-stat-label"><span>Client Satisfaction</span><span>99%</span></div>
                            <div class="cap-stat-bar-wrap"><div class="cap-stat-bar" style="width:99%"></div></div>
                        </div>
                        <div class="cap-stat" id="cap-stat-3">
                            <div class="cap-stat-label"><span>Budget Adherence</span><span>94%</span></div>
                            <div class="cap-stat-bar-wrap"><div class="cap-stat-bar" style="width:94%"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section class="why-us" id="why-us">
        <div class="container">
            <div class="section-header" style="margin-bottom:3rem;">
                <div class="section-tag reveal" id="why-tag">Why BECS</div>
                <h2 class="reveal reveal-delay-1" id="why-heading">Why Choose Us</h2>
                <p class="reveal reveal-delay-2" id="why-desc">We bring together the best people, processes, and technology to deliver engineering excellence.</p>
            </div>

            <div class="why-grid reveal reveal-delay-2" id="why-grid">
                <div class="why-card" id="why-1-excellence">
                    <div class="why-icon"><i class="fas fa-medal"></i></div>
                    <h3>Proven Excellence</h3>
                    <p>Over 15 years and 200+ successfully delivered projects across Lebanon and the MENA region. Our track record speaks for itself.</p>
                </div>
                <div class="why-card" id="why-2-tech">
                    <div class="why-icon"><i class="fas fa-microchip"></i></div>
                    <h3>Technology-Forward</h3>
                    <p>We adopt the latest engineering tools — BIM, GIS, AI-assisted design — keeping your project at the cutting edge of the industry.</p>
                </div>
                <div class="why-card" id="why-3-team">
                    <div class="why-icon"><i class="fas fa-users-cog"></i></div>
                    <h3>Expert Team</h3>
                    <p>50+ licensed engineers, architects, and specialists dedicated to delivering results with uncompromising quality and precision.</p>
                </div>
                <div class="why-card" id="why-4-client">
                    <div class="why-icon"><i class="fas fa-handshake"></i></div>
                    <h3>Client-Centric</h3>
                    <p>We build lasting partnerships, not just projects. Our 99% client satisfaction rate reflects our commitment to your vision.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta" id="contact-cta">
        <div class="container">
            <div class="cta-content" id="cta-content">
                <div class="section-tag reveal" style="justify-content:center;" id="cta-tag">Get Started</div>
                <h2 class="reveal reveal-delay-1" id="cta-heading">Ready to Build<br><span class="line-teal">Something Great?</span></h2>
                <p class="reveal reveal-delay-2" id="cta-desc">Let's discuss your project. Our team of expert engineers is ready to turn your vision into a landmark reality.</p>
                <div class="cta-actions reveal reveal-delay-3" id="cta-actions">
                    <a href="mailto:{{ $globalSettings['contact_email'] ?? 'info@becs.com.lb' }}" class="btn-primary" id="cta-email-btn">
                        <i class="fas fa-envelope" style="font-size:0.85rem;"></i> Email Us
                    </a>
                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $globalSettings['contact_phone'] ?? '+22577585958') }}" class="btn-outline" id="cta-phone-btn">
                        <i class="fas fa-phone" style="font-size:0.85rem;"></i> Call Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Animated counter for hero stats
        function animateCounter(el, target, duration = 1500) {
            let start = 0;
            const step = Math.ceil(target / (duration / 16));
            const timer = setInterval(() => {
                start += step;
                if (start >= target) {
                    start = target;
                    clearInterval(timer);
                }
                el.querySelector('.hero-stat-value').innerHTML = start + '<span>+</span>';
            }, 16);
        }

        const heroObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const stats = [
                        { el: document.getElementById('stat-1'), val: 15 },
                        { el: document.getElementById('stat-2'), val: 200 },
                        { el: document.getElementById('stat-3'), val: 50 },
                        { el: document.getElementById('stat-4'), val: 12 }
                    ];
                    stats.forEach(({ el, val }) => animateCounter(el, val));
                    heroObserver.disconnect();
                }
            });
        }, { threshold: 0.5 });

        const heroStats = document.getElementById('hero-stats');
        if (heroStats) heroObserver.observe(heroStats);
    </script>
@endsection
