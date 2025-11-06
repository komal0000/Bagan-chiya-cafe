@extends('admin.layouts.base')

@section('page-title', 'Gallery Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>Gallery</span>
@endsection

@section('content')
    <style>
        .gallery-section {
            padding: 30px;
        }

        .gallery-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .gallery-title {
            font-size: 2em;
            color: #1a3c34;
            font-weight: 700;
        }

        .gallery-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
            flex: 1;
            min-width: 200px;
        }

        .stat-card h3 {
            font-size: 2.5em;
            margin: 0;
            font-weight: 700;
        }

        .stat-card p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 0.95em;
        }

        .filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-btn {
            padding: 10px 20px;
            background: white;
            border: 2px solid #2e7d32;
            color: #2e7d32;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #2e7d32;
            color: white;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .gallery-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-card-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            cursor: pointer;
        }

        .gallery-card-content {
            padding: 20px;
        }

        .gallery-card-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #1a3c34;
            margin-bottom: 8px;
        }

        .gallery-card-description {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .gallery-card-meta {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .featured-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #ffd700;
            color: #856404;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .gallery-card-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9em;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: #2e7d32;
            color: white;
        }

        .btn-primary:hover {
            background: #1b5e20;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85em;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex !important;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideIn 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
        }

        .modal-title {
            font-size: 1.5em;
            color: #1a3c34;
            font-weight: 700;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #666;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: #f0f0f0;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #2e7d32;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-check input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .image-preview {
            margin-top: 15px;
            max-width: 100%;
            border-radius: 8px;
            display: none;
        }

        .image-preview.active {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .empty-state i {
            font-size: 4em;
            color: #ccc;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.5em;
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .gallery-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .modal-content {
                padding: 20px;
            }
        }
    </style>

    <div class="gallery-section">
        <!-- Header -->
        <div class="gallery-header">
            <h2 class="gallery-title">
                <i class="fas fa-images"></i> Gallery Management
            </h2>
            <button class="btn btn-primary" onclick="openAddModal()">
                <i class="fas fa-plus"></i> Add New Image
            </button>
        </div>

        <!-- Gallery Settings Cards -->
        <div class="settings-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <!-- Hero Section Card -->
            <div class="settings-card" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h3 style="color: #1a3c34; font-size: 1.3em; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-banner" style="color: #2e7d32;"></i>
                        Hero Section
                    </h3>
                    <button class="btn btn-secondary btn-sm" onclick="openEditSettingsModal('hero')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
                <div style="color: #666;">
                    <p style="margin-bottom: 8px;"><strong>Title:</strong> {{ $heroSettings->title ?? 'Not set' }}</p>
                    <p style="margin-bottom: 8px;"><strong>Subtitle:</strong> {{ $heroSettings->subtitle ?? 'Not set' }}</p>
                    <p style="margin-bottom: 0;"><strong>Description:</strong> {{ Str::limit($heroSettings->description ?? 'Not set', 80) }}</p>
                </div>
            </div>

            <!-- Header Section Card -->
            <div class="settings-card" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h3 style="color: #1a3c34; font-size: 1.3em; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-heading" style="color: #2e7d32;"></i>
                        Gallery Header
                    </h3>
                    <button class="btn btn-secondary btn-sm" onclick="openEditSettingsModal('header')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
                <div style="color: #666;">
                    <p style="margin-bottom: 8px;"><strong>Title:</strong> {{ $headerSettings->title ?? 'Not set' }}</p>
                    <p style="margin-bottom: 0;"><strong>Description:</strong> {{ Str::limit($headerSettings->description ?? 'Not set', 120) }}</p>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="gallery-stats">
            <div class="stat-card">
                <h3>{{ $galleries->count() }}</h3>
                <p>Total Images</p>
            </div>
            <div class="stat-card">
                <h3>{{ $galleries->where('is_featured', true)->count() }}</h3>
                <p>Featured Images</p>
            </div>
            <div class="stat-card">
                <h3>{{ $categories->count() }}</h3>
                <p>Categories</p>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterCategory('all')">All</button>
            @foreach($categories as $category)
                <button class="filter-btn" onclick="filterCategory('{{ $category }}')">
                    {{ ucfirst($category) }}
                </button>
            @endforeach
        </div>

        <!-- Gallery Grid -->
        @if($galleries->count() > 0)
            <div class="gallery-grid" id="galleryGrid">
                @foreach($galleries as $gallery)
                    <div class="gallery-card" data-category="{{ $gallery->category }}">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}"
                             alt="{{ $gallery->title }}"
                             class="gallery-card-image"
                             onclick="viewImage('{{ asset('storage/' . $gallery->image_path) }}', '{{ $gallery->title }}')">
                        <div class="gallery-card-content">
                            <h3 class="gallery-card-title">{{ $gallery->title }}</h3>
                            <p class="gallery-card-description">
                                {{ Str::limit($gallery->description, 80) }}
                            </p>
                            <div class="gallery-card-meta">
                                <span class="category-badge">{{ ucfirst($gallery->category) }}</span>
                                @if($gallery->is_featured)
                                    <span class="featured-badge">
                                        <i class="fas fa-star"></i> Featured
                                    </span>
                                @endif
                            </div>
                            <div class="gallery-card-actions">
                                <button class="btn btn-secondary btn-sm" onclick="openEditModal({{ $gallery->id }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this image?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>No Images Yet</h3>
                <p>Start by adding your first gallery image!</p>
                <button class="btn btn-primary" onclick="openAddModal()">
                 Add First Image
                </button>
            </div>
        @endif
    </div>

    <!-- Add Image Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Image</h3>
                <button class="close-btn" onclick="closeAddModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-control" required>
                        <option value="gardens">Tea Gardens</option>
                        <option value="ceremony">Ceremonies</option>
                        <option value="harvest">Harvest</option>
                        <option value="community">Community</option>
                        <option value="cafe">Cafe</option>
                        <option value="food">Food & Beverages</option>
                        <option value="events">Events</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Image *</label>
                    <input type="file" name="image" class="form-control" accept="image/*"
                           onchange="previewImage(event, 'addImagePreview')" required>
                    <img id="addImagePreview" class="image-preview">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1">
                        <label for="is_featured" class="form-label" style="margin: 0;">Mark as Featured</label>
                    </div>
                </div>
                <div class="form-group" style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Image Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Image</h3>
                <button class="close-btn" onclick="closeEditModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" id="edit_title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category" id="edit_category" class="form-control" required>
                        <option value="gardens">Tea Gardens</option>
                        <option value="ceremony">Ceremonies</option>
                        <option value="harvest">Harvest</option>
                        <option value="community">Community</option>
                        <option value="cafe">Cafe</option>
                        <option value="food">Food & Beverages</option>
                        <option value="events">Events</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Current Image</label>
                    <img id="currentImage" src="" alt="Current" style="max-width: 200px; border-radius: 8px; margin-bottom: 10px;">
                </div>
                <div class="form-group">
                    <label class="form-label">Change Image (optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*"
                           onchange="previewImage(event, 'editImagePreview')">
                    <img id="editImagePreview" class="image-preview">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="edit_is_featured" value="1">
                        <label for="edit_is_featured" class="form-label" style="margin: 0;">Mark as Featured</label>
                    </div>
                </div>
                <div class="form-group" style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Image View Modal -->
    <div id="viewModal" class="modal" onclick="closeViewModal()">
        <div class="modal-content" style="max-width: 900px;" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3 class="modal-title" id="viewImageTitle"></h3>
                <button class="close-btn" onclick="closeViewModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <img id="viewImageSrc" src="" alt="View" style="width: 100%; border-radius: 8px;">
        </div>
    </div>

    <!-- Edit Settings Modal -->
    <div id="editSettingsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="settingsModalTitle">Edit Settings</h3>
                <button class="close-btn" onclick="closeSettingsModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.gallery.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" id="settings_section">

                <div class="form-group">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" id="settings_title" class="form-control" required>
                </div>

                <div class="form-group" id="settings_subtitle_group">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" id="settings_subtitle" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea name="description" id="settings_description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group" style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeSettingsModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Functions
        function openAddModal() {
            console.log('Opening add modal...');
            const modal = document.getElementById('addModal');
            if (modal) {
                modal.classList.add('active');
                console.log('Add modal opened successfully');
            } else {
                console.error('Add modal element not found!');
            }
        }

        function closeAddModal() {
            console.log('Closing add modal...');
            const modal = document.getElementById('addModal');
            if (modal) {
                modal.classList.remove('active');
                const form = document.querySelector('#addModal form');
                if (form) form.reset();
                const preview = document.getElementById('addImagePreview');
                if (preview) preview.classList.remove('active');
                console.log('Add modal closed successfully');
            }
        }

        function openEditModal(id) {
            fetch(`/admin/gallery/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_title').value = data.title;
                    document.getElementById('edit_description').value = data.description || '';
                    document.getElementById('edit_category').value = data.category;
                    document.getElementById('edit_is_featured').checked = data.is_featured;
                    document.getElementById('currentImage').src = `/storage/${data.image_path}`;
                    document.getElementById('editForm').action = `/admin/gallery/${data.id}`;
                    document.getElementById('editModal').classList.add('active');
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
            document.getElementById('editImagePreview').classList.remove('active');
        }

        function viewImage(src, title) {
            document.getElementById('viewImageSrc').src = src;
            document.getElementById('viewImageTitle').textContent = title;
            document.getElementById('viewModal').classList.add('active');
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.remove('active');
        }

        // Settings Modal Functions
        function openEditSettingsModal(section) {
            console.log('Opening settings modal for:', section);
            const modal = document.getElementById('editSettingsModal');
            const settings = @json(['hero' => $heroSettings, 'header' => $headerSettings]);
            const data = settings[section];

            if (!data) {
                alert('Settings not found for this section');
                return;
            }

            // Update modal title
            document.getElementById('settingsModalTitle').textContent =
                section === 'hero' ? 'Edit Hero Section' : 'Edit Gallery Header';

            // Fill form fields
            document.getElementById('settings_section').value = section;
            document.getElementById('settings_title').value = data.title || '';
            document.getElementById('settings_subtitle').value = data.subtitle || '';
            document.getElementById('settings_description').value = data.description || '';

            // Hide subtitle field for header section
            const subtitleGroup = document.getElementById('settings_subtitle_group');
            if (section === 'header') {
                subtitleGroup.style.display = 'none';
            } else {
                subtitleGroup.style.display = 'block';
            }

            modal.classList.add('active');
        }

        function closeSettingsModal() {
            document.getElementById('editSettingsModal').classList.remove('active');
        }

        // Image Preview
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('active');
                };
                reader.readAsDataURL(file);
            }
        }

        // Filter Function
        function filterCategory(category) {
            const cards = document.querySelectorAll('.gallery-card');
            const buttons = document.querySelectorAll('.filter-btn');

            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Close modals on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddModal();
                closeEditModal();
                closeViewModal();
                closeSettingsModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('addModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddModal();
            }
        });

        document.getElementById('editModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('editSettingsModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSettingsModal();
            }
        });

        document.getElementById('editModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Test modal on page load
        console.log('Gallery admin page loaded');
        console.log('Add modal element:', document.getElementById('addModal'));
    </script>
@endsection
