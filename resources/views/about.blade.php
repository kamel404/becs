@extends('layouts.app')

@section('title', 'About Us — BECS')

@section('styles')
    <style>
        /* ===== ABOUT SPECIFIC STYLES ===== */

        /* Core Values */
        .values { padding: 8rem 0; background: var(--color-black); }
        .values-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5px; background: var(--color-border); border: 1px solid var(--color-border); border-radius: 12px; overflow: hidden; margin-top: 4rem; }
        .value-card { background: var(--color-surface); padding: 3rem 2rem; transition: var(--transition); text-align: center; }
        .value-card:hover { background: var(--color-surface-2); }
        .value-icon { width: 60px; height: 60px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.35rem; color: var(--color-teal-light); margin-bottom: 1.5rem; transition: var(--transition); }
        .value-card:hover .value-icon { background: var(--color-teal); color: white; border-color: var(--color-teal); box-shadow: 0 0 25px var(--color-teal-glow-strong); }
        .value-card h3 { font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem; }
        .value-card p { font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.7; }

        /* Profile Section */
        .profile { padding: 8rem 0; background: var(--color-surface); position: relative; overflow: hidden; }
        .profile::before { content: ''; position: absolute; bottom: -200px; left: -200px; width: 600px; height: 600px; background: radial-gradient(circle, var(--color-teal-glow) 0%, transparent 70%); pointer-events: none; }
        .profile-grid { display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 5rem; align-items: center; }
        .profile-content .section-tag { margin-bottom: 1rem; }
        .profile-content h2 { font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); font-weight: 800; line-height: 1.15; letter-spacing: -0.01em; margin-bottom: 1.5rem; }
        .profile-content h2 span { background: linear-gradient(135deg, var(--color-teal-light), var(--color-teal)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .profile-text { color: var(--color-text-secondary); line-height: 1.8; font-size: 1rem; }
        .profile-text p { margin-bottom: 1.25rem; }
        .profile-text p:last-child { margin-bottom: 0; }
        .profile-text .lead { font-size: 1.125rem; font-weight: 500; color: var(--color-text-primary); line-height: 1.7; border-left: 3px solid var(--color-teal); padding-left: 1.25rem; }
        .profile-image-wrap { position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); border: 1px solid var(--color-border); }
        .profile-image { width: 100%; height: auto; display: block; filter: saturate(0.95); transition: var(--transition-slow); }
        .profile-image-wrap:hover .profile-image { transform: scale(1.03); }
        .profile-stats-overlay { position: absolute; bottom: 1.25rem; left: 1.25rem; right: 1.25rem; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 8px; padding: 1rem; display: flex; justify-content: space-around; gap: 0.5rem; }
        .profile-stat { text-align: center; }
        .profile-stat-num { font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--color-teal); line-height: 1; margin-bottom: 0.25rem; }
        .profile-stat-lbl { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); font-weight: 600; }

        /* Team Section */
        .team { padding: 8rem 0; background: var(--color-black); }
        .team-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-top: 4rem; }
        .team-card { position: relative; border-radius: 8px; overflow: hidden; background: var(--color-surface); border: 1px solid var(--color-border); transition: var(--transition); }
        .team-card:hover { border-color: var(--color-border-teal); transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .team-image-wrap { position: relative; height: 320px; overflow: hidden; }
        .team-image-wrap img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%); transition: var(--transition-slow); }
        .team-card:hover .team-image-wrap img { filter: grayscale(0%); transform: scale(1.05); }
        .team-info { padding: 1.5rem; position: relative; }
        .team-info h3 { font-family: var(--font-heading); font-size: 1.15rem; font-weight: 700; margin-bottom: 0.25rem; }
        .team-info p { font-size: 0.78rem; font-weight: 600; text-transform: uppercase; color: var(--color-teal-light); letter-spacing: 0.05em; margin-bottom: 0.75rem; }
        .team-social { display: flex; gap: 0.75rem; }
        .team-social a { color: var(--color-text-muted); font-size: 0.85rem; transition: var(--transition); }
        .team-social a:hover { color: var(--color-teal-light); }

        @media (max-width: 1024px) {
            .values-grid { grid-template-columns: 1fr 1fr; }
            .team-grid { grid-template-columns: 1fr 1fr; }
            .profile-grid { grid-template-columns: 1fr; gap: 3rem; }
        }
        @media (max-width: 768px) {
            .values-grid { grid-template-columns: 1fr; }
            .team-grid { grid-template-columns: 1fr; }
            .profile-stats-overlay { flex-direction: column; gap: 1rem; align-items: center; position: static; background: var(--color-surface-2); margin-top: 1.5rem; }
            .profile-stat { width: 100%; }
            .profile-stat-border { border-left: none !important; border-right: none !important; border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); padding: 0.75rem 0 !important; }
        }
    </style>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <!-- <header class="page-header">
        <div class="container page-header-content">
            <div class="section-tag">About Our Firm</div>
            <h1>Precision in Planning.<br><span>Excellence in Execution.</span></h1>
            <p>A look into the philosophy, heritage, and engineers driving the region's standard for engineering contracting since 2009.</p>
        </div>
    </header> -->

        <!-- PROFILE SECTION -->
    <section class="profile" id="profile">
        <div class="container">
            <div class="profile-grid">
                <div class="profile-content reveal">
                    <div class="section-tag">Who We Are</div>
                    <h2>Bureau of Engineering &<br><span>Contracting Services</span></h2>
                    <div class="profile-text">
                        <p class="lead">Bureau of Engineering & Contracting Services (BECS) provides comprehensive engineering and construction services, specializing in project design, management, and execution.</p>
                        <p>Our team delivers practical, client-focused solutions with an emphasis on quality, efficiency, and timely delivery.</p>
                        <p>By combining technical expertise with collaborative project oversight, we ensure that each project meets its objectives while adhering to industry standards and client requirements.</p>
                    </div>
                </div>
                <div class="profile-image-wrap reveal reveal-delay-1">
                    <img class="profile-image" src="{{ asset('assets/profile_visual.png') }}" alt="BECS Engineering & Contracting Services">
                    <div class="profile-stats-overlay">
                        <div class="profile-stat">
                            <div class="profile-stat-num">15+</div>
                            <div class="profile-stat-lbl">Years Experience</div>
                        </div>
                        <div class="profile-stat profile-stat-border" style="border-left: 1px solid var(--color-border); border-right: 1px solid var(--color-border); padding: 0 1.5rem;">
                            <div class="profile-stat-num">150+</div>
                            <div class="profile-stat-lbl">Projects Done</div>
                        </div>
                        <div class="profile-stat">
                            <div class="profile-stat-num">100%</div>
                            <div class="profile-stat-lbl">Client Focus</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CORE VALUES -->
    <section class="values" id="values">
        <div class="container">
            <div class="section-header">
                <div class="section-tag reveal">Our Foundation</div>
                <h2 class="reveal reveal-delay-1">Core Values That Direct Us</h2>
                <p class="reveal reveal-delay-2">Every blueprint we design and structure we construct is supported by four key pillars of professional integrity.</p>
            </div>

            <div class="values-grid reveal reveal-delay-2">
                <div class="value-card" id="val-precision">
                    <div class="value-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>Precision</h3>
                    <p>Uncompromising alignment to measurements, budgets, and safety guidelines. We measure twice and construct once.</p>
                </div>
                <div class="value-card" id="val-innovation">
                    <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
                    <h3>Innovation</h3>
                    <p>Harnessing Level 2 and Level 3 BIM, GIS intelligence, and modern materials to improve structural safety and resource efficiency.</p>
                </div>
                <div class="value-card" id="val-integrity">
                    <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Integrity</h3>
                    <p>Honest consulting, transparent cost-breakdowns, and reliable execution timelines that build enduring professional partnerships.</p>
                </div>
                <div class="value-card" id="val-safety">
                    <div class="value-icon"><i class="fas fa-hard-hat"></i></div>
                    <h3>Safety First</h3>
                    <p>Strict observance of international safety protocols, keeping site conditions optimal for our workforce and project environments.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM SECTION -->
    

    <!-- COMMON CTA -->
    <section class="section-cta-block" id="about-cta-block">
        <div class="container section-cta-content">
            <div class="section-tag" style="justify-content:center;">Get in Touch</div>
            <h2>Let's Discuss<br><span>Your Engineering Needs</span></h2>
            <p>Our team of licensed partners and BIM/GIS specialists is ready to review your next project requirements.</p>
            <a href="{{ url('/contact') }}" class="btn-primary">Contact Our Engineers</a>
        </div>
    </section>
@endsection
