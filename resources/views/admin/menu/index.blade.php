@extends('admin.layouts.base')

@section('page-title', 'Menu Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>Menu</span>
@endsection

@section('content')
    <div class="main-content">
        <!-- Menu Hero Section -->
        <section class="menu-section-wrapper">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="section-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div>
                        <h2 class="section-title">Hero Section</h2>
                        <p class="section-subtitle">Main banner content for the menu page</p>
                    </div>
                </div>
                <button class="edit-hero-btn"
                    onclick="openEditHeroOverlay('{{ $heroTitle ?? 'Our Menu' }}', '{{ $heroSubtitle ?? 'Savor the Essence' }}', '{{ $heroDescription ?? 'Explore our fresh offerings available today, Thursday.' }}')">
                    <i class="fas fa-edit"></i> Edit Hero
                </button>
            </div>
            <div class="menu-hero">
                <div class="hero-content">
                    <h1>{{ $heroTitle ?? 'Our Menu' }}</h1>
                    <h1><span>{{ $heroSubtitle ?? 'Savor the Essence' }}</span></h1>
                    <p id="dynamic-date">{{ $heroDescription ?? 'Explore our fresh offerings available today, Thursday.' }}</p>
                </div>
            </div>
        </section>

        <!-- Menu Categories Section -->
        <div class="menu-section-wrapper">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="section-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div>
                        <h2 class="section-title" id="menuTitleDisplay">{{ $menuTitle }}</h2>
                        <p class="section-subtitle">Manage your menu categories and items</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="edit-title-btn" onclick="openEditTitleOverlay('{{ $menuTitle }}')">
                        <i class="fas fa-edit"></i> Edit Title
                    </button>
                    <button class="add-category-btn" onclick="openCategoryOverlay()">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
            </div>
            <div class="preview-section">
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
        </div>

        <!-- CTA Section -->
        <div class="menu-section-wrapper">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="section-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div>
                        <h2 class="section-title">Call to Action</h2>
                        <p class="section-subtitle">Encourage visitors to take action</p>
                    </div>
                </div>
                <button class="edit-cta-btn" onclick="openEditCtaOverlay()">
                    <i class="fas fa-edit"></i> Edit CTA
                </button>
            </div>
            <div class="cta-section">
                <div class="cta-content">
                    <h3>{{ $ctaTitle }}</h3>
                    <p>{{ $ctaText }}</p>
                    <a href="{{ $ctaLink }}" class="cta-button">{{ $ctaButton }}</a>
                </div>
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
                padding: 20px;
                background: #f5f7fa;
                margin: 0;
                min-height: 100vh;
            }

            /* Section Container - Add clear separation */
            .menu-section-wrapper {
                background: white;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 25px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #2a8b4e;
                transition: all 0.3s ease;
            }

            .menu-section-wrapper:hover {
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            }

            /* Section Header - Make sections more distinct */
            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 2px solid #e8f5e9;
            }

            .section-header-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .section-icon {
                width: 45px;
                height: 45px;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.3em;
            }

            .section-title {
                font-size: 1.6em;
                font-weight: 600;
                color: #1a3c34;
                margin: 0;
            }

            .section-subtitle {
                font-size: 0.9em;
                color: #718096;
                margin-top: 5px;
            }

            .header-actions {
                display: flex;
                gap: 10px;
            }

            .menu-hero {
                padding: 0;
                background: transparent;
                border-radius: 0;
                margin-bottom: 0;
            }

            .hero-content {
                text-align: center;
            }

            .hero-content h1 {
                font-size: 2em;
                color: #1a3c34;
                margin-bottom: 10px;
                font-weight: 600;
            }

            .hero-content h1 span {
                color: #2a8b4e;
                display: block;
                font-size: 0.8em;
                margin-top: 5px;
            }

            .hero-content p {
                font-size: 1em;
                color: #4a5568;
                margin: 12px 0 20px;
                line-height: 1.6;
            }

            .edit-hero-btn,
            .edit-title-btn,
            .add-category-btn,
            .edit-cta-btn {
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.9em;
                padding: 10px 18px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                transition: all 0.2s ease;
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .edit-hero-btn:hover,
            .edit-title-btn:hover,
            .add-category-btn:hover,
            .edit-cta-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .edit-hero-btn:active,
            .edit-title-btn:active,
            .add-category-btn:active,
            .edit-cta-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .preview-section {
                margin-top: 0;
            }

            .category-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 20px;
                margin-top: 20px;
            }

            .category-card {
                background: #f8faf9;
                padding: 20px;
                border-radius: 12px;
                border: 1px solid #e2e8f0;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .category-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #2a8b4e, #1a5630);
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .category-card:hover::before {
                transform: scaleX(1);
            }

            .category-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
                border-color: #2a8b4e;
            }

            .category-header {
                margin-bottom: 15px;
                padding-bottom: 12px;
                border-bottom: 2px solid #e2e8f0;
            }

            .category-header h3 {
                font-size: 1.3em;
                font-weight: 600;
                color: #1a3c34;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .category-header h3 i {
                color: #2a8b4e;
            }

            .category-header .actions {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .category-card ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .category-card ul li {
                background: white;
                padding: 12px;
                margin-bottom: 10px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                transition: all 0.2s ease;
            }

            .category-card ul li:hover {
                border-color: #2a8b4e;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .item-details {
                display: flex;
                flex-direction: column;
                gap: 4px;
                margin-bottom: 8px;
            }

            .item-details span {
                font-weight: 600;
                color: #1a3c34;
                font-size: 1em;
            }

            .item-details small {
                color: #718096;
                font-size: 0.85em;
            }

            .item-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 8px;
                border-top: 1px solid #e2e8f0;
            }

            .item-actions > div {
                display: flex;
                gap: 8px;
            }

            .add-category-btn,
            .add-item-btn,
            .edit-item-btn,
            .edit-btn,
            .edit-title-btn {
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

            .edit-title-btn,
            .edit-cta-btn {
                font-size: 0.85em;
                padding: 8px 14px;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 6px;
                transition: all 0.2s ease;
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .add-category-btn:hover,
            .add-item-btn:hover,
            .edit-item-btn:hover,
            .edit-btn:hover,
            .edit-title-btn:hover,
            .edit-cta-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .add-category-btn:active,
            .add-item-btn:active,
            .edit-item-btn:active,
            .edit-btn:active,
            .edit-title-btn:active,
            .edit-cta-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .delete-category-btn,
            .delete-item-btn,
            .delete-btn {
                background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
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
                box-shadow: 0 2px 5px rgba(229, 62, 62, 0.3);
            }

            .delete-category-btn:hover,
            .delete-item-btn:hover,
            .delete-btn:hover {
                background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(229, 62, 62, 0.4);
            }

            .delete-category-btn:active,
            .delete-item-btn:active,
            .delete-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(229, 62, 62, 0.3);
            }

            /* CTA Section */
            .cta-content {
                margin-top: 12px;
            }

            .cta-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .cta-header h3 {
                font-size: 1.1em;
                font-weight: 600;
                color: #1a3c34;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .cta-header h3 i {
                color: #2a8b4e;
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
                padding: 10px 20px;
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.9em;
                text-decoration: none;
                border-radius: 8px;
                transition: all 0.2s ease;
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .cta-button:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .cta-button:active {
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

            .overlay-content .form-section .form-group {
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
            .overlay-content .form-section select,
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

            .overlay-content .form-section select:disabled,
            .overlay-content .form-section input:disabled {
                background: #f7fafc;
                cursor: not-allowed;
                opacity: 0.6;
            }

            .overlay-content .form-section input:focus,
            .overlay-content .form-section select:focus,
            .overlay-content .form-section textarea:focus {
                border-color: #2a8b4e;
                box-shadow: 0 0 0 3px rgba(42, 139, 78, 0.1);
                outline: none;
            }

            .overlay-content .form-section .icon-link {
                display: inline-block;
                margin-top: 6px;
                font-size: 0.8em;
                color: #2a8b4e;
                text-decoration: none;
                transition: color 0.2s ease;
            }

            .overlay-content .form-section .icon-link:hover {
                color: #3da65f;
                text-decoration: underline;
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
            @media (max-width: 1024px) {
                .category-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .main-content {
                    margin: 10px;
                    padding: 16px;
                }
            }

            @media (max-width: 640px) {
                .category-grid {
                    grid-template-columns: 1fr;
                }

                .main-content {
                    margin: 8px;
                    padding: 12px;
                }

                .menu-section-wrapper {
                    padding: 16px;
                }

                .section-header h2 {
                    font-size: 1.3em;
                }
            }

            @media (max-width: 480px) {
                .main-content {
                    margin: 4px;
                    padding: 8px;
                }

                .menu-section-wrapper {
                    padding: 12px;
                }

                .section-header h2 {
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
