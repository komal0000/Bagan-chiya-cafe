     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
     <section class="tea-gallery-section">
         <div class="section-container">
             <!-- Title -->
             <h2 class="section-title">
                 <i class="fas fa-leaf icon"></i>
                 {{ $gallerySection->title ?? 'Crafting Moments Since 2081' }}
             </h2>
             <p class="section-subtitle">{{ $gallerySection->subtitle ?? 'Experience the journey from leaf to cup' }}</p>

             <!-- Enhanced Gallery -->
             <div class="enhanced-gallery">
                 <div class="tea-gallery-slider">
                     @if(isset($gallery) && count($gallery) > 0)
                         @foreach($gallery->take(6) as $item)
                             <div class="gallery-item">
                                 <img src="{{  asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}">
                                 <div class="gallery-overlay">
                                     <h3>{{ $item->title }}</h3>
                                     <p>{{ $item->description }}</p>
                                     <p class="date">{{ $item->created_at->format('F d, Y') }}</p>
                                     <button class="view-details-btn"
                                         onclick="openLightbox('{{  asset('storage/' . $item->image_path) }}', '{{ $item->title }}', '{{ $item->description }}', '{{ $item->created_at->format('F d, Y') }}')">
                                         <i class="fas fa-eye"></i>
                                         View Details
                                     </button>
                                 </div>
                             </div>
                         @endforeach
                     @else
                         <div class="gallery-item">
                             <img src="https://res.cloudinary.com/dzdinuw5d/image/upload/v1754038926/WhatsApp_Image_2025-07-31_at_6.28.54_PM_1_tiivhu.jpg"
                                 alt="Tea Picking">
                             <div class="gallery-overlay">
                                 <h3>Tea Picking</h3>
                                 <p>Crafting perfection in the fields</p>
                                 <p class="date">August 02, 2025</p>
                                 <button class="view-details-btn"
                                     onclick="openLightbox('https://res.cloudinary.com/dzdinuw5d/image/upload/v1754038926/WhatsApp_Image_2025-07-31_at_6.28.54_PM_1_tiivhu.jpg', 'Tea Picking', 'Crafting perfection in the fields', 'August 02, 2025')">
                                     <i class="fas fa-eye"></i>
                                     View Details
                                 </button>
                             </div>
                         </div>
                     @endif
                 </div>
             </div>
             <!-- View All Button -->
             <div class="btn-container">
                 <button class="view-all-btn">
                     <a href="{{ $gallerySection->button_link ?? route('gallery') }}" style="text-decoration: none; color: inherit;">
                         <i class="fas fa-leaf"></i>
                         <span style="margin-left: 6px;">{{ $gallerySection->button_text ?? 'View All Images' }}</span>
                     </a>
                 </button>
             </div>
             <!-- Enhanced Lightbox -->
             <div class="lightbox" id="lightbox" onclick="closeLightbox()">
                 <button class="close-btn" onclick="closeLightbox()">
                     <i class="fas fa-times"></i>
                 </button>
                 <div class="lightbox-content" onclick="event.stopPropagation()">
                     <img id="lightbox-img" src="" alt="">
                     <div class="lightbox-info">
                         <h3 id="lightbox-title"></h3>
                         <p id="lightbox-description"></p>
                         <p class="date" id="lightbox-date"></p>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section class="owner-words-section section">
         <div class="section-container">
             <h2 class="section-title">{{ $ownerWords->title ?? 'Words From Our Founder' }}</h2>
             <div class="owner-content">
                 <img src="{{ $ownerWords->photo_url ?? 'https://res.cloudinary.com/dzdinuw5d/image/upload/v1754038926/WhatsApp_Image_2025-07-31_at_6.28.54_PM_1_tiivhu.jpg' }}"
                     alt="Founder of Bagan Chiya Cafe" class="owner-photo">
                 <div class="owner-text">
                     <p>"{{ $ownerWords->quote ?? 'At Bagan Chiya Cafe, we pour our heart into every cup. Our mission is to share the rich tea culture of Nepal with the world, using only the finest ingredients. Come join us for a taste of tradition!' }}"
                     </p>
                     <p class="owner-signature">{{ $ownerWords->signature ?? '- Sandip Giree, Founder' }}</p>
                 </div>
             </div>
         </div>
     </section>
     <section class="why-us-section section">
         <div class="section-container">
             <h2 class="section-title">{{ $whyUsHeading ?? 'Why Choose Us' }}</h2>
             <div class="why-us-cards">
                 @if (isset($whyUsCards) && count($whyUsCards) > 0)
                     @foreach ($whyUsCards as $card)
                         <div class="why-us-card">
                             <i class="fas {{ $card->icon }}"></i>
                             <h3>{{ $card->title }}</h3>
                             <p>{{ $card->description }}</p>
                         </div>
                     @endforeach
                 @else
                     <div class="why-us-card">
                         <i class="fas fa-leaf"></i>
                         <h3>Organic Ingredients</h3>
                         <p>We use only the finest organic teas and herbs sourced locally.</p>
                     </div>
                     <div class="why-us-card">
                         <i class="fas fa-smile"></i>
                         <h3>Friendly Service</h3>
                         <p>Our staff ensures a warm and welcoming experience every time.</p>
                     </div>
                     <div class="why-us-card">
                         <i class="fas fa-heart"></i>
                         <h3>Authentic Taste</h3>
                         <p>Experience the true essence of Nepali tea culture.</p>
                     </div>
                 @endif
             </div>
         </div>
     </section>

     <section class="testimonials-section section">
         <div class="section-container">
             <h2 class="section-title">{{ $testimonialsTitle ?? 'What Our Customers Say' }}</h2>
             <div class="testimonial-cards">
                 @if (isset($testimonials) && count($testimonials) > 0)
                     @foreach ($testimonials as $testimonial)
                         <div class="testimonial-card">
                             <p class="testimonial-text">{!! nl2br(e($testimonial->text)) !!}</p>
                             <div class="rating">
                                 @for ($i = 1; $i <= 5; $i++)
                                     @if ($i <= floor($testimonial->rating))
                                         <i class="fas fa-star"></i>
                                     @elseif($i == ceil($testimonial->rating) && $testimonial->rating - floor($testimonial->rating) >= 0.5)
                                         <i class="fas fa-star-half-alt"></i>
                                     @else
                                         <i class="far fa-star"></i>
                                     @endif
                                 @endfor
                             </div>
                             <p class="testimonial-author">- {{ $testimonial->author }}</p>
                         </div>
                     @endforeach
                 @else
                     <div class="testimonial-card">
                         <p class="testimonial-text">No testimonials yet.</p>
                     </div>
                 @endif
             </div>
         </div>
     </section>


     <section class="tea-section section">
         <div class="section-container">
             <h2 class="section-title">{{ $specialOfferTitle ?? 'Special Offer' }}</h2>
             <div class="tea-cards">
                 @if (isset($specialOfferCards) && count($specialOfferCards) > 0)
                     @foreach ($specialOfferCards as $card)
                         <div class="tea-card">
                             <h3>{{ $card->title }}</h3>
                             <p>{{ $card->description }}</p>
                             <p class="teaprice">
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
                 @else
                     <div class="tea-card">
                         <h3>No Special Offers</h3>
                         <p>Please check back later for exciting deals!</p>
                     </div>
                 @endif
             </div>
         </div>
     </section>



     <section class="additional-sections section">
         <div class="section-container">
             <div class="sections-container">
                 <div class="section-card menu-section">
                     <h2 class="section-title">Explore Our Menu</h2>
                     <p>Discover a variety of teas, snacks, and more crafted with love.</p>
                     <a href="{{ route('menu') }}" class="section-link">View Menu <i
                             class="fas fa-arrow-right"></i></a>
                 </div>
                 <div class="section-card events-section">
                     <h2 class="section-title">Upcoming Events</h2>
                     <p>Join us for tea tasting and cultural events this month!</p>
                     <a href="https://www.instagram.com/bagan_chiya/?hl=en" class="section-link">See Events <i
                             class="fas fa-calendar" target="_blank"></i></a>
                 </div>
             </div>
         </div>
     </section>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
     <script>
         $(document).ready(function() {
             $('.tea-gallery-slider').slick({
                 slidesToShow: 4,
                 slidesToScroll: 1,
                 autoplay: true,
                 autoplaySpeed: 4000,
                 pauseOnHover: true,
                 arrows: true,
                 dots: true,
                 infinite: true,
                 speed: 600,
                 cssEase: 'ease',
                 responsive: [{
                         breakpoint: 1024,
                         settings: {
                             slidesToShow: 4,
                             slidesToScroll: 1
                         }
                     },
                     {
                         breakpoint: 768,
                         settings: {
                             slidesToShow: 2,
                             slidesToScroll: 1
                         }
                     },
                     {
                         breakpoint: 480,
                         settings: {
                             slidesToShow: 1,
                             slidesToScroll: 1
                         }
                     }
                 ]
             });

             // stagger animation to gallery items
             $('.tea-gallery-section .gallery-item').each(function(index) {
                 $(this).css('animation-delay', `${index * 0.1}s`);
             });

             // Intersection Observer for animation
             const observerOptions = {
                 threshold: 0.1,
                 rootMargin: '0px 0px -50px 0px'
             };

             const observer = new IntersectionObserver(function(entries) {
                 entries.forEach(entry => {
                     if (entry.isIntersecting) {
                         entry.target.style.animationPlayState = 'running';
                     }
                 });
             }, observerOptions);

             $('.tea-gallery-section .gallery-item').each(function() {
                 this.style.animationPlayState = 'paused';
                 observer.observe(this);
             });
         });

         // Lightbox functionality
         function openLightbox(src, title, description, date) {
             const lightbox = document.getElementById('lightbox');
             const img = document.getElementById('lightbox-img');
             const titleEl = document.getElementById('lightbox-title');
             const descEl = document.getElementById('lightbox-description');
             const dateEl = document.getElementById('lightbox-date');

             img.src = src;
             titleEl.textContent = title;
             descEl.textContent = description;
             dateEl.textContent = date;

             lightbox.classList.add('active');
             document.body.style.overflow = 'hidden';
         }

         function closeLightbox() {
             const lightbox = document.getElementById('lightbox');
             lightbox.classList.remove('active');
             document.body.style.overflow = 'auto';
         }

         // Handle escape key for lightbox
         document.addEventListener('keydown', function(e) {
             if (e.key === 'Escape') {
                 closeLightbox();
             }
         });
     </script>
