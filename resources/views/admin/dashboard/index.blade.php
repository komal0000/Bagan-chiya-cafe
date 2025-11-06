@extends('admin.layouts.base')

@section('page-title', 'Dashboard')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>Dashboard</span>
@endsection

@section('content')
    <div class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <div class="badge">
                    <i class="fas fa-leaf badge-icon"></i>
                    <span>{{ $badgeText }}</span>
                </div>
                <h1 class="welcome-message">{{ $heroTitle }}</h1>
                <p class="description">
                    {{ $heroDescription }}
                </p>
                <div class="cta">
                    <a href="{{ $primaryCtaLink }}" class="btn primary">
                        <span>{{ $primaryCtaText }}</span>
                        <i class="fas fa-arrow-right btn-icon"></i>
                    </a>
                    <a href="{{ $secondaryCtaLink }}" class="btn secondary">
                        <span>{{ $secondaryCtaText }}</span>
                        <i class="fas fa-book btn-icon"></i>
                    </a>
                </div>
                <div class="stats">
                    @foreach ($stats as $stat)
                        <div class="stat">
                            <i class="fas {{ $stat->stat_icon }} stat-icon"></i>
                            <div class="stat-number">{{ $stat->stat_number }}</div>
                            <div>{{ $stat->stat_label }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="actions">
                    <button class="edit-hero-btn"
                        onclick="openEditHeroOverlay('{{ $badgeText }}', '{{ $heroTitle }}', '{{ $heroDescription }}', '{{ $primaryCtaText }}', '{{ $primaryCtaLink }}', '{{ $secondaryCtaText }}', '{{ $secondaryCtaLink }}', '{{ json_encode($stats) }}')">
                        <i class="fas fa-edit"></i> Edit Hero
                    </button>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="why-us-section section">
            <div class="section-container">
                <h2 class="section-title">Why Choose Us</h2>
                <div class="why-us-cards">
                    @php
                        // Fallback data if $whyUsCards is not defined
                        $defaultWhyUsCards = [
                            [
                                'icon' => 'fa-leaf',
                                'title' => 'Organic Ingredients',
                                'description' => 'We use only the finest organic teas and herbs sourced locally.',
                            ],
                            [
                                'icon' => 'fa-smile',
                                'title' => 'Friendly Service',
                                'description' => 'Our staff ensures a warm and welcoming experience every time.',
                            ],
                            [
                                'icon' => 'fa-heart',
                                'title' => 'Authentic Taste',
                                'description' => 'Experience the true essence of Nepali tea culture.',
                            ],
                        ];
                        $whyUsCards = isset($whyUsCards) ? $whyUsCards : $defaultWhyUsCards;
                    @endphp
                    @foreach ($whyUsCards as $index => $card)
                        <div class="why-us-card">
                            <i class="fas {{ $card['icon'] }}"></i>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['description'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="actions">
                    <button class="edit-why-us-btn" onclick="openEditWhyUsOverlay('{{ json_encode($whyUsCards) }}')">
                        <i class="fas fa-edit"></i> Edit Why Choose Us
                    </button>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section section">
            <div class="section-container">
                @php
                    // Fallback for testimonials section title
                    $testimonialsTitle = isset($testimonialsTitle) ? $testimonialsTitle : 'What Our Customers Say';
                @endphp
                <h2 class="section-title">{{ $testimonialsTitle }}</h2>
                <div class="testimonial-cards">
                    @php
                        // Fallback data if $testimonials is not defined
                        $defaultTestimonials = [
                            [
                                'text' => 'Great place to hang out!! Matka tea and banana chips were so delicious!',
                                'rating' => 5,
                                'author' => 'Kalpana Panday',
                            ],
                            [
                                'text' => 'Great place for tea lovers!! Especially, Bagan special tea!',
                                'rating' => 4.5,
                                'author' => 'Jibit Khanal',
                            ],
                            ['text' => 'Best and affordable Cafe', 'rating' => 5, 'author' => 'Sudin Bikram Thapa'],
                            [
                                'text' =>
                                    "Atmosphere was amazing!! Will recommend!\nFood: 5\nService: 5\nAtmosphere: 5",
                                'rating' => 4.5,
                                'author' => 'Kishan Bist',
                            ],
                        ];
                        $testimonials = isset($testimonials) ? $testimonials : $defaultTestimonials;
                    @endphp
                    @foreach ($testimonials as $index => $testimonial)
                        <div class="testimonial-card">
                            <p class="testimonial-text">{!! nl2br(e($testimonial['text'])) !!}</p>
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($testimonial['rating']))
                                        <i class="fas fa-star"></i>
                                    @elseif($i == ceil($testimonial['rating']) && $testimonial['rating'] - floor($testimonial['rating']) >= 0.5)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="testimonial-author">- {{ $testimonial['author'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="actions">
                    <button class="edit-testimonials-btn"
                        onclick="openEditTestimonialsOverlay('{{ json_encode($testimonials) }}', '{{ $testimonialsTitle }}')">
                        <i class="fas fa-edit"></i> Edit Testimonials
                    </button>
                </div>
            </div>
        </section>

        <!-- Special Offer Section -->
        <section class="special-offer-section section">
            <div class="section-container">
                <h2 class="section-title1">{{ $specialOfferTitle }}</h2>
                <div class="sort-controls">
                    <label for="sortSpecialOffers">Sort by Title:</label>
                    <select id="sortSpecialOffers" onchange="sortSpecialOfferItems()">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="special-offer-cards" id="specialOfferCards">
                    @foreach ($specialOfferCards as $card)
                        <div class="special-offer-card" data-title="{{ $card->title }}">
                            <h3>{{ $card->title }}</h3>
                            <p>{{ $card->description }}</p>
                            <p class="offer-price">
                                Price:
                                @if ($card->original_price)
                                    <s>Rs {{ $card->original_price }}</s>
                                    <span class="discount-price">Rs {{ $card->price }}</span>
                                    @if ($card->discount_percentage)
                                        ({{ $card->discount_percentage }}% OFF)
                                    @endif
                                @else
                                    Rs {{ $card->price }}
                                @endif
                            </p>
                            @if ($card->discount_code)
                                <p class="discount-note">Limited time offer! Use code
                                    <strong>{{ $card->discount_code }}</strong> at checkout.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="actions">
                    <button class="edit-special-offer-btn"
                        onclick="openEditSpecialOfferOverlay('{{ $specialOfferCards->toJson() }}', '{{ $specialOfferTitle }}')">
                        <i class="fas fa-edit"></i> Edit Special Offer
                    </button>
                </div>
            </div>
        </section>

        <!-- Additional Sections -->
        <section class="additional-sections section">
            <h2 class="section-title1">Additional Sections</h2>
            <div class="section-container">
                <div class="sort-controls">
                    <label for="sortAdditionalSections">Sort by Title:</label>
                    <select id="sortAdditionalSections" onchange="sortAdditionalSections()">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="sections-container" id="sectionsContainer">
                    @foreach ($additionalSections as $index => $section)
                        <div class="section-card" data-title="{{ $section['title'] }}">
                            <h2 class="section-title">Section {{ $index + 1 }}: {{ $section['title'] }}</h2>
                            <p>{{ $section['description'] }}</p>
                            <a href="{{ $section['link_url'] }}" class="section-link"
                                {{ $section['target'] ? 'target=' . $section['target'] : '' }}>
                                {{ $section['link_text'] }} <i class="fas {{ $section['icon'] }}"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="actions">
                    <button class="edit-additional-sections-btn"
                        onclick="openEditAdditionalSectionsOverlay('{{ json_encode($additionalSections) }}')">
                        <i class="fas fa-edit"></i> Edit Additional Sections
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
                    <form id="editHeroForm" method="POST" action="{{ route('admin.hero.update') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="error-message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group-section">
                            <h3>Content</h3>
                            <div class="form-group">
                                <label>Heading</label>
                                <input id="editBadgeText" name="badge_text" type="text"
                                    value="{{ old('badge_text', $badgeText) }}" required />
                                @error('badge_text')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Welcome</label>
                                <input id="editWelcome" name="welcome" type="text"
                                    value="{{ old('welcome', $heroTitle) }}" required />
                                @error('welcome')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="editHeroDescription" name="hero_description" required>{{ old('hero_description', $heroDescription) }}</textarea>
                                @error('hero_description')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>CTA 1 Text</label>
                                <input id="editPrimaryCtaText" name="primary_cta_text" type="text"
                                    value="{{ old('primary_cta_text', $primaryCtaText) }}" required />
                                @error('primary_cta_text')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>CTA 1 Link</label>
                                <input id="editPrimaryCtaLink" name="primary_cta_link" type="url"
                                    value="{{ old('primary_cta_link', $primaryCtaLink) }}" required />
                                @error('primary_cta_link')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>CTA 2 Text</label>
                                <input id="editSecondaryCtaText" name="secondary_cta_text" type="text"
                                    value="{{ old('secondary_cta_text', $secondaryCtaText) }}" required />
                                @error('secondary_cta_text')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>CTA 2 Link</label>
                                <input id="editSecondaryCtaLink" name="secondary_cta_link" type="url"
                                    value="{{ old('secondary_cta_link', $secondaryCtaLink) }}" required />
                                @error('secondary_cta_link')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group-section">
                            <h3>Stats</h3>
                            <div id="statsContainer">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="stat-group" data-index="{{ $i }}">
                                        <h4>Stat {{ $i + 1 }}</h4>
                                        <div class="form-group">
                                            <label>Icon (Font Awesome Class)</label>
                                            <input name="stats[{{ $i }}][icon]" type="text"
                                                class="stat-icon"
                                                value="{{ old('stats.' . $i . '.icon', $stats[$i]->stat_icon ?? '') }}"
                                                required />
                                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank"
                                                class="icon-link">View Font Awesome Icons</a>
                                            @error('stats.' . $i . '.icon')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Number</label>
                                            <input name="stats[{{ $i }}][number]" type="text"
                                                class="stat-number"
                                                value="{{ old('stats.' . $i . '.number', $stats[$i]->stat_number ?? '') }}"
                                                required />
                                            @error('stats.' . $i . '.number')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Info</label>
                                            <input name="stats[{{ $i }}][info]" type="text"
                                                class="stat-info"
                                                value="{{ old('stats.' . $i . '.info', $stats[$i]->stat_label ?? '') }}"
                                                required />
                                            @error('stats.' . $i . '.info')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <button type="submit" id="saveHeroBtn"><i class="fas fa-save"></i> Save Hero</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Why Choose Us Section -->
        <div class="overlay" id="editWhyUsOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditWhyUsOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Why Choose Us Section</h2>
                    <form id="editWhyUsForm" method="POST" action="{{ route('admin.whyus.update') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="error-message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group-section">
                            <h3>Cards</h3>
                            <div id="whyUsCardsContainer">
                                @foreach ($whyUsCards as $index => $card)
                                    <div class="card-group" data-index="{{ $index }}">
                                        <h4>Card {{ $index + 1 }}</h4>
                                        <div class="form-group">
                                            <label>Icon (Font Awesome Class)</label>
                                            <input name="cards[{{ $index }}][icon]" type="text"
                                                class="card-icon"
                                                value="{{ old('cards.' . $index . '.icon', $card['icon']) }}" required />
                                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank"
                                                class="icon-link">View Font Awesome Icons</a>
                                            @error('cards.' . $index . '.icon')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="cards[{{ $index }}][title]" type="text"
                                                class="card-title"
                                                value="{{ old('cards.' . $index . '.title', $card['title']) }}"
                                                required />
                                            @error('cards.' . $index . '.title')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="cards[{{ $index }}][description]" class="card-description" required>{{ old('cards.' . $index . '.description', $card['description']) }}</textarea>
                                            @error('cards.' . $index . '.description')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" id="saveWhyUsBtn"><i class="fas fa-save"></i> Save Why Choose Us</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Testimonials Section -->
        <div class="overlay" id="editTestimonialsOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditTestimonialsOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Testimonials Section</h2>
                    <form id="editTestimonialsForm" method="POST" action="{{ route('admin.testimonials.update') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="error-message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group-section">
                            <h3>Section Content</h3>
                            <div class="form-group">
                                <label>Section Title</label>
                                <input id="editTestimonialsTitle" name="testimonials_title" type="text"
                                    value="{{ old('testimonials_title', $testimonialsTitle) }}" required />
                                @error('testimonials_title')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group-section">
                            <h3>Testimonials</h3>
                            <div class="form-group">
                                <label>Select Customer</label>
                                <select id="sortTestimonials" onchange="displayTestimonial()">
                                    <option value="">Select a customer</option>
                                </select>
                            </div>
                            <div id="testimonialsContainer">
                                <!-- Dynamically populated based on selected customer -->
                            </div>
                            <button type="button" id="addTestimonialBtn" onclick="addTestimonialField()"><i
                                    class="fas fa-plus"></i> Add New Testimonial</button>
                        </div>
                        <button type="submit" id="saveTestimonialsBtn"><i class="fas fa-save"></i> Save
                            Testimonials</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Special Offer Section -->
        <div class="overlay" id="editSpecialOfferOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditSpecialOfferOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Special Offer Section</h2>
                    <form id="editSpecialOfferForm" method="POST" action="{{ route('admin.special-offer.update') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="error-message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group-section">
                            <h3>Section Content</h3>
                            <div class="form-group">
                                <label>Section Title</label>
                                <input id="editSpecialOfferTitle" name="special_offer_title" type="text"
                                    value="{{ old('special_offer_title', $specialOfferTitle) }}" required />
                                @error('special_offer_title')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group-section">
                            <h3>Special Offer Items</h3>
                            <div class="form-group">
                                <label>Sort by Title</label>
                                <select id="sortSpecialOfferItems" onchange="displaySpecialOfferItem()">
                                    <option value="">Select an item</option>
                                </select>
                            </div>
                            <div id="specialOfferCardsContainer">
                                <!-- Dynamically populated based on selected item -->
                            </div>
                            <button type="button" id="addSpecialOfferCardBtn" onclick="addSpecialOfferCardField()"><i
                                    class="fas fa-plus"></i> Add New Special Offer Item</button>
                        </div>
                        <button type="submit" id="saveSpecialOfferBtn"><i class="fas fa-save"></i> Save Special
                            Offer</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Additional Sections -->
        <div class="overlay" id="editAdditionalSectionsOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditAdditionalSectionsOverlay()"><i
                        class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Additional Sections</h2>
                    <form id="editAdditionalSectionsForm" method="POST"
                        action="{{ route('admin.additional-sections.update') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="error-message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group-section">
                            <h3>Sections</h3>
                            <div class="form-group">
                                <label>Select Section</label>
                                <select id="sortAdditionalSectionsEdit" onchange="displayAdditionalSection()">
                                    <option value="">Select a section</option>
                                </select>
                            </div>
                            <div id="additionalSectionsContainer">
                                <!-- Dynamically populated based on selected section -->
                            </div>
                            <button type="button" id="addAdditionalSectionBtn" onclick="addAdditionalSectionField()"><i
                                    class="fas fa-plus"></i> Add New Section</button>
                        </div>
                        <button type="submit" id="saveAdditionalSectionsBtn"><i class="fas fa-save"></i> Save Additional
                            Sections</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Great+Vibes&display=swap"
            rel="stylesheet">
        <style>
            /* General Styles */
            .main-content {
                padding: 16px;
                background: radial-gradient(circle, #ffffff 0%, #f9faf9 100%);
                margin: 12px;
                border-radius: 10px;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            }

            /* Hero Section */
            .hero {
                padding: 16px;
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 16px;
                text-align: center;
            }

            .hero-content {
                max-width: 1000px;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                background: #e6f0e9;
                padding: 6px 12px;
                border-radius: 16px;
                font-size: 0.85em;
                color: #2a8b4e;
                margin-bottom: 12px;
            }

            .badge-icon {
                font-size: 1em;
            }

            .welcome-message {
                font-size: 1.8em;
                font-weight: 500;
                color: #1a3c34;
                line-height: 1.2;
                margin-bottom: 8px;
            }

            .welcome-message span {
                color: #2a8b4e;
                font-weight: 600;
            }

            .description {
                font-size: 0.95em;
                color: #4a5568;
                max-width: 700px;
                margin: 8px auto 12px;
                line-height: 1.6;
            }

            .cta {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
                justify-content: center;
                margin: 12px 0;
            }

            .btn {
                padding: 6px 12px;
                font-size: 0.85em;
                border-radius: 16px;
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                font-weight: 500;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
                text-transform: uppercase;
            }

            .btn.primary {
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
            }

            .btn.secondary {
                background: #ffffff;
                border: 1px solid #2a8b4e;
                color: #2a8b4e;
            }

            .btn:hover {
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .btn.primary:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
            }

            .btn.secondary:hover {
                background: #e6f0e9;
            }

            .btn-icon {
                font-size: 0.9em;
                transition: transform 0.2s ease;
            }

            .btn:hover .btn-icon {
                transform: translateX(4px);
            }

            .stats {
                display: flex;
                gap: 24px;
                justify-content: center;
                margin-top: 24px;
            }

            .stat {
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 4px;
            }

            .stat-icon {
                font-size: 1.5em;
                color: #2a8b4e;
                margin-bottom: 4px;
            }

            .stat-number {
                font-size: 1.4em;
                font-weight: 500;
                color: #1a3c34;
            }

            .stat div:last-child {
                font-size: 0.9em;
                color: #4a5568;
            }

            /* Why Choose Us Section */
            .why-us-section {
                padding: 16px;
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 16px;
                text-align: center;
            }

            .section-container {
                max-width: 1000px;
                margin: 0 auto;
            }

            .section-title {
                font-size: 1.8em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 16px;
                font-family: 'Great Vibes', cursive;
                text-align: center;
                position: relative;
                text-shadow: 1px 1px 3px rgba(47, 123, 62, 0.1);
            }

            .section-title1 {
                font-size: 1.8em;
                font-weight: 800;
                color: #1a3c34;
                margin-bottom: 16px;
                font-family: 'Great Vibes', cursive;
                position: relative;
                text-shadow: 1px 1px 3px rgba(47, 123, 62, 0.1);
            }
            .section-title::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 3px;
                background: #2a8b4e;
                border-radius: 2px;
            }

            .section:first-child .section-title::after {
                animation: pulse 3s infinite alternate;
            }

            @keyframes pulse {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0.7;
                }
            }

            .why-us-cards {
                display: flex;
                gap: 24px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .why-us-card {
                background: #f9faf9;
                padding: 16px;
                border-radius: 8px;
                border: 1px solid #e6f0e9;
                flex: 1;
                min-width: 200px;
                max-width: 300px;
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .why-us-card:hover {
                transform: scale(1.02);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .why-us-card i {
                font-size: 2em;
                color: #2a8b4e;
                margin-bottom: 8px;
            }

            .why-us-card h3 {
                font-size: 1.2em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 8px;
            }

            .why-us-card p {
                font-size: 0.9em;
                color: #4a5568;
                line-height: 1.6;
            }

            /* Testimonials Section */
            .testimonials-section {
                padding: 16px;
                background: linear-gradient(135deg, #f0f9f0 0%, #e6f7e6 100%);
                border-radius: 10px;
                margin-bottom: 16px;
            }

            .testimonial-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 24px;
                justify-content: center;
            }

            .testimonial-card {
                background: #ffffff;
                padding: 16px;
                border-radius: 8px;
                border: 1px solid #e6f0e9;
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                position: relative;
                overflow: hidden;
            }

            .testimonial-card:hover {
                transform: scale(1.02);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .testimonial-text {
                font-size: 0.9em;
                color: #4a5568;
                line-height: 1.6;
                margin-bottom: 12px;
            }

            .rating {
                color: #2a8b4e;
                font-size: 1.2em;
                margin-bottom: 8px;
            }

            .testimonial-author {
                font-size: 0.85em;
                color: #1a3c34;
                font-style: italic;
            }

            .testimonial-author::before {
                content: '\f007';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                margin-right: 0.5rem;
                color: #2a8b4e;
            }

            /* Special Offer Section */
            .special-offer-section {
                padding: 16px;
                background: linear-gradient(135deg, #f0f9f0 0%, #e6f7e6 100%);
                border-radius: 10px;
                margin-bottom: 16px;
            }

            .sort-controls {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                margin-bottom: 16px;
            }

            .sort-controls label {
                font-size: 0.85em;
                font-weight: 500;
                color: #1a3c34;
            }

            .sort-controls select {
                padding: 8px;
                border: 1px solid #b8d7bc;
                border-radius: 6px;
                font-size: 0.9em;
                color: #1a3c34;
                background: #ffffff;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .sort-controls select:focus {
                border-color: #3da65f;
                box-shadow: 0 0 0 2px rgba(61, 166, 95, 0.15);
                outline: none;
            }

            .special-offer-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 24px;
                justify-content: center;
            }

            .special-offer-card {
                background: #ffffff;
                padding: 16px;
                border-radius: 8px;
                border: 1px solid #e6f0e9;
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                position: relative;
                overflow: hidden;
            }

            .special-offer-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(to right, #2a8b4e, #3da65f);
                transform: scaleX(0);
                transition: transform 0.4s ease;
            }

            .special-offer-card:hover::before {
                transform: scaleX(1);
            }

            .special-offer-card:hover {
                transform: scale(1.02);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .special-offer-card h3 {
                font-size: 1.2em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .special-offer-card h3::before {
                content: '\f6c3';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                margin-right: 0.5rem;
                color: #2a8b4e;
            }

            .special-offer-card p {
                font-size: 0.9em;
                color: #4a5568;
                line-height: 1.6;
                margin-bottom: 8px;
            }

            .offer-price {
                font-size: 1em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .discount-price {
                color: #3da65f;
                font-weight: 600;
                margin-left: 0.5rem;
            }

            .discount-note {
                font-size: 0.85em;
                color: #4a5568;
                background: #f0f9f0;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                display: inline-block;
                margin-top: 8px;
            }

            /* Additional Sections */
            .additional-sections {
                padding: 16px;
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 16px;
                /* text-align: center; */
            }

            .sections-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 24px;
                justify-content: center;
            }

            .section-card {
                background: #f9faf9;
                padding: 16px;
                border-radius: 8px;
                border: 1px solid #e6f0e9;
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .section-card:hover {
                transform: scale(1.02);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .section-card h2 {
                font-size: 1.4em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 8px;
                font-family: 'Great Vibes', cursive;
                text-shadow: 1px 1px 3px rgba(47, 123, 62, 0.1);
            }

            .section-card p {
                font-size: 0.9em;
                color: #4a5568;
                line-height: 1.6;
                margin-bottom: 12px;
            }

            .section-link {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 6px 12px;
                font-size: 0.85em;
                font-weight: 500;
                color: #2a8b4e;
                text-decoration: none;
                border: 1px solid #2a8b4e;
                border-radius: 16px;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            }

            .section-link:hover {
                background: #e6f0e9;
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .section-link i {
                font-size: 0.9em;
                transition: transform 0.2s ease;
            }

            .section-link:hover i {
                transform: translateX(4px);
            }

            /* Actions */
            .actions {
                display: flex;
                justify-content: center;
                margin-top: 12px;
            }

            .edit-hero-btn,
            .edit-why-us-btn,
            .edit-testimonials-btn,
            .edit-special-offer-btn,
            .edit-additional-sections-btn {
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
            .edit-why-us-btn:hover,
            .edit-testimonials-btn:hover,
            .edit-special-offer-btn:hover,
            .edit-additional-sections-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            /* Overlay Styles */
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
                max-width: 500px;
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

            .form-section {
                background: #f9faf9;
                padding: 12px;
                border-radius: 8px;
            }

            .form-section h2 {
                font-size: 1.2em;
                font-weight: 500;
                color: #2a8b4e;
                margin-bottom: 12px;
            }

            .form-group-section {
                margin-bottom: 16px;
                padding: 12px;
                background: #ffffff;
                border-radius: 6px;
                border: 1px solid #e6f0e9;
            }

            .form-group-section h3 {
                font-size: 1em;
                font-weight: 500;
                color: #2a8b4e;
                margin-bottom: 12px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .form-group label {
                font-size: 0.85em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 6px;
                display: block;
            }

            .form-group select,
            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #b8d7bc;
                border-radius: 6px;
                font-size: 0.9em;
                color: #1a3c34;
                background: #ffffff;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .form-group select:focus,
            .form-group input:focus,
            .form-group textarea:focus {
                border-color: #3da65f;
                box-shadow: 0 0 0 2px rgba(61, 166, 95, 0.15);
                outline: none;
            }

            .form-group textarea {
                resize: vertical;
                min-height: 80px;
            }

            .form-section button {
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
                margin-top: 12px;
            }

            .form-section button:disabled {
                background: #b8d7bc;
                cursor: not-allowed;
            }

            .form-section button:hover:not(:disabled) {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .remove-testimonial-btn,
            .remove-special-offer-btn,
            .remove-section-btn {
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            }

            .remove-testimonial-btn:hover:not(:disabled),
            .remove-special-offer-btn:hover:not(:disabled),
            .remove-section-btn:hover:not(:disabled) {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            }

            .stat-group,
            .card-group,
            .testimonial-group,
            .special-offer-group,
            .section-group {
                border-top: 1px solid #e6f0e9;
                padding-top: 12px;
                margin-top: 12px;
            }

            .stat-group:first-child,
            .card-group:first-child,
            .testimonial-group:first-child,
            .special-offer-group:first-child,
            .section-group:first-child {
                border-top: none;
                padding-top: 0;
                margin-top: 0;
            }

            .stat-group h4,
            .card-group h4,
            .testimonial-group h4,
            .special-offer-group h4,
            .section-group h4 {
                font-size: 0.95em;
                font-weight: 500;
                color: #2a8b4e;
                margin-bottom: 8px;
            }

            .icon-link {
                display: inline-block;
                margin-top: 4px;
                font-size: 0.75em;
                color: #2a8b4e;
                text-decoration: none;
                transition: color 0.2s ease;
            }

            .icon-link:hover {
                color: #3da65f;
            }

            .error-message {
                color: #dc2626;
                font-size: 0.85em;
                margin-bottom: 12px;
            }

            /* Responsive Styles */
            @media (max-width: 1024px) {
                .main-content {
                    margin: 10px;
                    padding: 12px;
                }

                .stats,
                .why-us-cards,
                .testimonial-cards,
                .special-offer-cards,
                .sections-container {
                    gap: 16px;
                }
            }

            @media (max-width: 640px) {
                .main-content {
                    margin: 8px;
                    padding: 10px;
                }

                .welcome-message,
                .section-title {
                    font-size: 1.4em;
                }

                .description {
                    font-size: 0.9em;
                }

                .stats,
                .why-us-cards,
                .testimonial-cards,
                .special-offer-cards,
                .sections-container {
                    flex-direction: column;
                    gap: 12px;
                }

                .why-us-card,
                .testimonial-card,
                .special-offer-card,
                .section-card {
                    max-width: 100%;
                }

                .overlay-content {
                    width: 95%;
                    padding: 12px;
                }

                .form-section {
                    padding: 10px;
                }

                .form-section button {
                    padding: 6px;
                    font-size: 0.8em;
                }
            }

            @media (max-width: 480px) {
                .main-content {
                    margin: 4px;
                    padding: 8px;
                }

                .welcome-message,
                .section-title {
                    font-size: 1.2em;
                }

                .description {
                    font-size: 0.85em;
                }

                .btn,
                .section-link {
                    padding: 5px 10px;
                    font-size: 0.8em;
                }

                .edit-hero-btn,
                .edit-why-us-btn,
                .edit-testimonials-btn,
                .edit-special-offer-btn,
                .edit-additional-sections-btn {
                    padding: 5px 10px;
                    font-size: 0.8em;
                }

                .stats {
                    margin-top: 16px;
                }

                .stat-number {
                    font-size: 1.2em;
                }

                .stat div:last-child {
                    font-size: 0.85em;
                }

                .why-us-card,
                .testimonial-card,
                .special-offer-card,
                .section-card {
                    padding: 12px;
                }

                .why-us-card i {
                    font-size: 1.8em;
                }

                .why-us-card h3,
                .special-offer-card h3,
                .section-card h2 {
                    font-size: 1.1em;
                }

                .why-us-card p,
                .testimonial-text,
                .special-offer-card p,
                .section-card p {
                    font-size: 0.85em;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            let allTestimonials = [];
            let allSpecialOfferCards = [];
            let allAdditionalSections = [];

            function openEditHeroOverlay(badgeText, welcome, description, primaryCtaText, primaryCtaLink, secondaryCtaText,
                secondaryCtaLink, statsJson) {
                try {
                    closeAllOverlays();
                    document.getElementById('editBadgeText').value = badgeText || '';
                    document.getElementById('editWelcome').value = welcome || '';
                    document.getElementById('editHeroDescription').value = description || '';
                    document.getElementById('editPrimaryCtaText').value = primaryCtaText || '';
                    document.getElementById('editPrimaryCtaLink').value = primaryCtaLink || '';
                    document.getElementById('editSecondaryCtaText').value = secondaryCtaText || '';
                    document.getElementById('editSecondaryCtaLink').value = secondaryCtaLink || '';

                    let stats = [];
                    try {
                        stats = JSON.parse(statsJson) || [];
                    } catch (e) {
                        console.error('Error parsing statsJson:', e);
                        stats = [];
                    }

                    const statsContainer = document.getElementById('statsContainer');
                    const statGroups = statsContainer.querySelectorAll('.stat-group');
                    statGroups.forEach((group, index) => {
                        const iconInput = group.querySelector('.stat-icon');
                        const numberInput = group.querySelector('.stat-number');
                        const infoInput = group.querySelector('.stat-info');
                        if (index < stats.length) {
                            iconInput.value = stats[index].icon || stats[index].stat_icon || '';
                            numberInput.value = stats[index].number || stats[index].stat_number || '';
                            infoInput.value = stats[index].info || stats[index].stat_label || '';
                        } else {
                            iconInput.value = '';
                            numberInput.value = '';
                            infoInput.value = '';
                        }
                    });

                    document.getElementById('editHeroOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening hero overlay:', e);
                }
            }

            function closeEditHeroOverlay() {
                document.getElementById('editHeroOverlay').classList.remove('active');
                document.getElementById('editHeroForm').reset();
            }

            function openEditWhyUsOverlay(cardsJson) {
                try {
                    closeAllOverlays();
                    let cards = [];
                    try {
                        cards = JSON.parse(cardsJson) || [];
                    } catch (e) {
                        console.error('Error parsing cardsJson:', e);
                        cards = [];
                    }

                    const cardsContainer = document.getElementById('whyUsCardsContainer');
                    const cardGroups = cardsContainer.querySelectorAll('.card-group');
                    cardGroups.forEach((group, index) => {
                        const iconInput = group.querySelector('.card-icon');
                        const titleInput = group.querySelector('.card-title');
                        const descriptionInput = group.querySelector('.card-description');
                        if (index < cards.length) {
                            iconInput.value = cards[index].icon || '';
                            titleInput.value = cards[index].title || '';
                            descriptionInput.value = cards[index].description || '';
                        } else {
                            iconInput.value = '';
                            titleInput.value = '';
                            descriptionInput.value = '';
                        }
                    });

                    document.getElementById('editWhyUsOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening why us overlay:', e);
                }
            }

            function closeEditWhyUsOverlay() {
                document.getElementById('editWhyUsOverlay').classList.remove('active');
                document.getElementById('editWhyUsForm').reset();
            }

            function openEditTestimonialsOverlay(testimonialsJson, testimonialsTitle) {
                try {
                    closeAllOverlays();
                    allTestimonials = [];
                    try {
                        allTestimonials = JSON.parse(testimonialsJson) || [];
                    } catch (e) {
                        console.error('Error parsing testimonialsJson:', e);
                        allTestimonials = [];
                    }
                    document.getElementById('editTestimonialsTitle').value = testimonialsTitle || '';
                    populateTestimonialDropdown();
                    displayTestimonial();
                    document.getElementById('editTestimonialsOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening testimonials overlay:', e);
                }
            }

            function populateTestimonialDropdown() {
                const sortSelect = document.getElementById('sortTestimonials');
                sortSelect.innerHTML = '<option value="">Select a customer</option>';
                allTestimonials.forEach((testimonial, idx) => {
                    sortSelect.innerHTML += `<option value="${idx}">${testimonial.author || 'No Name'}</option>`;
                });
            }

            function displayTestimonial() {
                try {
                    const sortSelect = document.getElementById('sortTestimonials');
                    const selectedIndex = sortSelect.value;
                    const testimonialsContainer = document.getElementById('testimonialsContainer');
                    testimonialsContainer.innerHTML = '';

                    if (selectedIndex === '') return;

                    const testimonial = allTestimonials[selectedIndex];
                    testimonialsContainer.appendChild(createTestimonialGroup(selectedIndex, testimonial));
                } catch (e) {
                    console.error('Error displaying testimonial:', e);
                }
            }

            function createTestimonialGroup(index, testimonial = {
                text: '',
                rating: '',
                author: '',
                id: ''
            }) {
                const group = document.createElement('div');
                group.className = 'testimonial-group';
                group.dataset.index = index;
                group.innerHTML = `
                    <input type="hidden" name="testimonials[${index}][id]" value="${testimonial.id || ''}">
                    <h4>Testimonial ${parseInt(index) + 1}</h4>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea name="testimonials[${index}][text]" class="testimonial-text" required>${testimonial.text || ''}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Rating (1-5)</label>
                        <input name="testimonials[${index}][rating]" type="number" step="0.5" min="1" max="5" class="testimonial-rating" value="${testimonial.rating || ''}" required />
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <input name="testimonials[${index}][author]" type="text" class="testimonial-author" value="${testimonial.author || ''}" required />
                    </div>
                    <button type="button" class="remove-testimonial-btn" onclick="removeTestimonialField(${index})"><i class="fas fa-trash"></i> Remove Testimonial</button>
                `;
                return group;
            }

            function addTestimonialField() {
                try {
                    allTestimonials.push({
                        text: '',
                        rating: '',
                        author: '',
                        id: ''
                    });
                    populateTestimonialDropdown();
                    document.getElementById('sortTestimonials').value = allTestimonials.length - 1;
                    displayTestimonial();
                } catch (e) {
                    console.error('Error adding testimonial field:', e);
                }
            }

            function removeTestimonialField(index) {
                try {
                    allTestimonials.splice(index, 1);
                    populateTestimonialDropdown();
                    const sortSelect = document.getElementById('sortTestimonials');
                    sortSelect.value = allTestimonials.length > 0 ? 0 : '';
                    displayTestimonial();
                } catch (e) {
                    console.error('Error removing testimonial field:', e);
                }
            }

            function closeEditTestimonialsOverlay() {
                document.getElementById('editTestimonialsOverlay').classList.remove('active');
            }

            function sortSpecialOfferItems() {
                const sortSelect = document.getElementById('sortSpecialOffers');
                const sortOrder = sortSelect.value;
                const specialOfferCardsContainer = document.getElementById('specialOfferCards');
                const specialOfferCards = Array.from(specialOfferCardsContainer.getElementsByClassName('special-offer-card'));

                specialOfferCards.sort((a, b) => {
                    const titleA = a.dataset.title.toLowerCase();
                    const titleB = b.dataset.title.toLowerCase();
                    return sortOrder === 'asc' ? titleA.localeCompare(titleB) : titleB.localeCompare(titleA);
                });

                specialOfferCardsContainer.innerHTML = '';
                specialOfferCards.forEach(card => specialOfferCardsContainer.appendChild(card));
            }

            function openEditSpecialOfferOverlay(cardsJson, specialOfferTitle) {
                try {
                    closeAllOverlays();
                    allSpecialOfferCards = [];
                    try {
                        let parsed = JSON.parse(cardsJson) || [];
                        allSpecialOfferCards = parsed.map(card => typeof card === 'object' ? card : Object.assign({}, card));
                    } catch (e) {
                        console.error('Error parsing specialOfferCardsJson:', e);
                        allSpecialOfferCards = [];
                    }

                    document.getElementById('editSpecialOfferTitle').value = specialOfferTitle || '';
                    populateSpecialOfferDropdown();
                    displaySpecialOfferItem();
                    document.getElementById('editSpecialOfferOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening special offer overlay:', e);
                }
            }

            function closeEditSpecialOfferOverlay() {
                document.getElementById('editSpecialOfferOverlay').classList.remove('active');
                document.getElementById('editSpecialOfferForm').reset();
            }

            function populateSpecialOfferDropdown() {
                const sortSelect = document.getElementById('sortSpecialOfferItems');
                sortSelect.innerHTML = '<option value="">Select an item</option>';
                let sorted = [...allSpecialOfferCards].sort((a, b) => (a.title || '').localeCompare(b.title || ''));
                sorted.forEach((card, idx) => {
                    let title = card.title || 'No Title';
                    sortSelect.innerHTML += `<option value="${idx}">${title}</option>`;
                });
            }

            function syncAllSpecialOfferInputs() {
                const groups = document.querySelectorAll('.special-offer-group');
                groups.forEach((group, idx) => {
                    allSpecialOfferCards[idx].title = group.querySelector('.offer-title').value;
                    allSpecialOfferCards[idx].description = group.querySelector('.offer-description').value;
                    allSpecialOfferCards[idx].price = group.querySelector('.offer-price').value;
                    allSpecialOfferCards[idx].original_price = group.querySelector('.offer-original-price').value;
                    allSpecialOfferCards[idx].discount_code = group.querySelector('.offer-discount-code').value;
                    allSpecialOfferCards[idx].discount_percentage = group.querySelector('.offer-discount-percentage')
                        .value;
                });
            }

            document.getElementById('editSpecialOfferForm').addEventListener('submit', function(e) {
                syncAllSpecialOfferInputs();
            });

            function displaySpecialOfferItem() {
                const specialOfferCardsContainer = document.getElementById('specialOfferCardsContainer');
                specialOfferCardsContainer.innerHTML = '';
                const sortSelect = document.getElementById('sortSpecialOfferItems');
                const selectedIndex = sortSelect.value;

                if (selectedIndex === '') return;

                const card = allSpecialOfferCards[selectedIndex];
                specialOfferCardsContainer.appendChild(createSpecialOfferCardGroup(selectedIndex, card));
            }

            function createSpecialOfferCardGroup(index, card = {
                id: '',
                title: '',
                description: '',
                price: '',
                original_price: '',
                discount_code: '',
                discount_percentage: ''
            }) {
                const group = document.createElement('div');
                group.className = 'special-offer-group';
                group.dataset.index = index;
                group.innerHTML = `
                    <input type="hidden" name="special_offers[${index}][id]" value="${card.id || ''}">
                    <h4>Special Offer Item ${parseInt(index) + 1}</h4>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="special_offers[${index}][title]" type="text" class="offer-title" value="${card.title || ''}" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="special_offers[${index}][description]" class="offer-description" required>${card.description || ''}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Price (Rs)</label>
                        <input name="special_offers[${index}][price]" type="number" min="0" step="1" class="offer-price" value="${card.price || ''}" required />
                    </div>
                    <div class="form-group">
                        <label>Original Price (Rs, optional)</label>
                        <input name="special_offers[${index}][original_price]" type="number" min="0" step="1" class="offer-original-price" value="${card.original_price || ''}" />
                    </div>
                    <div class="form-group">
                        <label>Discount Code (optional)</label>
                        <input name="special_offers[${index}][discount_code]" type="text" class="offer-discount-code" value="${card.discount_code || ''}" />
                    </div>
                    <div class="form-group">
                        <label>Discount Percentage (%, optional)</label>
                        <input name="special_offers[${index}][discount_percentage]" type="number" min="0" max="100" step="1" class="offer-discount-percentage" value="${card.discount_percentage || ''}" />
                    </div>
                    <button type="button" class="remove-special-offer-btn" onclick="removeSpecialOfferCardField(${index})"><i class="fas fa-trash"></i> Remove Special Offer Item</button>
                `;

                group.querySelector('.offer-title').addEventListener('input', e => syncSpecialOfferInput(index, 'title', e
                    .target.value));
                group.querySelector('.offer-description').addEventListener('input', e => syncSpecialOfferInput(index,
                    'description', e.target.value));
                group.querySelector('.offer-price').addEventListener('input', e => syncSpecialOfferInput(index, 'price', e
                    .target.value));
                group.querySelector('.offer-original-price').addEventListener('input', e => syncSpecialOfferInput(index,
                    'original_price', e.target.value));
                group.querySelector('.offer-discount-code').addEventListener('input', e => syncSpecialOfferInput(index,
                    'discount_code', e.target.value));
                group.querySelector('.offer-discount-percentage').addEventListener('input', e => syncSpecialOfferInput(index,
                    'discount_percentage', e.target.value));

                return group;
            }

            function addSpecialOfferCardField() {
                allSpecialOfferCards.push({
                    title: '',
                    description: '',
                    price: '',
                    original_price: '',
                    discount_code: '',
                    discount_percentage: ''
                });
                populateSpecialOfferDropdown();
                document.getElementById('sortSpecialOfferItems').value = allSpecialOfferCards.length - 1;
                displaySpecialOfferItem();
            }

            function removeSpecialOfferCardField(index) {
                allSpecialOfferCards.splice(index, 1);
                populateSpecialOfferDropdown();
                const sortSelect = document.getElementById('sortSpecialOfferItems');
                sortSelect.value = allSpecialOfferCards.length > 0 ? 0 : '';
                displaySpecialOfferItem();
            }

            function sortAdditionalSections() {
                const sortSelect = document.getElementById('sortAdditionalSections');
                const sortOrder = sortSelect.value;
                const sectionsContainer = document.getElementById('sectionsContainer');
                const sectionCards = Array.from(sectionsContainer.getElementsByClassName('section-card'));

                sectionCards.sort((a, b) => {
                    const titleA = a.dataset.title.toLowerCase();
                    const titleB = b.dataset.title.toLowerCase();
                    return sortOrder === 'asc' ? titleA.localeCompare(titleB) : titleB.localeCompare(titleB);
                });

                sectionsContainer.innerHTML = '';
                sectionCards.forEach((card, index) => {
                    const titleElement = card.querySelector('.section-title');
                    titleElement.textContent = `Section ${index + 1}: ${card.dataset.title}`;
                    sectionsContainer.appendChild(card);
                });
            }

            function openEditAdditionalSectionsOverlay(sectionsJson) {
                try {
                    closeAllOverlays();
                    allAdditionalSections = [];
                    try {
                        allAdditionalSections = JSON.parse(sectionsJson) || [];
                    } catch (e) {
                        console.error('Error parsing additionalSectionsJson:', e);
                        allAdditionalSections = [];
                    }
                    populateAdditionalSectionsDropdown();
                    displayAdditionalSection();
                    document.getElementById('editAdditionalSectionsOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening additional sections overlay:', e);
                }
            }

            function closeEditAdditionalSectionsOverlay() {
                document.getElementById('editAdditionalSectionsOverlay').classList.remove('active');
                document.getElementById('editAdditionalSectionsForm').reset();
            }

            function populateAdditionalSectionsDropdown() {
                const sortSelect = document.getElementById('sortAdditionalSectionsEdit');
                sortSelect.innerHTML = '<option value="">Select a section</option>';
                let sorted = [...allAdditionalSections].sort((a, b) => (a.title || '').localeCompare(b.title || ''));
                sorted.forEach((section, idx) => {
                    let title = section.title || 'No Title';
                    sortSelect.innerHTML += `<option value="${idx}">${title}</option>`;
                });
            }

            function syncAllAdditionalSectionInputs() {
                const groups = document.querySelectorAll('.section-group');
                groups.forEach((group, idx) => {
                    allAdditionalSections[idx].title = group.querySelector('.section-title').value;
                    allAdditionalSections[idx].description = group.querySelector('.section-description').value;
                    allAdditionalSections[idx].link_text = group.querySelector('.section-link-text').value;
                    allAdditionalSections[idx].link_url = group.querySelector('.section-link-url').value;
                    allAdditionalSections[idx].icon = group.querySelector('.section-icon').value;
                    allAdditionalSections[idx].target = group.querySelector('.section-target').value;
                });
            }

            document.getElementById('editAdditionalSectionsForm').addEventListener('submit', function(e) {
                syncAllAdditionalSectionInputs();
            });

            function displayAdditionalSection() {
                const sectionsContainer = document.getElementById('additionalSectionsContainer');
                sectionsContainer.innerHTML = '';
                const sortSelect = document.getElementById('sortAdditionalSectionsEdit');
                const selectedIndex = sortSelect.value;

                if (selectedIndex === '') return;

                const section = allAdditionalSections[selectedIndex];
                sectionsContainer.appendChild(createAdditionalSectionGroup(selectedIndex, section));
            }

            function createAdditionalSectionGroup(index, section = {
                id: '',
                title: '',
                description: '',
                link_text: '',
                link_url: '',
                icon: '',
                target: ''
            }) {
                const group = document.createElement('div');
                group.className = 'section-group';
                group.dataset.index = index;
                group.innerHTML = `
                    <input type="hidden" name="sections[${index}][id]" value="${section.id || ''}">
                    <h4>Section ${parseInt(index) + 1}</h4>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="sections[${index}][title]" type="text" class="section-title" value="${section.title || ''}" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="sections[${index}][description]" class="section-description" required>${section.description || ''}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link Text</label>
                        <input name="sections[${index}][link_text]" type="text" class="section-link-text" value="${section.link_text || ''}" required />
                    </div>
                    <div class="form-group">
                        <label>Link URL</label>
                        <input name="sections[${index}][link_url]" type="url" class="section-link-url" value="${section.link_url || ''}" required />
                    </div>
                    <div class="form-group">
                        <label>Icon (Font Awesome Class)</label>
                        <input name="sections[${index}][icon]" type="text" class="section-icon" value="${section.icon || ''}" required />
                        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View Font Awesome Icons</a>
                    </div>
                    <div class="form-group">
                        <label>Target</label>
                        <select name="sections[${index}][target]" class="section-target">
                            <option value="" ${section.target === '' ? 'selected' : ''}>Same Tab</option>
                            <option value="_blank" ${section.target === '_blank' ? 'selected' : ''}>New Tab</option>
                        </select>
                    </div>
                    <button type="button" class="remove-section-btn" onclick="removeAdditionalSectionField(${index})"><i class="fas fa-trash"></i> Remove Section</button>
                `;

                group.querySelector('.section-title').addEventListener('input', e => syncAdditionalSectionInput(index, 'title',
                    e.target.value));
                group.querySelector('.section-description').addEventListener('input', e => syncAdditionalSectionInput(index,
                    'description', e.target.value));
                group.querySelector('.section-link-text').addEventListener('input', e => syncAdditionalSectionInput(index,
                    'link_text', e.target.value));
                group.querySelector('.section-link-url').addEventListener('input', e => syncAdditionalSectionInput(index,
                    'link_url', e.target.value));
                group.querySelector('.section-icon').addEventListener('input', e => syncAdditionalSectionInput(index, 'icon', e
                    .target.value));
                group.querySelector('.section-target').addEventListener('change', e => syncAdditionalSectionInput(index,
                    'target', e.target.value));

                return group;
            }

            function syncAdditionalSectionInput(index, field, value) {
                allAdditionalSections[index][field] = value;
                populateAdditionalSectionsDropdown();
            }

            function addAdditionalSectionField() {
                allAdditionalSections.push({
                    id: '',
                    title: '',
                    description: '',
                    link_text: '',
                    link_url: '',
                    icon: '',
                    target: ''
                });
                populateAdditionalSectionsDropdown();
                document.getElementById('sortAdditionalSectionsEdit').value = allAdditionalSections.length - 1;
                displayAdditionalSection();
            }

            function removeAdditionalSectionField(index) {
                allAdditionalSections.splice(index, 1);
                populateAdditionalSectionsDropdown();
                const sortSelect = document.getElementById('sortAdditionalSectionsEdit');
                sortSelect.value = allAdditionalSections.length > 0 ? 0 : '';
                displayAdditionalSection();
            }

            function closeAllOverlays() {
                document.querySelectorAll('.overlay').forEach(overlay => {
                    overlay.classList.remove('active');
                });
            }
        </script>
    @endpush
@endsection
