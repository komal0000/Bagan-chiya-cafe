@extends('admin.layouts.base')

@section('page-title', 'About Us Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>About Us</span>
@endsection

@section('content')
    <div class="main-content">
        <!-- Hero Section -->
        <div class="about-section-wrapper">
            <div class="section-header">
                <div class="header-content">
                    <i class="fas fa-home"></i>
                    <div>
                        <h2>Hero Section</h2>
                        <p>Main welcome message and introduction</p>
                    </div>
                </div>
                <button class="edit-hero-btn"
                    onclick="openEditHeroOverlay('{{ $about->title ?? '' }}', '{{ $about->subtitle ?? '' }}', '{{ $about->description ?? 'Discover the heart of Bagan Chiya Cafe, where tradition meets taste in every cup and bite.' }}')">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
            <div class="hero-content">
                <h1>{{ $about->title ?? '' }}</h1>
                <h1><span>{{ $about->subtitle ?? '' }}</span></h1>
                <p id="dynamic-date">
                    {{ $about->description ?? '' }}
                </p>
            </div>
        </div>
        <div class="about-section-wrapper">
            <div class="section-header">
                <div class="header-content">
                    <i class="fas fa-map-marked-alt"></i>
                    <div>
                        <h2>Visit & Hours</h2>
                        <p>Location, contact, and opening hours</p>
                    </div>
                </div>
                <button class="edit-visit-btn"
                    onclick="openEditVisitOverlay('{{ $about->map_title ?? '' }}', '{{ $about->visit_title ?? '' }}', '{{ $about->location ?? '' }}', '{{ $about->phone ?? '' }}', '{{ $about->secondary_location ?? '' }}', '{{ $about->hours ?? '' }}', '{{ $about->map_url ?? '' }}', '{{ $about->directions_url ?? '' }}')">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
            <div class="visit-content">
                <div class="map-title">
                    <h2>{{ $about->map_title ?? 'Find Us' }}</h2>
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
                                    style="color: #2a8b4e; text-decoration: none;">{{ $about->phone ?? '' }}</a>
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
        </div>
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
        <div class="about-section-wrapper">
            <div class="section-header">
                <div class="header-content">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <h2>About Content</h2>
                        <p>Our story and mission</p>
                    </div>
                </div>
                <button class="edit-about-btn"
                    onclick="openEditAboutOverlay('{{ $about->about_title ?? '' }}', '{{ $about->paragraph1 ?? '' }}')">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
            <div class="about-content">
                <h2>{{ $about->about_title ?? '' }}</h2>
                <p>{{ $about->paragraph1 ?? '' }}</p>
                <p>{{ $about->paragraph2 ?? '' }}</p>
            </div>
        </div>

    </div>

    <!-- About Content Section -->

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
                        <input id="editVisitMapTitle" name="map_title" type="text"
                            value="{{ $about->map_title ?? '' }}" required />
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
            /* Main Container */
            .main-content {
                background: #f5f7fa;
                min-height: 100vh;
                padding: 20px;
            }

            /* Section Wrappers */
            .about-section-wrapper {
                background: #ffffff;
                border-radius: 12px;
                padding: 24px;
                margin-bottom: 24px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #2a8b4e;
                transition: all 0.3s ease;
            }

            .about-section-wrapper:hover {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            }

            /* Section Headers */
            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 16px;
                border-bottom: 2px solid #e2e8f0;
            }

            .section-header .header-content {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .section-header .header-content i {
                font-size: 1.8em;
                color: #2a8b4e;
                background: rgba(42, 139, 78, 0.1);
                padding: 12px;
                border-radius: 10px;
            }

            .section-header .header-content h2 {
                font-size: 1.4em;
                font-weight: 600;
                color: #1a3c34;
                margin: 0;
            }

            .section-header .header-content p {
                font-size: 0.85em;
                color: #718096;
                margin: 4px 0 0 0;
            }

            /* Hero Section */
            .hero-content {
                text-align: center;
                padding: 20px 0;
            }

            .hero-content h1 {
                font-size: 1.8em;
                color: #1a3c34;
                margin-bottom: 12px;
                font-weight: 600;
            }

            .hero-content h1 span {
                color: #2a8b4e;
            }

            .hero-content p {
                font-size: 1em;
                color: #4a5568;
                line-height: 1.6;
                margin: 12px 0;
            }

            /* About Content */
            .about-content {
                padding: 16px 0;
            }

            .about-content h2 {
                font-size: 1.5em;
                color: #1a3c34;
                margin-bottom: 16px;
                font-weight: 600;
                text-align: center;
            }

            .about-content p {
                font-size: 0.95em;
                color: #4a5568;
                line-height: 1.7;
                margin-bottom: 12px;
                text-align: justify;
            }

            /* Visit Content */
            .visit-content {
                padding: 16px 0;
            }

            .map-title h2 {
                font-size: 1.4em;
                color: #1a3c34;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 600;
            }

            .info-section {
                text-align: center;
                background: #f8faf9;
                padding: 20px;
                border-radius: 10px;
                margin-top: 16px;
            }

            .info-section .header {
                margin-bottom: 16px;
            }

            .info-section .title {
                font-size: 1.5em;
                color: #1a3c34;
                margin-bottom: 12px;
                font-weight: 600;
            }

            .location {
                font-size: 0.95em;
                color: #4a5568;
                margin: 12px 0;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .contact-info {
                margin: 16px 0;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .contact-info .contact-item {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                font-size: 0.95em;
                color: #4a5568;
            }

            .location-icon,
            .contact-icon {
                color: #2a8b4e;
                font-size: 1.1em;
            }

            .hours-list p {
                font-size: 0.95em;
                color: #4a5568;
                line-height: 1.6;
                white-space: pre-line;
            }

            .hours-list p {
                font-size: 0.95em;
                color: #4a5568;
                line-height: 1.6;
                white-space: pre-line;
            }

            /* Buttons */
            .edit-hero-btn,
            .edit-about-btn,
            .edit-visit-btn {
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.85em;
                padding: 8px 14px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 6px;
                transition: all 0.2s ease;
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .edit-hero-btn:hover,
            .edit-about-btn:hover,
            .edit-visit-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .edit-hero-btn:active,
            .edit-about-btn:active,
            .edit-visit-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .directions-btn {
                display: inline-block;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.9em;
                padding: 10px 20px;
                border-radius: 8px;
                text-decoration: none;
                margin: 12px 0;
                transition: all 0.2s ease;
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .directions-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .directions-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            /* Modal Overlays */
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                justify-content: center;
                align-items: center;
                animation: fadeIn 0.3s ease;
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
                padding: 24px;
                border-radius: 12px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
                width: 90%;
                max-width: 500px;
                max-height: 80vh;
                overflow-y: auto;
                position: relative;
                animation: slideIn 0.3s ease;
            }

            @keyframes slideIn {
                from {
                    transform: translateY(-20px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .overlay-content .close-btn {
                position: absolute;
                top: 12px;
                right: 12px;
                background: none;
                border: none;
                font-size: 1.5em;
                color: #718096;
                cursor: pointer;
                transition: all 0.2s ease;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 6px;
            }

            .overlay-content .close-btn:hover {
                background: #f7fafc;
                color: #2d3748;
                transform: rotate(90deg);
            }

            .overlay-content h2 {
                font-size: 1.3em;
                font-weight: 600;
                color: #1a3c34;
                margin-bottom: 20px;
                padding-right: 30px;
            }

            .overlay-content .form-section {
                margin-bottom: 16px;
            }

            .overlay-content .form-group {
                margin-bottom: 16px;
            }

            .overlay-content .form-section label {
                font-size: 0.9em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 6px;
                display: block;
            }

            .overlay-content .form-section input,
            .overlay-content .form-section textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 0.9em;
                color: #1a3c34;
                background: #ffffff;
                transition: all 0.2s ease;
            }

            .overlay-content .form-section textarea {
                resize: vertical;
                min-height: 100px;
            }

            .overlay-content .form-section input:focus,
            .overlay-content .form-section textarea:focus {
                border-color: #2a8b4e;
                box-shadow: 0 0 0 3px rgba(42, 139, 78, 0.1);
                outline: none;
            }

            .overlay-content .form-section button {
                width: 100%;
                padding: 12px;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.95em;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                transition: all 0.2s ease;
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
                margin-top: 8px;
            }

            .overlay-content .form-section button:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .overlay-content .form-section button:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .main-content {
                    padding: 12px;
                }

                .about-section-wrapper {
                    padding: 16px;
                }

                .section-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }

                .section-header .header-content h2 {
                    font-size: 1.2em;
                }

                .hero-content h1 {
                    font-size: 1.5em;
                }
            }

            @media (max-width: 480px) {
                .main-content {
                    padding: 8px;
                }

                .about-section-wrapper {
                    padding: 12px;
                }

                .section-header .header-content i {
                    font-size: 1.5em;
                    padding: 10px;
                }

                .section-header .header-content h2 {
                    font-size: 1.1em;
                }

                .hero-content h1 {
                    font-size: 1.3em;
                }
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
