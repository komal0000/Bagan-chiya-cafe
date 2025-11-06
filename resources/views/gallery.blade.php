<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery - Bagan Chiya Cafe</title>
    @include('layouts.links')
    <link href="{{ asset('css/gallery.css') }}?ver={{ config('app.asset_version') }}" rel="stylesheet">

</head>

<body>
    @include('layouts.header')
    <section class="gallery-hero">
        <div class="hero-content">
            <h1>{{ $heroSettings->title ?? 'Our Gallery' }}</h1>
            <h1><span>{{ $heroSettings->subtitle ?? 'Stories in Every Frame' }}</span></h1>
            <p>
                {{ $heroSettings->description ?? 'Explore the visual journey of Bagan Chiya Cafe, capturing the essence of our tea heritage and community through stunning photography.' }}
            </p>
        </div>
    </section>

    <section class="photo-gallery">
        <div class="photo-gallery__container">
            <div class="photo-gallery__header">
                <h1 class="photo-gallery__title">{{ $headerSettings->title ?? 'Tea Garden Gallery' }}</h1>
                <p class="photo-gallery__subtitle">{{ $headerSettings->description ?? 'Discover the beauty of our tea journey through captivating moments from our gardens, ceremonies, and community gatherings' }}</p>
                <div class="photo-gallery__filters">
                    <button class="photo-gallery__filter-btn active" data-filter="all">All Photos</button>
                    @foreach ($categories as $category)
                        <button class="photo-gallery__filter-btn" data-filter="{{ $category }}">
                            {{ ucfirst($category) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="photo-gallery__grid" id="photo-gallery-grid">
                @foreach ($galleries as $index => $gallery)
                    <div class="photo-gallery__item" data-category="{{ $gallery->category }}"
                        data-index="{{ $index }}">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}">
                        <div class="photo-gallery__overlay">
                            <div class="photo-gallery__overlay-content">
                                <h3>{{ $gallery->title }}</h3>
                                <p>{{ $gallery->description ?? 'A beautiful moment captured at Bagan Chiya Cafe.' }}</p>
                                <div class="photo-gallery__overlay-tags">
                                    <span class="photo-gallery__tag">{{ ucfirst($gallery->category) }}</span>
                                    @if ($gallery->is_featured)
                                        <span class="photo-gallery__tag">Featured</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($galleries->isEmpty())
                <div style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-images" style="font-size: 4em; color: #ccc; margin-bottom: 20px;"></i>
                    <h3 style="color: #666; margin-bottom: 10px;">No images yet</h3>
                    <p style="color: #999;">Check back soon for beautiful moments from our cafe!</p>
                </div>
            @endif

            <button class="photo-gallery__load-more" id="load-more-btn" style="display: none;">
                <span>Load More Photos</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="photo-gallery__load-more">
                <button class="photo-gallery__load-more-btn" onclick="loadMorePhotos()">
                    <i class="fas fa-plus"></i> Show more
                </button>
                <button class="photo-gallery__unload-btn hidden" onclick="unloadPhotos()">
                    <i class="fas fa-minus"></i> Show less
                </button>
            </div>

            <div class="photo-gallery__lightbox" id="photo-gallery-lightbox">
                <button class="photo-gallery__close-btn" onclick="closeLightbox()">
                    <i class="fas fa-times"></i>
                </button>
                <button class="photo-gallery__nav-btn photo-gallery__prev-btn" onclick="changeImage(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="photo-gallery__nav-btn photo-gallery__next-btn" onclick="changeImage(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="photo-gallery__lightbox-content">
                    <img src="" alt="Lightbox Image" id="photo-gallery-lightbox-img">
                    <div class="photo-gallery__lightbox-info" id="photo-gallery-lightbox-info">
                        <h3 id="photo-gallery-lightbox-title"></h3>
                        <p id="photo-gallery-lightbox-description"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bagan-chiya-cafe">
        <div class="container">
            <header class="header">
                <div class="header-icons">
                    <i class="fas fa-camera camera-icon"></i>
                    <h1 class="header-title">Share Your Photos</h1>
                    <i class="fas fa-camera camera-icon"></i>
                </div>
                <p class="header-description">
                    Showcase your love for Bagan Chiya Cafe! Share your beautiful moments with a story
                    and be featured in our community gallery.
                </p>
            </header>

            <form class="form" action="/submit" method="POST" enctype="multipart/form-data">
                <div class="form-left">
                    <div class="form-group">
                        <label class="label">
                            <i class="fas fa-file-alt label-icon"></i>
                            Photo Title
                        </label>
                        <input type="text" class="input" placeholder="Give your photo a creative title"
                            name="title" required>
                    </div>
                    <div class="form-group">
                        <label class="label">
                            <i class="fas fa-user label-icon"></i>
                            Your Name
                        </label>
                        <input type="text" class="input" placeholder="Enter your name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="label">Tell us about this moment</label>
                        <textarea class="textarea"
                            placeholder="Describe your experience, the tea you enjoyed, or what made this moment special..." name="description"
                            required></textarea>
                    </div>
                </div>
                <div class="upload-section">
                    <label class="label">
                        <i class="fas fa-image label-icon"></i>
                        Upload Your Photo
                    </label>
                    <div class="upload-area" onclick="this.querySelector('input').click()">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="upload-text">Drop your photo here or click to browse</p>
                        <p class="upload-subtext">PNG, JPG up to 10MB</p>
                        <input type="file" name="photo" accept="image/*" style="display: none;" required>
                    </div>
                </div>
                <div class="submit-btn-container">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-upload btn-icon"></i>
                        SHARE MY PHOTO
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="cta-section">
        <h2>Visit Bagan Chiya Cafe</h2>
        <p>Experience our delicious offerings and join our community of tea lovers. Subscribe to our newsletter for
            exclusive offers and updates!</p>
        <a href="https://www.facebook.com/p/Bagan-%E0%A4%9A%E0%A4%BF%E0%A4%AF%E0%A4%BE-Cafe-61564573427193/?_rdr"
            target="_blank" class="cta-button">
            Join Our Community
        </a>


    </section>
    @include('layouts.footer')


    <script>
        document.querySelector('.bagan-chiya-cafe .upload-area').addEventListener('click', function() {
            this.querySelector('input').click();
        });
    </script>
    <script src="{{ asset('js/app.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('js/gallery.js') }}?ver={{ config('app.asset_version') }}"></script>

</body>

</html>
