@extends('admin.layouts.base')

@section('page-title', 'Our Story Management')

@section('breadcrumb')
    <i class="fas fa-chevron-right"></i>
    <span>Our Story</span>
@endsection

@section('content')
    <div class="main-content">
        <!-- Story Hero Section -->
        <section class="story-section-wrapper">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="section-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h2 class="section-title">Hero Section</h2>
                        <p class="section-subtitle">Main banner content for the story page</p>
                    </div>
                </div>
            </div>
            <div class="story-hero">
                <div class="hero-content">
                    <div class="badge">
                        <i class="fas fa-leaf badge-icon"></i>
                        <span id="badgeText">{{ $badgeText ?? 'Since Mangsir • Born in Damak' }}</span>
                    </div>
                    <h1>{{ $heroTitle ?? 'Our Story' }}<span>{{ $heroSubtitle ?? 'Bagan Chiya Cafe' }}</span></h1>
                    <p>{{ $heroDescription ?? 'From the heart of Damak to your cup - discover the passionate journey of Bagan Chiya Cafe, where authentic Nepali tea culture meets modern innovation and community spirit.' }}</p>
                    <div class="actions">
                        <button class="edit-hero-btn"
                            onclick="openEditHeroOverlay('{{ e($badgeText ?? 'Since Mangsir • Born in Damak') }}', '{{ e($heroTitle ?? 'Our Story') }}', '{{ e($heroSubtitle ?? 'Bagan Chiya Cafe') }}', '{{ e($heroDescription ?? 'From the heart of Damak to your cup - discover the passionate journey of Bagan Chiya Cafe, where authentic Nepali tea culture meets modern innovation and community spirit.') }}')">
                            <i class="fas fa-edit"></i> Edit Hero
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Story Content Section -->
        <section class="story-content">
            <div class="story-container">
                <!-- Journey Section -->
                <div class="story-section-wrapper">
                    <div class="section-header">
                        <div class="section-header-left">
                            <div class="section-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <div>
                                <h2 class="section-title">Journey Section</h2>
                                <p class="section-subtitle">Beginning of the story</p>
                            </div>
                        </div>
                        <button class="edit-journey-btn" onclick="openEditJourneyOverlay('{{ e($journeyTitle ?? 'The Journey Begins') }}', '{{ e($journeyIntro ?? 'Every great story has humble beginnings. Ours started in the vibrant town of Damak, where the aroma of fresh tea leaves and the warmth of community spirit inspired us to create something extraordinary.') }}')">
                            <i class="fas fa-edit"></i> Edit Journey
                        </button>
                    </div>
                    <div class="journey-section">
                        <h2 class="section-title">{{ $journeyTitle ?? 'The Journey Begins' }}</h2>
                        <p class="journey-intro">{{ $journeyIntro ?? 'Every great story has humble beginnings. Ours started in the vibrant town of Damak, where the aroma of fresh tea leaves and the warmth of community spirit inspired us to create something extraordinary.' }}</p>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="story-section-wrapper">
                    <div class="section-header">
                        <div class="section-header-left">
                            <div class="section-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h2 class="section-title">Timeline</h2>
                                <p class="section-subtitle">Key milestones in our journey</p>
                            </div>
                        </div>
                        <button class="add-timeline-btn" onclick="openAddTimelineOverlay()"><i class="fas fa-plus"></i> Add Timeline Item</button>
                    </div>
                    <div class="timeline">
                    @if (isset($timelineItems) && $timelineItems->count() > 0)
                        @foreach ($timelineItems as $item)
                            <div class="timeline-item">
                                <div class="year">{{ $item->year }}</div>
                                <div class="title">{{ $item->location }}</div>
                                <p class="description">{{ $item->description }}</p>
                                @if($item->link)
                                    <a href="{{ $item->link }}" class="visit">Visit</a>
                                @endif
                                <div class="actions">
                                    <button class="edit-timeline-btn"
                                        onclick="openEditTimelineOverlay('{{ $item->id }}', '{{ e($item->year) }}', '{{ e($item->location) }}', '{{ e($item->description) }}', '{{ e($item->link) }}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.story.timeline.destroy', $item) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn"
                                            onclick="return confirm('Delete this timeline item?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="no-items">No timeline items found. Add a new item to get started.</p>
                    @endif
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="story-section-wrapper">
                    <div class="section-header">
                        <div class="section-header-left">
                            <div class="section-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div>
                                <h2 class="section-title">Our Mission</h2>
                                <p class="section-subtitle">Our purpose and goals</p>
                            </div>
                        </div>
                        <button class="edit-mission-btn" onclick="openEditMissionOverlay('{{ e($missionTitle ?? 'Our Mission') }}', '{{ e($missionText ?? 'We are dedicated to preserving Nepal\'s tea heritage while building sustainable futures for our farming communities. Through every cup, we connect tea lovers worldwide to the authentic flavors of the Himalayas.') }}')">
                            <i class="fas fa-edit"></i> Edit Mission
                        </button>
                    </div>
                    <div class="mission-section">
                        <div class="mission-content">
                            <h2 class="section-title">{{ $missionTitle ?? 'Our Mission' }}</h2>
                            <p>{{ $missionText ?? 'We are dedicated to preserving Nepal\'s tea heritage while building sustainable futures for our farming communities. Through every cup, we connect tea lovers worldwide to the authentic flavors of the Himalayas.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Values Section -->
                <div class="story-section-wrapper">
                    <div class="section-header">
                        <div class="section-header-left">
                            <div class="section-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div>
                                <h2 class="section-title">{{ $valuesTitle ?? 'Our Values' }}</h2>
                                <p class="section-subtitle">Core principles that guide us</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button class="edit-values-title-btn" onclick="openEditValuesTitleOverlay('{{ e($valuesTitle ?? 'Our Values') }}')">
                                <i class="fas fa-edit"></i> Edit Title
                            </button>
                            <button class="add-value-btn" onclick="openAddValueOverlay()"><i class="fas fa-plus"></i> Add Value</button>
                        </div>
                    </div>
                    <div class="values-section">
                    <div class="values-grid">
                        @if (isset($values) && $values->count() > 0)
                            @foreach ($values as $value)
                                <div class="value-card" data-icon="{{ $value->icon }}" data-title="{{ e($value->title) }}" data-description="{{ e($value->description) }}">
                                    <div class="value-icon">
                                        <i class="fas {{ $value->icon }}"></i>
                                    </div>
                                    <h3>{{ $value->title }}</h3>
                                    <p>{{ $value->description }}</p>
                                    <div class="actions">
                                        <button class="edit-value-btn"
                                            onclick="openEditValueOverlay('{{ $value->id }}', '{{ e($value->icon) }}', '{{ e($value->title) }}', '{{ e($value->description) }}')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.story.values.destroy', $value) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"
                                                onclick="return confirm('Delete this value?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-items">No values found. Add a new value to get started.</p>
                        @endif
                    </div>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="story-section-wrapper">
                    <div class="section-header">
                        <div class="section-header-left">
                            <div class="section-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h2 class="section-title">{{ $teamTitle ?? 'Meet Our Team' }}</h2>
                                <p class="section-subtitle">{{ $teamIntro ?? 'The passionate individuals behind every perfect cup' }}</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button class="edit-team-title-btn" onclick="openEditTeamTitleOverlay('{{ e($teamTitle ?? 'Meet Our Team') }}', '{{ e($teamIntro ?? 'The passionate individuals behind every perfect cup, dedicated to sharing Nepal\'s tea culture with the world.') }}')">
                                <i class="fas fa-edit"></i> Edit Title & Intro
                            </button>
                            <button class="add-team-btn" onclick="openAddTeamOverlay()">
                                <i class="fas fa-plus"></i> Add Team Member
                            </button>
                        </div>
                    </div>
                    <div class="team-section">
                    <div class="team-grid">
                        @if (isset($teamMembers) && $teamMembers->count() > 0)
                            @foreach ($teamMembers as $member)
                                <div class="team-card" data-icon="{{ $member->icon }}" data-title="{{ e($member->title) }}" data-description="{{ e($member->description) }}">
                                    <div class="team-avatar">
                                        <i class="fas {{ $member->icon }}"></i>
                                    </div>
                                    <h3>{{ $member->title }}</h3>
                                    <p>{{ $member->description }}</p>
                                    <div class="actions">
                                        <button class="edit-team-btn"
                                            onclick="openEditTeamOverlay('{{ $member->id }}', '{{ e($member->icon) }}', '{{ e($member->title) }}', '{{ e($member->description) }}')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.story.team.destroy', $member) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"
                                                onclick="return confirm('Delete this team member?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-items">No team members found. Add a new team member to get started.</p>
                        @endif
                    </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="story-section-wrapper">
                    <div class="section-header">
                        <div class="section-header-left">
                            <div class="section-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h2 class="section-title">Call to Action</h2>
                                <p class="section-subtitle">Encourage visitors to take action</p>
                            </div>
                        </div>
                        <button class="edit-cta-btn" onclick="openEditCtaOverlay('{{ e($ctaTitle ?? 'Visit Us in Damak') }}', '{{ e($ctaDescription ?? 'Experience the authentic taste of Nepal\'s finest teas in the heart of where our story began.') }}', '{{ e($ctaLink ?? asset('')) }}', '{{ e($ctaButtonText ?? 'Back to Home') }}')">
                            <i class="fas fa-edit"></i> Edit CTA
                        </button>
                    </div>
                    <div class="cta-section">
                    <h2 class="section-title">{{ $ctaTitle ?? 'Visit Us in Damak' }}</h2>
                    <p class="journey-intro">{{ $ctaDescription ?? 'Experience the authentic taste of Nepal\'s finest teas in the heart of where our story began.' }}</p>
                    <a href="{{ $ctaLink ?? asset('') }}" class="btn-enhanced">
                        <i class="fas fa-home"></i>
                        <span>{{ $ctaButtonText ?? 'Back to Home' }}</span>
                    </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Overlay for Edit Hero Section -->
        <div class="overlay" id="editHeroOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditHeroOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Hero Section</h2>
                    <form id="editHeroForm" method="POST" action="{{ route('admin.story.hero.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Badge Text</label>
                            <input id="editBadgeText" name="badge_text" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input id="editHeroTitle" name="hero_title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input id="editHeroSubtitle" name="hero_subtitle" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editHeroDescription" name="hero_description" required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Hero</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Journey Section -->
        <div class="overlay" id="editJourneyOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditJourneyOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Journey Section</h2>
                    <form id="editJourneyForm" method="POST" action="{{ route('admin.story.journey.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Journey Title</label>
                            <input id="editJourneyTitle" name="journey_title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Journey Introduction</label>
                            <textarea id="editJourneyIntro" name="journey_intro" required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Journey</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Add Timeline Item -->
        <div class="overlay" id="addTimelineOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeAddTimelineOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Add Timeline Item</h2>
                    <form method="POST" action="{{ route('admin.story.timeline.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="year" placeholder="e.g., 2022" required />
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" placeholder="e.g., Born in Damak" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" placeholder="e.g., In the heart of Damak, Jhapa..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link (Optional)</label>
                            <input type="url" name="link" placeholder="e.g., https://example.com" />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Timeline Item</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Timeline Item -->
        <div class="overlay" id="editTimelineOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditTimelineOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Timeline Item</h2>
                    <form id="editTimelineForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Year</label>
                            <input id="editTimelineYear" name="year" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input id="editTimelineLocation" name="location" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editTimelineDescription" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link (Optional)</label>
                            <input id="editTimelineLink" name="link" type="url" />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Mission Section -->
        <div class="overlay" id="editMissionOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditMissionOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Mission Section</h2>
                    <form id="editMissionForm" method="POST" action="{{ route('admin.story.mission.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Mission Title</label>
                            <input id="editMissionTitle" name="mission_title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Mission Text</label>
                            <textarea id="editMissionText" name="mission_text" required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Mission</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Values Title -->
        <div class="overlay" id="editValuesTitleOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditValuesTitleOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Values Title</h2>
                    <form id="editValuesTitleForm" method="POST" action="{{ route('admin.story.values.title.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Values Title</label>
                            <input id="editValuesTitle" name="values_title" type="text" required />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Title</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Add Value -->
        <div class="overlay" id="addValueOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeAddValueOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Add Value</h2>
                    <form method="POST" action="{{ route('admin.story.values.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Icon (Font Awesome Class)</label>
                            <input type="text" name="icon" placeholder="e.g., fa-leaf" required />
                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View Font Awesome Icons</a>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="e.g., Sustainability" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" placeholder="e.g., We practice environmentally conscious farming..." required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Value</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Value -->
        <div class="overlay" id="editValueOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditValueOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Value</h2>
                    <form id="editValueForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Icon (Font Awesome Class)</label>
                            <input id="editValueIcon" name="icon" type="text" required />
                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View Font Awesome Icons</a>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input id="editValueTitle" name="title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editValueDescription" name="description" required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Team Title & Intro -->
        <div class="overlay" id="editTeamTitleOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditTeamTitleOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Team Title & Intro</h2>
                    <form id="editTeamTitleForm" method="POST" action="{{ route('admin.story.team.title.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Team Title</label>
                            <input id="editTeamTitle" name="team_title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Team Introduction</label>
                            <textarea id="editTeamIntro" name="team_intro" required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Title & Intro</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Add Team Member -->
        <div class="overlay" id="addTeamOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeAddTeamOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Add Team Member</h2>
                    <form method="POST" action="{{ route('admin.story.team.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Icon (Font Awesome Class)</label>
                            <input type="text" name="icon" placeholder="e.g., fa-user-tie" required />
                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View Font Awesome Icons</a>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="e.g., Tea Master" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" placeholder="e.g., With over 20 years of experience..." required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Team Member</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay for Edit Team Member -->
        <div class="overlay" id="editTeamOverlay">
            <div class="overlay-content">
                <button class="close-btn" onclick="closeEditTeamOverlay()"><i class="fas fa-times"></i></button>
                <div class="form-section">
                    <h2>Edit Team Member</h2>
                    <form id="editTeamForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Icon (Font Awesome Class)</label>
                            <input id="editTeamIcon" name="icon" type="text" required />
                            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="icon-link">View Font Awesome Icons</a>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input id="editTeamTitle" name="title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editTeamDescription" name="description" required></textarea>
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
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
                    <form id="editCtaForm" method="POST" action="{{ route('admin.story.cta.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>CTA Title</label>
                            <input id="editCtaTitle" name="cta_title" type="text" required />
                        </div>
                        <div class="form-group">
                            <label>CTA Description</label>
                            <textarea id="editCtaDescription" name="cta_description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>CTA Link</label>
                            <input id="editCtaLink" name="cta_link" type="url" required />
                        </div>
                        <div class="form-group">
                            <label>CTA Button Text</label>
                            <input id="editCtaButtonText" name="cta_button_text" type="text" required />
                        </div>
                        <button type="submit"><i class="fas fa-save"></i> Save CTA</button>
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
            .story-section-wrapper {
                background: white;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 25px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #2a8b4e;
                transition: all 0.3s ease;
            }

            .story-section-wrapper:hover {
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

            .story-hero {
                padding: 0;
                background: transparent;
                border-radius: 0;
                margin-bottom: 0;
            }

            .hero-content {
                text-align: center;
            }

            .hero-content .badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                background: #e6f0e9;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 0.9em;
                color: #2a8b4e;
                margin-bottom: 15px;
                font-weight: 500;
            }

            .hero-content .badge .badge-icon {
                font-size: 1em;
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

            .hero-content .actions {
                display: flex;
                justify-content: center;
                margin-top: 8px;
            }

            .edit-hero-btn,
            .edit-journey-btn,
            .add-timeline-btn,
            .edit-timeline-btn,
            .edit-mission-btn,
            .edit-values-title-btn,
            .add-value-btn,
            .edit-value-btn,
            .edit-team-title-btn,
            .add-team-btn,
            .edit-team-btn,
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
            .edit-journey-btn:hover,
            .add-timeline-btn:hover,
            .edit-timeline-btn:hover,
            .edit-mission-btn:hover,
            .edit-values-title-btn:hover,
            .add-value-btn:hover,
            .edit-value-btn:hover,
            .edit-team-title-btn:hover,
            .add-team-btn:hover,
            .edit-team-btn:hover,
            .edit-cta-btn:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(42, 139, 78, 0.4);
            }

            .edit-hero-btn:active,
            .edit-journey-btn:active,
            .add-timeline-btn:active,
            .edit-timeline-btn:active,
            .edit-mission-btn:active,
            .edit-values-title-btn:active,
            .add-value-btn:active,
            .edit-value-btn:active,
            .edit-team-title-btn:active,
            .add-team-btn:active,
            .edit-team-btn:active,
            .edit-cta-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 5px rgba(42, 139, 78, 0.3);
            }

            .delete-btn {
                color: #d32f2f;
                background: #ffebee;
                padding: 8px 14px;
                border: 1px solid #ffcdd2;
                border-radius: 8px;
                cursor: pointer;
                font-size: 0.85em;
                display: flex;
                align-items: center;
                gap: 6px;
                transition: all 0.2s ease;
                font-weight: 500;
            }

            .delete-btn:hover {
                color: #ffffff;
                background: #d32f2f;
                border-color: #d32f2f;
            }

            .story-content {
                margin-top: 0;
            }

            .story-container {
                max-width: 1400px;
                margin: 0 auto;
            }

            .journey-section {
                background: transparent;
                padding: 0;
                border-radius: 0;
                margin-bottom: 0;
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

            .journey-intro {
                font-size: 1em;
                color: #4a5568;
                margin-bottom: 15px;
                line-height: 1.6;
            }

            .timeline {
                margin-bottom: 0;
            }

            .timeline-item {
                background: #f8faf9;
                padding: 20px;
                border-radius: 10px;
                border: 1px solid #e2e8f0;
                margin-bottom: 15px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .timeline-item:hover {
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .timeline-item .year {
                font-size: 1.2em;
                font-weight: 500;
                color: #2a8b4e;
            }

            .timeline-item .title {
                font-size: 1.1em;
                color: #1a3c34;
                margin: 4px 0;
            }

            .timeline-item .description {
                font-size: 0.95em;
                color: #4a5568;
                margin: 8px 0;
            }

            .timeline-item .visit {
                font-size: 0.85em;
                color: #2a8b4e;
                text-decoration: none;
                transition: color 0.2s ease;
            }

            .timeline-item .visit:hover {
                color: #3da65f;
            }

            .timeline-item .actions {
                display: flex;
                gap: 8px;
                margin-top: 8px;
            }

            .no-items {
                font-size: 0.95em;
                color: #4a5568;
                text-align: center;
                margin: 16px 0;
            }

            .mission-section {
                background: #ffffff;
                padding: 12px;
                border-radius: 10px;

                margin-bottom: 16px;
            }

            .mission-content h2 {
                font-size: 1.4em;
                font-weight: 500;
                color: #2a8b4e;
                margin-bottom: 8px;
            }

            .mission-content p {
                font-size: 0.95em;
                color: #4a5568;
                margin-bottom: 12px;
            }

            .mission-content .actions {
                display: flex;
                justify-content: flex-end;
            }

            .values-section {
                margin-bottom: 16px;
            }

            .values-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }

            .value-card {
                background: #ffffff;
                padding: 12px;
                border-radius: 10px;

                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .value-card:hover {
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .value-card .value-icon {
                font-size: 1.5em;
                color: #2a8b4e;
                margin-bottom: 8px;
            }

            .value-card h3 {
                font-size: 1.1em;
                font-weight: 500;
                color: #1a3c34;
                margin-bottom: 8px;
            }

            .value-card p {
                font-size: 0.95em;
                color: #4a5568;
            }

            .value-card .actions {
                display: flex;
                gap: 8px;
                margin-top: 8px;
            }

            /* Team Section */
            .team-section {
                background: #ffffff;
                padding: 12px;
                border-radius: 10px;

                margin-bottom: 16px;
            }

            .team-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
                margin-top: 12px;
            }

            .team-card {
                background: #ffffff;
                padding: 12px;
                border-radius: 10px;

                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .team-card:hover {
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .team-avatar {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #2a8b4e, #1a5630);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 8px;
            }

            .team-avatar i {
                color: #ffffff;
                font-size: 1.5em;
            }

            .team-card h3 {
                font-size: 1.1em;
                font-weight: 500;
                color: #1a3c34;
                text-align: center;
                margin-bottom: 8px;
            }

            .team-card p {
                font-size: 0.95em;
                color: #4a5568;
                text-align: center;
            }

            .team-card .actions {
                display: flex;
                gap: 8px;
                margin-top: 8px;
                justify-content: center;
            }

            /* CTA Section */
            .cta-section {
                background: #ffffff;
                padding: 12px;
                border-radius: 10px;

                margin-bottom: 16px;
                text-align: center;
            }

            .btn-enhanced {
                background: linear-gradient(135deg, #2a8b4e 0%, #1a5630 100%);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.85em;
                padding: 6px 12px;
                border: none;
                border-radius: 16px;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
                text-decoration: none;
            }

            .btn-enhanced:hover {
                background: linear-gradient(135deg, #3da65f 0%, #2a8b4e 100%);
                transform: scale(1.01);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .btn-enhanced:active {
                transform: scale(1);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }

            .cta-section .actions {
                display: flex;
                justify-content: center;
                margin-top: 8px;
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
                .values-grid,
                .team-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .main-content {
                    margin: 10px;
                    padding: 12px;
                }
            }

            /* Tablet (640px <= width < 1024px) */
            @media (max-width: 640px) {
                .values-grid,
                .team-grid {
                    grid-template-columns: 1fr;
                }

                .main-content {
                    margin: 8px;
                    padding: 10px;
                }

                .section-title {
                    font-size: 1.2em;
                }
            }

            /* Mobile (width < 640px) */
            @media (max-width: 480px) {
                .main-content {
                    margin: 4px;
                    padding: 8px;
                }

                .section-title {
                    font-size: 1em;
                }

                .edit-hero-btn,
                .edit-journey-btn,
                .add-timeline-btn,
                .edit-timeline-btn,
                .edit-mission-btn,
                .edit-values-title-btn,
                .add-value-btn,
                .edit-value-btn,
                .edit-team-title-btn,
                .add-team-btn,
                .edit-team-btn,
                .edit-cta-btn {
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

                .team-card {
                    padding: 10px;
                }

                .team-avatar {
                    width: 50px;
                    height: 50px;
                }

                .team-avatar i {
                    font-size: 1.2em;
                }

                .btn-enhanced {
                    padding: 5px 10px;
                    font-size: 0.8em;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function openEditHeroOverlay(badgeText, title, subtitle, description) {
                try {
                    closeAllOverlays();
                    document.getElementById('editBadgeText').value = badgeText;
                    document.getElementById('editHeroTitle').value = title;
                    document.getElementById('editHeroSubtitle').value = subtitle;
                    document.getElementById('editHeroDescription').value = description;
                    document.getElementById('editHeroOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening hero overlay:', e);
                }
            }

            function closeEditHeroOverlay() {
                document.getElementById('editHeroOverlay').classList.remove('active');
            }

            function openEditJourneyOverlay(title, intro) {
                try {
                    closeAllOverlays();
                    document.getElementById('editJourneyTitle').value = title;
                    document.getElementById('editJourneyIntro').value = intro;
                    document.getElementById('editJourneyOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening journey overlay:', e);
                }
            }

            function closeEditJourneyOverlay() {
                document.getElementById('editJourneyOverlay').classList.remove('active');
            }

            function openAddTimelineOverlay() {
                try {
                    closeAllOverlays();
                    document.getElementById('addTimelineOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening add timeline overlay:', e);
                }
            }

            function closeAddTimelineOverlay() {
                document.getElementById('addTimelineOverlay').classList.remove('active');
            }

            function openEditTimelineOverlay(id, year, location, description, link) {
                try {
                    closeAllOverlays();
                    document.getElementById('editTimelineYear').value = year;
                    document.getElementById('editTimelineLocation').value = location;
                    document.getElementById('editTimelineDescription').value = description;
                    document.getElementById('editTimelineLink').value = link || '';
                    document.getElementById('editTimelineForm').action = '/admin/story/timeline/' + id;
                    document.getElementById('editTimelineOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening edit timeline overlay:', e);
                }
            }

            function closeEditTimelineOverlay() {
                document.getElementById('editTimelineOverlay').classList.remove('active');
            }

            function openEditMissionOverlay(title, text) {
                try {
                    closeAllOverlays();
                    document.getElementById('editMissionTitle').value = title;
                    document.getElementById('editMissionText').value = text;
                    document.getElementById('editMissionOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening mission overlay:', e);
                }
            }

            function closeEditMissionOverlay() {
                document.getElementById('editMissionOverlay').classList.remove('active');
            }

            function openEditValuesTitleOverlay(title) {
                try {
                    closeAllOverlays();
                    document.getElementById('editValuesTitle').value = title;
                    document.getElementById('editValuesTitleOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening values title overlay:', e);
                }
            }

            function closeEditValuesTitleOverlay() {
                document.getElementById('editValuesTitleOverlay').classList.remove('active');
            }

            function openAddValueOverlay() {
                try {
                    closeAllOverlays();
                    document.getElementById('addValueOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening add value overlay:', e);
                }
            }

            function closeAddValueOverlay() {
                document.getElementById('addValueOverlay').classList.remove('active');
            }

            function openEditValueOverlay(id, icon, title, description) {
                try {
                    closeAllOverlays();
                    document.getElementById('editValueIcon').value = icon;
                    document.getElementById('editValueTitle').value = title;
                    document.getElementById('editValueDescription').value = description;
                    document.getElementById('editValueForm').action = '/admin/story/values/' + id;
                    document.getElementById('editValueOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening edit value overlay:', e);
                }
            }

            function closeEditValueOverlay() {
                document.getElementById('editValueOverlay').classList.remove('active');
            }

            function openEditTeamTitleOverlay(title, intro) {
                try {
                    closeAllOverlays();
                    document.getElementById('editTeamTitle').value = title;
                    document.getElementById('editTeamIntro').value = intro;
                    document.getElementById('editTeamTitleOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening team title overlay:', e);
                }
            }

            function closeEditTeamTitleOverlay() {
                document.getElementById('editTeamTitleOverlay').classList.remove('active');
            }

            function openAddTeamOverlay() {
                try {
                    closeAllOverlays();
                    document.getElementById('addTeamOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening add team overlay:', e);
                }
            }

            function closeAddTeamOverlay() {
                document.getElementById('addTeamOverlay').classList.remove('active');
            }

            function openEditTeamOverlay(id, icon, title, description) {
                try {
                    closeAllOverlays();
                    document.getElementById('editTeamIcon').value = icon;
                    document.getElementById('editTeamTitle').value = title;
                    document.getElementById('editTeamDescription').value = description;
                    document.getElementById('editTeamForm').action = '/admin/story/team/' + id;
                    document.getElementById('editTeamOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening edit team overlay:', e);
                }
            }

            function closeEditTeamOverlay() {
                document.getElementById('editTeamOverlay').classList.remove('active');
            }

            function openEditCtaOverlay(title, description, link, buttonText) {
                try {
                    closeAllOverlays();
                    document.getElementById('editCtaTitle').value = title;
                    document.getElementById('editCtaDescription').value = description;
                    document.getElementById('editCtaLink').value = link;
                    document.getElementById('editCtaButtonText').value = buttonText;
                    document.getElementById('editCtaOverlay').classList.add('active');
                } catch (e) {
                    console.error('Error opening CTA overlay:', e);
                }
            }

            function closeEditCtaOverlay() {
                document.getElementById('editCtaOverlay').classList.remove('active');
            }

            function closeAllOverlays() {
                try {
                    document.querySelectorAll('.overlay').forEach(overlay => {
                        overlay.classList.remove('active');
                    });
                } catch (e) {
                    console.error('Error closing overlays:', e);
                }
            }
        </script>
    @endpush
@endsection
