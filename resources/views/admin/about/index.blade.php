@extends('admin.layouts.base')

@section('page-title', 'About Us Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>About Us</span>
@endsection

@section('content')
    <section class="about-hero">
        <div class="hero-content">
            <h1>{{ $about->title ?? '' }}</h1>
            <h1><span>{{ $about->subtitle ?? '' }}</span></h1>
            <p id="dynamic-date">
                {{ $about->description ?? '' }}
            </p>
            <div class="actions">
                <button class="edit-hero-btn"
                    onclick="openEditHeroOverlay('{{ $about->title ?? '' }}', '{{ $about->subtitle ?? '' }}', '{{ $about->description ?? 'Discover the heart of Bagan Chiya Cafe, where tradition meets taste in every cup and bite.' }}')">
                    <i class="fas fa-edit"></i> Edit Hero
                </button>
            </div>
        </div>
    </section>

    <!-- Overlay for Edit Hero Section -->
    <div class="overlay" id="editHeroOverlay">
        <div class="overlay-content">
            <button class="close-btn" onclick="closeEditHeroOverlay()"><i class="fas fa-times"></i></button>
            <div class="form-section">
                <h2>Edit Hero Section</h2>
                <form id="editHeroForm" method="POST" action="{{ route('admin.visitus.hero.update') }}">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input id="editHeroTitle" name="hero_title" type="text" value="{{ $about->title ?? '' }}"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input id="editHeroSubtitle" name="hero_subtitle" type="text"
                            value="{{ $about->subtitle ?? '' }}" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="editHeroDescription" name="hero_description" required>{{ $about->description ?? '' }}</textarea>
                    </div>
                    <button type="submit"><i class="fas fa-save"></i> Save Hero</button>
                </form>
            </div>
        </div>
    </div>

    <section class="about-section">
        <h2>{{ $about->about_title ?? '' }}</h2>
        <div class="about-content">
            <p>{{ $about->paragraph1 ?? '' }}
            </p>
            <p>{{ $about->paragraph2 ?? '' }}
            </p>
            <div class="actions">
                <button class="edit-about-btn"
                    onclick="openEditAboutOverlay('{{ $about->about_title ?? '' }}', '{{ $about->paragraph1 ?? '' }}')">
                    <i class="fas fa-edit"></i> Edit About
                </button>
            </div>
        </div>
    </section>

    <!-- Overlay for Edit About Section -->
    <div class="overlay" id="editAboutOverlay">
        <div class="overlay-content">
            <button class="close-btn" onclick="closeEditAboutOverlay()"><i class="fas fa-times"></i></button>
            <div class="form-section">
                <h2>Edit About Section</h2>
                <form id="editAboutForm" method="POST" action="{{ route('admin.visitus.about.update') }}">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input id="editAboutTitle" name="about_title" type="text"
                            value="{{ $about->about_title ?? '' }}" required />
                    </div>
                    <div class="form-group">
                        <label>Paragraph 1</label>
                        <textarea id="editAboutParagraph1" name="paragraph1" required>{{ $about->paragraph1 ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Paragraph 2</label>
                        <textarea id="editAboutParagraph2" name="paragraph2" required>{{ $about->paragraph2 ?? '' }}</textarea>
                    </div>
                    <button type="submit"><i class="fas fa-save"></i> Save About</button>
                </form>
            </div>
        </div>
    </div>

    <div class="visit-hours-section">
        <div class="map-title">
            <h2>{{ $about->map_title ?? 'Find Us' }}</h2>
            <div class="actions">
                <button class="edit-visit-btn"
                    onclick="openEditVisitOverlay('{{ $about->map_title ?? '' }}', '{{ $about->visit_title ?? '' }}', '{{ $about->location ?? '' }}', '{{ $about->phone ?? '' }}', '{{ $about->secondary_location ?? '' }}', '{{ $about->hours ?? '' }}', '{{ $about->map_url ?? '' }}', '{{ $about->directions_url ?? '' }}')">
                    <i class="fas fa-edit"></i> Edit Visit Info
                </button>
            </div>
        </div>

        <div class="info-section">
            <div class="header">
                <h1 class="title">{{ $about->visit_title ?? '' }}</h1>
                <div class="location">
                    <i class="fas fa-map-marker-alt location-icon"></i>
                    {{ $about->location ?? '' }}
                </div>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-phone contact-icon"></i>
                        <a href="tel:+{{ $about->phone ?? '' }}"
                            style="color: #d1e8d4; text-decoration: none;">{{ $about->phone ?? '' }}</a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-location contact-icon"></i>
                        {{ $about->secondary_location ?? '' }}
                    </div>
                </div>
                <a href="{{ $about->directions_url ?? '' }}" target="_blank" class="directions-btn">
                    Get Directions
                </a>
            </div>
            <div class="hours-list">
                <p>{{ $about->hours ?? '' }}</p>
            </div>
        </div>
    </div>

    <!-- Overlay for Edit Visit Section -->
    <div class="overlay" id="editVisitOverlay">
        <div class="overlay-content">
            <button class="close-btn" onclick="closeEditVisitOverlay()"><i class="fas fa-times"></i></button>
            <div class="form-section">
                <h2>Edit Visit Info</h2>
                <form id="editVisitForm" method="POST" action="{{ route('admin.visitus.visit.update') }}">
                    @csrf
                    <div class="form-group">
                        <label>Map Title</label>
                        <input id="editVisitMapTitle" name="map_title" type="text" value="{{ $about->map_title ?? '' }}"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Visit & Hours Title</label>
                        <input id="editVisitTitle" name="visit_title" type="text"
                            value="{{ $about->visit_title ?? '' }}" required />
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input id="editVisitLocation" name="location" type="text"
                            value="{{ $about->location ?? '' }}" required />
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input id="editVisitPhone" name="phone" type="text" value="{{ $about->phone ?? '' }}"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Secondary Location</label>
                        <input id="editVisitSecondaryLocation" name="secondary_location" type="text"
                            value="{{ $about->secondary_location ?? '' }}" required />
                    </div>
                    <div class="form-group">
                        <label>Hours</label>
                        <textarea id="editVisitHours" name="hours" required>{{ $about->hours ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Google Maps Embed URL (Optional)</label>
                        <input id="editVisitMapUrl" name="map_url" type="text" value="{{ $about->map_url ?? '' }}"
                            placeholder="Enter Google Maps embed URL" />
                    </div>
                    <div class="form-group">
                        <label>Get Directions URL</label>
                        <input id="editVisitDirectionsUrl" name="directions_url" type="text"
                            value="{{ $about->directions_url ?? '' }}" required />
                    </div>
                    <button type="submit"><i class="fas fa-save"></i> Save Visit Info</button>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <style>
            .about-hero,
            .about-section,
            .visit-hours-section {
                padding: 16px;
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 16px;

            }

            .hero-content,
            .about-content,
            .map-title,
            .info-section {
                text-align: center;
            }

            .hero-content h1,
            .about-section h2,
            .map-title h2,
            .info-section .title {
                font-size: 1.5em;
                color: #1a3c34;
            }

            .hero-content h1 span {
                color: #2a8b4e;
            }

            .hero-content p,
            .about-content p,
            .info-section p,
            .map-title p,
            .contact-info,
            .location {
                font-size: 0.9em;
                color: #4a5568;
                margin: 8px 0;
            }

            .hero-content .actions,
            .about-content .actions,
            .map-title .actions {
                display: flex;
                justify-content: center;
                margin-top: 8px;
            }

            .edit-hero-btn,
            .edit-about-btn,
            .edit-visit-btn {
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.85em;
                padding: 6px 12px;
                border: none;
                border-radius: 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            }

            .edit-hero-btn:hover,
            .edit-about-btn:hover,
            .edit-visit-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .edit-hero-btn:active,
            .edit-about-btn:active,
            .edit-visit-btn:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .map-section {
                margin: 16px 0;
            }

            .map-container {
                position: relative;
                width: 100%;
                height: 300px;
            }

            .map-container iframe {
                width: 100%;
                height: 100%;
                border: 0;
            }

            .map-overlay {
                position: absolute;
                bottom: 10px;
                right: 10px;
                background: rgba(0, 0, 0, 0.5);
                color: #ffffff;
                font-size: 0.8em;
                padding: 4px 8px;
                border-radius: 4px;
            }

            .info-section .header {
                margin-bottom: 16px;
            }

            .contact-info .contact-item {
                display: flex;
                align-items: center;
                gap: 8px;
                margin: 8px 0;
            }

            .location-icon,
            .contact-icon {
                color: #2a8b4e;
            }

            .directions-btn {
                display: inline-block;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.85em;
                padding: 8px 16px;
                border-radius: 16px;
                text-decoration: none;
                margin: 8px 0;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            }

            .directions-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .directions-btn:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1000;
                justify-content: center;
                align-items: center;
                animation: fadeIn 0.2s ease;
            }

            .overlay.active {
                display: flex;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .overlay-content {
                background: #ffffff;
                padding: 16px;
                border-radius: 10px;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
                width: 90%;
                max-width: 450px;
                max-height: 80vh;
                overflow-y: auto;
                position: relative;
                animation: slideIn 0.2s ease;
            }

            @keyframes slideIn {
                from {
                    transform: translateY(10px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .overlay-content .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                background: none;
                border: none;
                font-size: 1.2em;
                color: #1a3c34;
                cursor: pointer;
                transition: color 0.2s ease, transform 0.2s ease;
            }

            .overlay-content .close-btn:hover {
                color: #2a8b4e;
                transform: scale(1.1);
            }

            .overlay-content .form-section {
                background: #f9faf9;
                padding: 12px;
                border-radius: 8px;

            }

            .overlay-content .form-section h2 {
                font-size: 1.2em;
                font-weight: 500;
                color: #2a8b4e;
                margin-bottom: 8px;
            }

            .overlay-content .form-group {
                margin-bottom: 8px;
            }

            .overlay-content .form-section label {
                font-size: 0.85em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 5px;
                display: block;
            }

            .overlay-content .form-section input,
            .overlay-content .form-section textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #b8d7bc;
                border-radius: 6px;
                font-size: 0.9em;
                color: #1a3c34;
                background: #ffffff;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .overlay-content .form-section textarea {
                resize: vertical;
                min-height: 80px;
            }

            .overlay-content .form-section input:focus,
            .overlay-content .form-section textarea:focus {
                border-color: #3da65f;
                box-shadow: 0 0 0 2px rgba(61, 166, 95, 0.15);
                outline: none;
            }

            .overlay-content .form-section button {
                width: 100%;
                padding: 8px;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.85em;
                border: none;
                border-radius: 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 5px;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            }

            .overlay-content .form-section button:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .overlay-content .form-section button:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dateElement = document.getElementById('dynamic-date');
                const today = new Date('2025-08-07T12:43:00+05:45');
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const dayName = days[today.getDay()];
                dateElement.textContent = `${dateElement.textContent} Available today, ${dayName}.`;
            });

            function openEditHeroOverlay(title, subtitle, description) {
                closeAllOverlays();
                document.getElementById('editHeroTitle').value = title;
                document.getElementById('editHeroSubtitle').value = subtitle;
                document.getElementById('editHeroDescription').value = description;
                document.getElementById('editHeroOverlay').classList.add('active');
            }

            function closeEditHeroOverlay() {
                document.getElementById('editHeroOverlay').classList.remove('active');
            }

            function openEditAboutOverlay(title, paragraph1, paragraph2) {
                closeAllOverlays();
                document.getElementById('editAboutTitle').value = title;
                document.getElementById('editAboutParagraph1').value = paragraph1;
                document.getElementById('editAboutParagraph2').value = paragraph2;
                document.getElementById('editAboutOverlay').classList.add('active');
            }

            function closeEditAboutOverlay() {
                document.getElementById('editAboutOverlay').classList.remove('active');
            }

            function openEditVisitOverlay(mapTitle, visitTitle, location, phone, secondaryLocation, hours, mapUrl,
                directionsUrl) {
                closeAllOverlays();
                document.getElementById('editVisitMapTitle').value = mapTitle;
                document.getElementById('editVisitTitle').value = visitTitle;
                document.getElementById('editVisitLocation').value = location;
                document.getElementById('editVisitPhone').value = phone;
                document.getElementById('editVisitSecondaryLocation').value = secondaryLocation;
                document.getElementById('editVisitHours').value = hours;
                document.getElementById('editVisitMapUrl').value = mapUrl;
                document.getElementById('editVisitDirectionsUrl').value = directionsUrl;
                document.getElementById('editVisitOverlay').classList.add('active');
            }

            function closeEditVisitOverlay() {
                document.getElementById('editVisitOverlay').classList.remove('active');
            }

            function closeAllOverlays() {
                document.querySelectorAll('.overlay').forEach(overlay => {
                    overlay.classList.remove('active');
                });
            }
        </script>
    @endpush
@endsection
