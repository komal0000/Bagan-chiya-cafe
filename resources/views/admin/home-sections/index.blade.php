@extends('admin.layouts.base')

@section('page-title', 'Home Sections Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>Home Sections</span>
@endsection

@section('content')
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Gallery Section -->
        <div class="section-wrapper">
            <div class="section-header">
                <div class="header-content">
                    <i class="fas fa-images"></i>
                    <div>
                        <h2>Gallery Section</h2>
                        <p>Manage tea gallery section on homepage</p>
                    </div>
                </div>
                <button class="edit-btn" onclick="openEditGalleryOverlay()">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
            <div class="section-content">
                <h3>{{ $gallerySection->title }}</h3>
                <p class="subtitle">{{ $gallerySection->subtitle }}</p>
                <div class="button-preview">
                    <span class="label">Button:</span>
                    <span class="value">{{ $gallerySection->button_text }}</span>
                    <span class="label">Link:</span>
                    <span class="value">{{ $gallerySection->button_link }}</span>
                </div>
            </div>
        </div>

        <!-- Owner Words Section -->
        <div class="section-wrapper">
            <div class="section-header">
                <div class="header-content">
                    <i class="fas fa-quote-left"></i>
                    <div>
                        <h2>Owner Words Section</h2>
                        <p>Manage founder's message on homepage</p>
                    </div>
                </div>
                <button class="edit-btn" onclick="openEditOwnerOverlay()">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
            <div class="section-content">
                <h3>{{ $ownerWords->title }}</h3>
                <div class="owner-preview">
                    <img src="{{ $ownerWords->photo_url }}" alt="Owner Photo" class="owner-photo-preview">
                    <div>
                        <p class="quote">"{{ $ownerWords->quote }}"</p>
                        <p class="signature">{{ $ownerWords->signature }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Gallery Section Overlay -->
    <div class="overlay" id="editGalleryOverlay">
        <div class="overlay-content">
            <button class="close-btn" onclick="closeEditGalleryOverlay()"><i class="fas fa-times"></i></button>
            <h2>Edit Gallery Section</h2>
            <div class="form-section">
                <form method="POST" action="{{ route('admin.home-sections.update-gallery') }}">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $gallerySection->title }}" required>
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" value="{{ $gallerySection->subtitle }}" required>
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text" value="{{ $gallerySection->button_text }}" required>
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" name="button_link" value="{{ $gallerySection->button_link }}" required>
                    </div>
                    <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Owner Words Overlay -->
    <div class="overlay" id="editOwnerOverlay">
        <div class="overlay-content">
            <button class="close-btn" onclick="closeEditOwnerOverlay()"><i class="fas fa-times"></i></button>
            <h2>Edit Owner Words Section</h2>
            <div class="form-section">
                <form method="POST" action="{{ route('admin.home-sections.update-owner') }}">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $ownerWords->title }}" required>
                    </div>
                    <div class="form-group">
                        <label>Photo URL</label>
                        <input type="text" name="photo_url" value="{{ $ownerWords->photo_url }}" placeholder="https://example.com/photo.jpg">
                        <small>Enter image URL from Cloudinary or other source</small>
                    </div>
                    <div class="form-group">
                        <label>Quote</label>
                        <textarea name="quote" required>{{ $ownerWords->quote }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Signature</label>
                        <input type="text" name="signature" value="{{ $ownerWords->signature }}" required>
                    </div>
                    <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Main Content */
            .main-content {
                background: #f5f7fa;
                min-height: 100vh;
                padding: 20px;
            }

            .alert {
                padding: 12px 20px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 0.95em;
            }

            .alert-success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }

            /* Section Wrappers */
            .section-wrapper {
                background: #ffffff;
                border-radius: 12px;
                padding: 24px;
                margin-bottom: 24px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #2a8b4e;
                transition: all 0.3s ease;
            }

            .section-wrapper:hover {
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

            /* Section Content */
            .section-content {
                padding: 16px 0;
            }

            .section-content h3 {
                font-size: 1.3em;
                color: #1a3c34;
                margin-bottom: 12px;
                font-weight: 600;
            }

            .section-content .subtitle {
                font-size: 0.95em;
                color: #718096;
                margin-bottom: 16px;
            }

            .button-preview {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                background: #f8faf9;
                border-radius: 8px;
                font-size: 0.9em;
            }

            .button-preview .label {
                font-weight: 600;
                color: #1a3c34;
            }

            .button-preview .value {
                color: #4a5568;
            }

            .owner-preview {
                display: flex;
                gap: 20px;
                align-items: start;
            }

            .owner-photo-preview {
                width: 120px;
                height: 120px;
                border-radius: 12px;
                object-fit: cover;
                border: 3px solid #2a8b4e;
            }

            .owner-preview .quote {
                font-size: 1em;
                color: #4a5568;
                line-height: 1.6;
                margin-bottom: 12px;
                font-style: italic;
            }

            .owner-preview .signature {
                font-weight: 600;
                color: #1a3c34;
            }

            /* Buttons */
            .edit-btn {
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

            .edit-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .edit-btn:active {
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

            .overlay-content .form-section small {
                font-size: 0.8em;
                color: #718096;
                display: block;
                margin-top: 4px;
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

                .section-wrapper {
                    padding: 16px;
                }

                .section-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }

                .owner-preview {
                    flex-direction: column;
                }

                .owner-photo-preview {
                    width: 100px;
                    height: 100px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function openEditGalleryOverlay() {
                document.getElementById('editGalleryOverlay').classList.add('active');
            }

            function closeEditGalleryOverlay() {
                document.getElementById('editGalleryOverlay').classList.remove('active');
            }

            function openEditOwnerOverlay() {
                document.getElementById('editOwnerOverlay').classList.add('active');
            }

            function closeEditOwnerOverlay() {
                document.getElementById('editOwnerOverlay').classList.remove('active');
            }

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeEditGalleryOverlay();
                    closeEditOwnerOverlay();
                }
            });

            // Close on outside click
            document.querySelectorAll('.overlay').forEach(overlay => {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                    }
                });
            });
        </script>
    @endpush
@endsection
