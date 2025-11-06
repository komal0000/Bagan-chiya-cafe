@extends('admin.layouts.base')

@section('page-title', 'Menu Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>Menu</span>
@endsection

@section('content')
    <div class="main-content">
        <!-- Menu Hero Section -->
        <section class="menu-hero">
            <div class="hero-content">
                <h1>{{ $heroTitle ?? 'Our Menu' }}</h1>
                <h1><span>{{ $heroSubtitle ?? 'Savor the Essence' }}</span></h1>
                <p id="dynamic-date">{{ $heroDescription ?? 'Explore our fresh offerings available today, Thursday.' }}</p>
                <div class="actions">
                    <button class="edit-hero-btn"
                        onclick="openEditHeroOverlay('{{ $heroTitle ?? 'Our Menu' }}', '{{ $heroSubtitle ?? 'Savor the Essence' }}', '{{ $heroDescription ?? 'Explore our fresh offerings available today, Thursday.' }}')">
                        <i class="fas fa-edit"></i> Edit Hero
                    </button>
                </div>
            </div>
        </section>

        <!-- Menu Preview Section -->
        <div class="preview-section">
            <div class="preview-header">
                <h2 id="menuTitleDisplay">{{ $menuTitle }}</h2>
                <div class="actions">
                    <button class="edit-title-btn" onclick="openEditTitleOverlay('{{ $menuTitle }}')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="add-category-btn" onclick="openCategoryOverlay()"><i class="fas fa-plus"></i> Add
                        Category</button>
                </div>
            </div>
            <div class="category-grid">
                @foreach ($categories as $category)
                    <div class="category-card" data-name="{{ $category->name }}" data-icon="{{ $category->icon }}">
                        <div class="category-header">
                            <h3><i class="fas {{ $category->icon }}"></i> {{ $category->name }}</h3>
                            <div class="actions">
                                <button class="edit-btn"
                                    onclick="openEditCategoryOverlay('{{ $category->id }}', '{{ $category->name }}', '{{ $category->icon }}')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form method="POST" action="{{ route('admin.menu.categories.destroy', $category) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Delete this category?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                <button class="add-item-btn" onclick="openItemOverlay()"><i class="fas fa-plus"></i> Add
                                    Item</button>

                            </div>
                        </div>
                        <ul>
                            @foreach ($category->items as $item)
                                <li style="padding: 6px" data-name="{{ $item->name }}" data-price="{{ $item->price }}"
                                    data-note="{{ $item->note }}" data-category="{{ $category->name }}">
                                    <div class="item-details">
                                        <span>{{ $item->name }}</span>
                                        @if ($item->note)
                                            <small>{{ $item->note }}</small>
                                        @endif
                                    </div>
                                    <div class="item-actions">
                                        {{-- <span>Rs. {{ number_format($item->price, 2) }}</span> --}}
                                        <div>
                                            <button class="edit-item-btn"
                                                onclick="openEditItemOverlay('{{ $item->menu_category_id }}', '{{ $item->name }}', '{{ $item->price }}', '{{ $item->note }}', '{{ $item->id }}')">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form method="POST" action="{{ route('admin.menu.items.destroy', $item) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn"
                                                    onclick="return confirm('Delete this item?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <div class="cta-header">
                <h2>Call to Action</h2>
                <div class="actions">
                    <button class="edit-cta-btn" onclick="openEditCtaOverlay()">
                        <i class="fas fa-edit"></i> Edit CTA
                    </button>
                </div>
            </div>
            <div class="cta-content">
                <h3>{{ $ctaTitle }}</h3>
                <p>{{ $ctaText }}</p>
                <a href="{{ $ctaLink }}" class="cta-button">{{ $ctaButton }}</a>
            </div>
        </div>

        <!-- Overlay for Edit Hero Section -->
        <div class="overlay" id="editHeroOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditHeroOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Hero Section</h2>
                    <form id="editHeroForm" method="POST" action="{{ route('admin.menu.hero.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input id="editHeroTitle" name="hero_title" type="text"
                                value="{{ $heroTitle ?? 'Our Menu' }}" required />
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input id="editHeroSubtitle" name="hero_subtitle" type="text"
                                value="{{ $heroSubtitle ?? 'Savor the Essence' }}" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editHeroDescription" name="hero_description" required>{{ $heroDescription ?? 'Explore our fresh offerings available today, Thursday.' }}</textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Hero</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit CTA Section -->
        <div class="overlay" id="editCtaOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditCtaOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit CTA Section</h2>
                    <form id="editCtaForm" method="POST" action="{{ route('admin.menu.cta.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>CTA Title</label>
                            <input name="cta_title" type="text" value="{{ $ctaTitle }}" required />
                        </div>
                        <div class="form-group">
                            <label>CTA Text</label>
                            <textarea name="cta_text" required>{{ $ctaText }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>CTA Link</label>
                            <input name="cta_link" type="url" value="{{ $ctaLink }}" required />
                        </div>
                        <div class="form-group">
                            <label>CTA Button Text</label>
                            <input name="cta_button" type="text" value="{{ $ctaButton }}" required />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save CTA</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Add Category -->
        <div class="overlay" id="categoryOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeCategoryOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Add Category</h2>
                    <form method="POST" action="{{ route('admin.menu.categories.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" placeholder="e.g., Bagan Tea Varieties" required />
                        </div>
                        <div class="form-group">
                            <label>Category Icon (Font Awesome Class)</label>
                            <input type="text" name="icon" placeholder="e.g., fa-mug-hot" />
                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View
                                Font Awesome Icons</a>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Category</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Category -->
        <div class="overlay" id="editCategoryOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditCategoryOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Category</h2>
                    <form id="editCategoryForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Category Name</label>
                            <input id="editCategoryName" name="name" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Category Icon (Font Awesome Class)</label>
                            <input id="editCategoryIcon" name="icon" type="text" />
                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View
                                Font Awesome Icons</a>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Menu Title -->
        <div class="overlay" id="editTitleOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditTitleOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Menu Title</h2>
                    <form id="editMenuTitleForm" method="POST" action="{{ route('admin.menu.title.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Menu Title</label>
                            <input id="editMenuTitle" name="menu_title" type="text" required />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Title</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Add Item -->
        <div class="overlay" id="itemOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeItemOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Add Item</h2>
                    <form method="POST" action="{{ route('admin.menu.items.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <select id="itemCategorySelect" name="category_id" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="name" placeholder="e.g., Bagan Milk Tea" required />
                        </div>
                        <div class="form-group">
                            <label>Price (Rs.)</label>
                            <input type="number" name="price" placeholder="e.g., 30" min="0" step="0.01"
                                required />
                        </div>
                        <div class="form-group">
                            <label>Note (Optional)</label>
                            <input type="text" name="note" placeholder="e.g., Additional water = Rs. 20" />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Item</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Item -->
        <div class="overlay" id="editItemOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditItemOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Item</h2>
                    <form id="editItemForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Category</label>
                            <select id="editItemCategorySelect" name="category_id" required disabled>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input id="editItemName" name="name" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Price (Rs.)</label>
                            <input id="editItemPrice" name="price" type="number" min="0" step="0.01"
                                required />
                        </div>
                        <div class="form-group">
                            <label>Note (Optional)</label>
                            <input id="editItemNote" name="note" type="text" />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <style>
            .main-content {
                padding: 16px;
                background: radial-gradient(circle, #ffffff 0%, #f9faf9 100%);
                margin: 12px;
                border-radius: 10px;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            }

            .menu-hero {
                padding: 16px;
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 16px;

            }

            .hero-content {
                text-align: center;
            }

            .hero-content h1 {
                font-size: 1.5em;
                color: #1a3c34;
            }

            .hero-content h1 span {
                color: #2a8b4e;
            }

            .hero-content p {
                font-size: 0.9em;
                color: #4a5568;
                margin: 8px 0;
            }

            .hero-content .actions {
                display: flex;
                justify-content: center;
                margin-top: 8px;
            }

            .edit-hero-btn {
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

            .edit-hero-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .edit-hero-btn:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .preview-section {
                margin-top: 16px;
            }

            .preview-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            }

            .preview-header h2 {
                font-size: 1.4em;
                font-weight: 500;
                color: #2a8b4e;
                position: relative;
            }

            .preview-header h2::after {
                content: '';
                position: absolute;
                width: 40px;
                height: 2px;
                background: #2a8b4e;
                bottom: -4px;
                left: 0;
                border-radius: 1px;
            }

            .preview-header .actions {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .cta-section {
                margin-top: 24px;
                padding: 16px;
                background: #ffffff;
                border-radius: 10px;

                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            }

            .cta-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
            }

            .cta-header h2 {
                font-size: 1.4em;
                font-weight: 500;
                color: #2a8b4e;
                position: relative;
            }

            .cta-header h2::after {
                content: '';
                position: absolute;
                width: 40px;
                height: 2px;
                background: #2a8b4e;
                bottom: -4px;
                left: 0;
                border-radius: 1px;
            }

            .cta-header .actions {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .cta-content h3 {
                font-size: 1.2em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 8px;
            }

            .cta-content p {
                font-size: 0.95em;
                color: #4a5568;
                margin-bottom: 12px;
            }

            .cta-button {
                display: inline-block;
                padding: 8px 16px;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.9em;
                text-decoration: none;
                border-radius: 16px;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            }

            .cta-button:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .cta-button:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .add-category-btn,
            .add-item-btn,
            .edit-item-btn,
            .edit-btn,
            .edit-title-btn,
            .edit-cta-btn {
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

            .edit-title-btn,
            .edit-cta-btn {
                font-size: 0.85em;
                padding: 6px 12px;
            }

            .add-category-btn:hover,
            .add-item-btn:hover,
            .edit-item-btn:hover,
            .edit-btn:hover,
            .edit-title-btn:hover,
            .edit-cta-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .add-category-btn:active,
            .add-item-btn:active,
            .edit-item-btn:active,
            .edit-btn:active,
            .edit-title-btn:active,
            .edit-cta-btn:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .delete-btn {
                color: #d32f2f;
                background: none;
                padding: 6px 12px;
                border: none;
                border-radius: 16px;
                cursor: pointer;
                font-size: 0.85em;
                display: flex;
                align-items: center;
                gap: 5px;
                transition: background 0.2s ease, color 0.2s ease;
            }

            .delete-btn:hover {
                color: #ffffff;
                background: #b71c1c;
            }

            .category-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }

            .category-card {
                background: #ffffff;
                padding: 12px;
                border-radius: 10px;

                margin-bottom: 12px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .category-card:hover {
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .category-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 6px;
            }

            .category-header h3 {
                font-size: 1.2em;
                font-weight: 500;
                color: #2a8b4e;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .category-header h3 i {
                font-size: 1em;
                color: #2a8b4e;
            }

            .category-header .actions {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .category-card ul {
                list-style: none;
                padding: 0;
                margin-top: 6px;
            }

            .category-card ul li {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid #b8d7bc;
                transition: background 0.2s ease;
            }

            .category-card ul li:hover {
                background: rgba(74, 156, 92, 0.08);
            }

            .category-card ul li:last-child {
                border-bottom: none;
            }

            .category-card ul li .item-details span {
                font-size: 0.95em;
                font-weight: 500;
                color: #1a3c34;
            }

            .category-card ul li .item-details small {
                display: block;
                font-size: 0.8em;
                color: #4a5568;
            }

            .category-card ul li .item-actions {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .category-card ul li .item-actions span {
                font-size: 0.95em;
                font-weight: 500;
                color: #1a3c34;
                margin-right: 10px;
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

            .overlay-content .form-section .form-group {
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
            .overlay-content .form-section select,
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

            .overlay-content .form-section select:disabled,
            .overlay-content .form-section input:disabled {
                background: #f0f4f0;
                cursor: not-allowed;
            }

            .overlay-content .form-section input:focus,
            .overlay-content .form-section select:focus,
            .overlay-content .form-section textarea:focus {
                border-color: #3da65f;
                box-shadow: 0 0 0 2px rgba(61, 166, 95, 0.15);
                outline: none;
            }

            .overlay-content .form-section .icon-link {
                display: inline-block;
                margin-top: 4px;
                font-size: 0.75em;
                color: #2a8b4e;
                text-decoration: none;
                transition: color 0.2s ease;
            }

            .overlay-content .form-section .icon-link:hover {
                color: #3da65f;
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

            /* Desktop (default: width >= 1024px) */
            @media (max-width: 1024px) {
                .category-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .main-content {
                    margin: 10px;
                    padding: 12px;
                }
            }

            /* Tablet (640px <= width < 1024px) */
            @media (max-width: 640px) {
                .category-grid {
                    grid-template-columns: 1fr;
                }

                .main-content {
                    margin: 8px;
                    padding: 10px;
                }

                .preview-header h2,
                .cta-header h2 {
                    font-size: 1.2em;
                }

                .cta-section {
                    padding: 12px;
                }
            }

            /* Mobile (width < 640px) */
            @media (max-width: 480px) {
                .main-content {
                    margin: 4px;
                    padding: 8px;
                }

                .preview-header h2,
                .cta-header h2 {
                    font-size: 1em;
                }

                .add-category-btn,
                .add-item-btn,
                .edit-item-btn,
                .edit-btn,
                .edit-title-btn,
                .edit-cta-btn,
                .edit-hero-btn {
                    padding: 5px 10px;
                    font-size: 0.8em;
                }

                .delete-btn {
                    padding: 5px 10px;
                    font-size: 0.8em;
                }

                .overlay-content {
                    padding: 12px;
                    width: 95%;
                }

                .overlay-content .form-section {
                    padding: 10px;
                }

                .overlay-content .form-section button {
                    padding: 6px;
                    font-size: 0.8em;
                }

                .cta-section {
                    padding: 10px;
                }

                .cta-content h3 {
                    font-size: 1em;
                }

                .cta-content p {
                    font-size: 0.85em;
                }

                .cta-button {
                    padding: 6px 12px;
                    font-size: 0.85em;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Update dynamic date
            document.addEventListener('DOMContentLoaded', function() {
                const dateElement = document.getElementById('dynamic-date');
                const today = new Date('2025-08-07T11:18:00+05:45');
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const dayName = days[today.getDay()];
                dateElement.textContent = `Explore our fresh offerings available today, ${dayName}.`;
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

            function openCategoryOverlay() {
                closeAllOverlays();
                document.getElementById('categoryOverlay').classList.add('active');
            }

            function closeCategoryOverlay() {
                document.getElementById('categoryOverlay').classList.remove('active');
            }

            function openEditCategoryOverlay(id, name, icon) {
                closeAllOverlays();
                document.getElementById('editCategoryName').value = name;
                document.getElementById('editCategoryIcon').value = icon;
                document.getElementById('editCategoryForm').action = '/admin/menu/categories/' + id;
                document.getElementById('editCategoryOverlay').classList.add('active');
            }

            function closeEditCategoryOverlay() {
                document.getElementById('editCategoryOverlay').classList.remove('active');
            }

            function openEditTitleOverlay(title) {
                closeAllOverlays();
                document.getElementById('editMenuTitle').value = title;
                document.getElementById('editTitleOverlay').classList.add('active');
            }

            function closeEditTitleOverlay() {
                document.getElementById('editTitleOverlay').classList.remove('active');
            }

            function openItemOverlay() {
                closeAllOverlays();
                const select = document.getElementById('itemCategorySelect');
                if (select) {
                    select.selectedIndex = 0;
                }
                document.getElementById('itemOverlay').classList.add('active');
            }

            function closeItemOverlay() {
                document.getElementById('itemOverlay').classList.remove('active');
            }

            function openEditItemOverlay(categoryId, name, price, note, id) {
                closeAllOverlays();
                document.getElementById('editItemCategorySelect').value = categoryId;
                document.getElementById('editItemName').value = name;
                document.getElementById('editItemPrice').value = price;
                document.getElementById('editItemNote').value = note;
                document.getElementById('editItemForm').action = '/admin/menu/items/' + id;
                document.getElementById('editItemOverlay').classList.add('active');
            }

            function closeEditItemOverlay() {
                document.getElementById('editItemOverlay').classList.remove('active');
            }

            function openEditCtaOverlay() {
                closeAllOverlays();
                document.getElementById('editCtaOverlay').classList.add('active');
            }

            function closeEditCtaOverlay() {
                document.getElementById('editCtaOverlay').classList.remove('active');
            }

            function closeAllOverlays() {
                document.querySelectorAll('.overlay').forEach(overlay => {
                    overlay.classList.remove('active');
                });
            }

            document.querySelector('.add-category-btn').addEventListener('click', openCategoryOverlay);
            document.querySelector('.edit-cta-btn')?.addEventListener('click', openEditCtaOverlay);
            document.querySelector('.edit-hero-btn')?.addEventListener('click', openEditHeroOverlay);
        </script>
    @endpush
@endsection
