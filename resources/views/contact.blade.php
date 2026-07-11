@extends('layouts.app')

@section('title', 'Contact Us — BECS')

@section('styles')
    <style>
        /* ===== CONTACT PAGE SPECIFIC STYLES ===== */

        .contact-section { padding: 6rem 0 8rem; background: var(--color-black); }
        .contact-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 5rem; }

        /* Contact Details */
        .contact-info-wrap { display: flex; flex-direction: column; gap: 2.5rem; }
        .contact-info-header h2 { font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; letter-spacing: -0.01em; margin-bottom: 1rem; }
        .contact-info-header p { color: var(--color-text-secondary); line-height: 1.7; }
        
        .contact-cards { display: grid; grid-template-columns: 1fr; gap: 1.25rem; }
        .contact-card-item { display: flex; gap: 1.25rem; padding: 1.75rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: 8px; transition: var(--transition); }
        .contact-card-item:hover { border-color: var(--color-border-teal); background: var(--color-surface-2); }
        .contact-card-icon { width: 44px; height: 44px; min-width: 44px; background: var(--color-teal-glow); border: 1px solid var(--color-border-teal); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--color-teal-light); font-size: 1.1rem; }
        .contact-card-text h4 { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); letter-spacing: 0.05em; margin-bottom: 0.25rem; }
        .contact-card-text p { font-size: 1rem; font-weight: 600; color: var(--color-text-primary); line-height: 1.4; }
        .contact-card-text a:hover { color: var(--color-teal-light); text-decoration: underline; }

        /* Contact Form */
        .contact-form-wrap { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: 12px; padding: 3rem; position: relative; }
        .contact-form-wrap::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent, var(--color-teal), transparent); }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .form-group { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; }
        .form-group.full-width { margin-bottom: 2rem; }
        
        .form-group label { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; color: var(--color-text-muted); letter-spacing: 0.08em; }
        
        .form-control { width: 100%; background: var(--color-surface-2); border: 1px solid var(--color-border); border-radius: 4px; padding: 0.85rem 1rem; color: var(--color-text-primary); font-family: var(--font-body); font-size: 0.9rem; transition: var(--transition); }
        .form-control:focus { outline: none; border-color: var(--color-teal); background: rgba(58, 124, 121, 0.04); box-shadow: 0 0 15px rgba(58,124,121,0.1); }
        
        select.form-control { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.4)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1rem; padding-right: 2.5rem; }
        select.form-control option { background: var(--color-surface-3); color: var(--color-text-primary); }

        textarea.form-control { resize: vertical; min-height: 120px; }

        /* Map styling */
        .map-section { background: var(--color-black); padding-bottom: 8rem; }
        .map-container { width: 100%; height: 450px; border-radius: 8px; overflow: hidden; border: 1px solid var(--color-border); filter: grayscale(100%) invert(90%) contrast(95%); }

        @media (max-width: 1024px) {
            .contact-grid { grid-template-columns: 1fr; gap: 4rem; }
        }
        @media (max-width: 768px) {
            .contact-form-wrap { padding: 2rem; }
            .form-row { grid-template-columns: 1fr; gap: 1.5rem; }
        }
    </style>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <header class="page-header">
        <div class="container page-header-content">
            <div class="section-tag">Contact Us</div>
            <h1>Let's Start a<br><span>Conversation.</span></h1>
            <p>Ready to collaborate or need expert technical appraisal? Get in touch with our Abidjan partners and engineering departments.</p>
        </div>
    </header>

    <!-- CONTACT DETAILS & FORM -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact info cards -->
                <div class="contact-info-wrap reveal">
                    <div class="contact-info-header">
                        <h2>We're Here to Help</h2>
                        <p>Whether you require coordinated BIM modeling, GIS mapping databases, finishing contracting, or site surveys, we look forward to answering your inquiries.</p>
                    </div>

                    <div class="contact-cards">
                        <div class="contact-card-item" id="citem-phone">
                            <div class="contact-card-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-card-text">
                                <h4>Phone Inquiries</h4>
                                <p><a href="tel:{{ preg_replace('/[^+0-9]/', '', $globalSettings['contact_phone'] ?? '+22577585958') }}">{{ $globalSettings['contact_phone'] ?? '+225 77 58 59 58' }}</a></p>
                            </div>
                        </div>

                        <div class="contact-card-item" id="citem-email">
                            <div class="contact-card-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-card-text">
                                <h4>Email Correspondence</h4>
                                <p><a href="mailto:{{ $globalSettings['contact_email'] ?? 'info@becs.com.lb' }}">{{ $globalSettings['contact_email'] ?? 'info@becs.com.lb' }}</a></p>
                            </div>
                        </div>

                        <div class="contact-card-item" id="citem-address">
                            <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-card-text">
                                <h4>Main Office Address</h4>
                                <p>{{ $globalSettings['contact_address'] ?? 'Abidjan, Côte d\'Ivoire' }}</p>
                            </div>
                        </div>

                        <div class="contact-card-item" id="citem-hours">
                            <div class="contact-card-icon"><i class="fas fa-clock"></i></div>
                            <div class="contact-card-text">
                                <h4>Active Office Hours</h4>
                                <p>{{ $globalSettings['contact_hours'] ?? 'Monday — Friday: 8:00 AM — 5:00 PM' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="contact-form-wrap reveal reveal-delay-2">
                    <form action="{{ route('contact.store') }}" method="POST" id="inquiry-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="+225 77 58 59 58">
                            </div>
                            <div class="form-group">
                                <label for="service">Required Service</label>
                                <select id="service" name="service" class="form-control">
                                    <option value="general">General Inquiry</option>
                                    <option value="bim">BIM Construction Modeling</option>
                                    <option value="gis">GIS Spatial Analysis</option>
                                    <option value="finishes">Construction Finishes</option>
                                    <option value="structural">Structural Engineering</option>
                                    <option value="pm">Project Management</option>
                                    <option value="survey">Land Surveying & Site Planning</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Outline your project requirements, scope, or general questions..." required></textarea>
                        </div>

                        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;" id="form-submit-btn">
                            Send Message & Request <i class="fas fa-paper-plane" style="font-size: 0.8rem;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- MAP SECTION -->
    <section class="map-section">
        <div class="container reveal">
            <div class="section-header" style="text-align: left; margin-bottom: 2.5rem;">
                <div class="section-tag">Location</div>
                <h2>Visit Our Office</h2>
            </div>
            <!-- Styled dark google maps iframe placeholder -->
            <div class="map-container" id="office-map-wrap">
                <iframe 
                    src="{{ $globalSettings['map_embed_url'] }}" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="BECS Office Google Maps"
                ></iframe>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Handle actual contact form submission with Fetch API
        const form = document.getElementById('inquiry-form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = document.getElementById('form-submit-btn');
            
            // Disable button during submit
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending Message... <i class="fas fa-circle-notch fa-spin" style="font-size: 0.8rem;"></i>';

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    submitBtn.style.background = '#2c5f5d';
                    submitBtn.innerHTML = 'Message Sent Successfully! <i class="fas fa-check" style="font-size: 0.8rem;"></i>';
                    form.reset();
                } else {
                    const errors = data.errors ? data.errors.join('\n') : 'An error occurred. Please try again.';
                    alert('Validation Error:\n' + errors);
                    submitBtn.disabled = false;
                    submitBtn.style.background = 'var(--color-teal)';
                    submitBtn.innerHTML = 'Send Message & Request <i class="fas fa-paper-plane" style="font-size: 0.8rem;"></i>';
                }
            })
            .catch(error => {
                alert('Connection Error. Please check your internet connection and try again.');
                submitBtn.disabled = false;
                submitBtn.style.background = 'var(--color-teal)';
                submitBtn.innerHTML = 'Send Message & Request <i class="fas fa-paper-plane" style="font-size: 0.8rem;"></i>';
            });
        });
    </script>
@endsection
