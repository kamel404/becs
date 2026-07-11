@extends('layouts.app')

@section('title', 'Our Services — BECS')

@section('styles')
    <style>
        /* ===== SERVICES PAGE SPECIFIC STYLES ===== */

        .services-detail-section { padding: 8rem 0; background: var(--color-black); }
        .services-detail-section:nth-child(even) { background: var(--color-surface); }
        
        .service-detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; }
        .services-detail-section:nth-child(even) .service-detail-image-wrap { order: -1; }

        .service-detail-content h2 { font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.75rem); font-weight: 800; line-height: 1.15; letter-spacing: -0.01em; margin-bottom: 1.5rem; }
        .service-detail-content h2 span { color: var(--color-teal-light); }
        .service-detail-content p { color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 2rem; }

        .service-detail-image-wrap { position: relative; }
        .service-detail-image { width: 100%; height: 460px; object-fit: cover; border-radius: 8px; filter: brightness(0.8); }
        .service-detail-image-wrap::before { content: ''; position: absolute; inset: 0; border: 1px solid var(--color-border-teal); border-radius: 8px; transform: translate(12px, 12px); z-index: -1; transition: var(--transition); }
        .service-detail-image-wrap:hover::before { transform: translate(6px, 6px); }

        .service-description-content { color: var(--color-text-secondary); line-height: 1.8; }
        .service-description-content p { margin-bottom: 1rem; }
        .service-description-content ul { list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .service-description-content li { margin-bottom: 0.5rem; }

        @media (max-width: 1024px) {
            .service-detail-grid { grid-template-columns: 1fr; gap: 3rem; }
            .services-detail-section:nth-child(even) .service-detail-image-wrap { order: initial; }
            .service-detail-image { height: 360px; }
        }
    </style>
@endsection

@section('content')

    @foreach($services as $i => $service)
    <section class="services-detail-section" id="{{ $service->slug }}">
        <div class="container">
            <div class="service-detail-grid">
                <div class="service-detail-content">
                    <div class="section-tag reveal">Service {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    @php
                        $titleWords = explode(' ', $service->title);
                        $lastWord   = array_pop($titleWords);
                        $restWords  = implode(' ', $titleWords);
                    @endphp
                    <h2 class="reveal reveal-delay-1">{{ $restWords }} <span>{{ $lastWord }}</span></h2>

                    <div class="reveal reveal-delay-2 service-description-content">
                        {!! $service->description ?? '<p>' . e($service->short_description) . '</p>' !!}
                    </div>
                </div>

                <div class="service-detail-image-wrap reveal reveal-delay-2" id="{{ $service->slug }}-img-wrap">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="service-detail-image">
                    @else
                        {{-- Fallback placeholder image per service --}}
                        @php
                            $fallbacks = [
                                'bim-driven-construction'        => 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?w=800&auto=format&fit=crop&q=80',
                                'geographic-information-systems' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?w=800&auto=format&fit=crop&q=80',
                                'construction-finishes'          => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800&auto=format&fit=crop&q=80',
                                'structural-engineering'         => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=800&auto=format&fit=crop&q=80',
                                'project-management'             => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&auto=format&fit=crop&q=80',
                                'survey-site-planning'           => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',
                            ];
                            $imgUrl = $fallbacks[$service->slug] ?? 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&auto=format&fit=crop&q=80';
                        @endphp
                        <img src="{{ $imgUrl }}" alt="{{ $service->title }}" class="service-detail-image">
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endforeach

    <!-- COMMON CTA -->
    <section class="section-cta-block" id="services-cta-block">
        <div class="container section-cta-content">
            <div class="section-tag" style="justify-content:center;">Consultation</div>
            <h2>Looking for Custom<br><span>Engineering Solutions?</span></h2>
            <p>Get in touch with our team of specialists to outline how our services can streamline your development.</p>
            <a href="{{ url('/contact') }}" class="btn-primary">Schedule a Meeting</a>
        </div>
    </section>
@endsection
