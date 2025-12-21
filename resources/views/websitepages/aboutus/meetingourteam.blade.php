@php
    use Illuminate\Support\Facades\Storage;
@endphp

<style>
    .meet-team-section {
        padding: 80px 20px;
        background-color: #ffffff;
    }

    .team-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .team-section-subtitle {
        font-size: 14px;
        font-weight: 500;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
        margin-bottom: 10px;
    }

    .team-section-title {
        font-size: 42px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 60px;
        text-align: center;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .team-card {
        background: #ffffff;
        border-radius: 0;
        overflow: visible;
        box-shadow: none;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        padding-bottom: 30px;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .team-card:hover .team-card-content {
        background: #3b82f6;
        color: white;
        border-radius: 12px;
        padding: 30px 20px;
        margin-top: -40px;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
    }

    .team-card:hover .team-name {
        color: white;
    }

    .team-card:hover .team-rank {
        color: white;
    }

    .team-card:hover .team-description {
        color: white;
    }

    .team-image-wrapper {
        width: 180px;
        height: 180px;
        margin: 0 auto 25px;
        border-radius: 50%;
        overflow: hidden;
        background: #f8f9fa;
        border: 5px solid #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
    }

    .team-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .team-card:hover .team-image {
        transform: scale(1.05);
    }

    .team-card-content {
        transition: all 0.3s ease;
        padding: 0 10px;
    }

    .team-name {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        transition: color 0.3s;
    }

    .team-rank {
        font-size: 13px;
        color: #3b82f6;
        margin-bottom: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: color 0.3s;
    }

    .team-description {
        font-size: 15px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 25px;
        min-height: 50px;
        transition: color 0.3s;
    }

    .team-social {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #3b82f6;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 16px;
    }

    .team-card:hover .social-link {
        background: white;
        color: #3b82f6;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .no-team-message {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .meet-team-section {
            padding: 60px 20px;
        }

        .team-section-title {
            font-size: 32px;
        }

        .team-section-subtitle {
            font-size: 12px;
        }

        .team-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        .team-image-wrapper {
            width: 150px;
            height: 150px;
        }
    }
</style>

<section class="meet-team-section">
    <div class="team-container">
        <p class="team-section-subtitle">MEET OUR BRILLIANT MINDS</p>
        <h2 class="team-section-title">Our Leadership Team</h2>

        @if(isset($leadershipTeams) && $leadershipTeams->count() > 0)
            <div class="team-grid">
                @foreach($leadershipTeams as $member)
                    <div class="team-card">
                        <div class="team-image-wrapper">
                            @if($member->image)
                                <img src="{{ Storage::url($member->image) }}" 
                                     alt="{{ $member->name }}" 
                                     class="team-image">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: 700;">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="team-card-content">
                            <h3 class="team-name">{{ $member->name }}</h3>
                            <p class="team-rank">{{ strtoupper($member->rank) }}</p>
                            <p class="team-description">{{ $member->description }}</p>
                            <div class="team-social">
                                @if($member->phonenumber)
                                    <a href="tel:{{ $member->phonenumber }}" class="social-link" title="Phone">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </a>
                                @endif
                                @if($member->gmail)
                                    <a href="mailto:{{ $member->gmail }}" class="social-link" title="Email">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </a>
                                @endif
                                @if($member->facebook)
                                    <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer" class="social-link" title="Facebook">
                                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                        </svg>
                                    </a>
                                @endif
                                @if($member->instagram)
                                    <a href="{{ $member->instagram }}" target="_blank" rel="noopener noreferrer" class="social-link" title="Instagram">
                                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-team-message">
                <p>Our team members will be displayed here soon.</p>
            </div>
        @endif
    </div>
</section>