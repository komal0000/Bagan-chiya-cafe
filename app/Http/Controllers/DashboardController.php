<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardHero;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $hero = \App\Models\DashboardHero::first();
        $stats = \App\Models\Dashboard::all();

        $whyUsCards = \App\Models\WhyUsCard::all();
        $whyUsHeading = $whyUsCards->first()->heading ?? 'Why Choose Us';

        // Fetch testimonials and section title
        $testimonials = \App\Models\Testimonial::all();
        $testimonialsTitle = $testimonials->first()->section_title ?? 'What Our Customers Say';

        // Fetch special offers and section title
        $specialOfferCards = \App\Models\SpecialOffer::all();
        $specialOfferTitle = $specialOfferCards->first()->section_title ?? 'Special Offer';

        // Fetch gallery section
        $gallerySection = \App\Models\HomeGallerySection::first();
        $gallery = \App\Models\Gallery::all();

        // Fetch owner words section
        $ownerWords = \App\Models\OwnerWordsSection::first();


        // dd($gallery);
        return view('welcome', [
            'hero' => $hero,
            'stats' => $stats,
            'whyUsCards' => $whyUsCards,
            'whyUsHeading' => $whyUsHeading,
            'testimonials' => $testimonials,
            'testimonialsTitle' => $testimonialsTitle,
            'specialOfferCards' => $specialOfferCards,
            'specialOfferTitle' => $specialOfferTitle,
            'gallerySection' => $gallerySection,
            'gallery' => $gallery,
            'ownerWords' => $ownerWords,
        ]);
    }
}
