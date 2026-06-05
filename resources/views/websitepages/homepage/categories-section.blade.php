@php
    use Illuminate\Support\Facades\Storage;

    $heroImage = asset('images/static_image/frontimage.jpg');
    $placeholder = asset('images/static_image/placeholder.jpg');
    $showcaseIcons = ['👑', '🌿', '✨'];
    $showcaseDefaults = [
        ['icon' => '👑', 'title' => 'Premium Wigs', 'desc' => 'Lace front & full cap styles', 'url' => null, 'image' => null],
        ['icon' => '🌿', 'title' => 'Human Hair', 'desc' => '100% Remy & Virgin hair', 'url' => null, 'image' => null],
        ['icon' => '✨', 'title' => 'Accessories', 'desc' => 'Oils, bands & essentials', 'url' => null, 'image' => null],
    ];

    $showcaseItems = $categories->count() > 0
        ? $categories->take(3)->values()->map(function ($category, $index) use ($showcaseIcons, $placeholder) {
            return [
                'icon' => $showcaseIcons[$index % count($showcaseIcons)],
                'title' => $category->category_name,
                'desc' => ($category->subcategories->count() ?? 0) . ' items',
                'url' => route('category.show', $category->category_id),
                'image' => $category->front_image ? Storage::url($category->front_image) : $placeholder,
            ];
        })->all()
        : $showcaseDefaults;

    $marqueeItems = $categories->count() > 0
        ? $categories->pluck('category_name')->merge(['Premium Wigs', 'Human Hair Extensions', 'Hair Oils & Serums', config('site.name')])->unique()->values()
        : collect(['Premium Wigs', 'Human Hair Extensions', 'Hair Oils & Serums', 'Hair Bands & Accessories', 'Lace Front Wigs', config('site.name')]);
@endphp

<section id="hero" class="gob-hero">
    {{-- Left: hero image with elegant text overlay --}}
    <div class="hero-left">
        <div class="hero-left-bg" style="background-image: url('{{ $heroImage }}');"></div>
        <div class="hero-left-overlay"></div>
        <div class="hero-left-content">
            <p class="hero-eyebrow">✦ Premium Hair Boutique</p>
            <h1 class="hero-title">
                Beauty <em>Crafted</em><br>for You
            </h1>
            <p class="hero-sub">
                Discover our curated collection of premium wigs, 100% human hair extensions, and luxury hair accessories — crafted to empower your confidence.
            </p>
            <div class="hero-cta">
                <a href="#products" class="btn-primary">Shop Collection</a>
                <a href="{{ route('made-for-you') }}" class="btn-outline">Our Story</a>
            </div>
        </div>
    </div>

    {{-- Right: circular shape + floating cards --}}
    <div class="hero-right">
        <div class="hero-visual">
            <div class="hero-circle-bg"></div>
            <div class="showcase-label">Beauty</div>
            <div class="hero-product-showcase">
                @foreach($showcaseItems as $card)
                    @if(!empty($card['url']))
                        <a href="{{ $card['url'] }}" class="floating-card">
                    @else
                        <div class="floating-card">
                    @endif
                        @if(!empty($card['image']))
                            <div class="card-thumb">
                                <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}">
                            </div>
                        @else
                            <span class="card-icon">{{ $card['icon'] }}</span>
                        @endif
                        <div class="card-info">
                            <div class="card-title">{{ $card['title'] }}</div>
                            <div class="card-desc">{{ $card['desc'] }}</div>
                        </div>
                    @if(!empty($card['url']))
                        </a>
                    @else
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="marquee-wrapper">
    <div class="marquee-track">
        @foreach($marqueeItems->merge($marqueeItems) as $item)
            <span class="marquee-item">{{ $item }} <span class="marquee-dot">✦</span></span>
        @endforeach
    </div>
</div>

<style>
    .gob-hero {
        --gold: #C9A96E;
        --gold-light: #E8D5B0;
        --cream: #FAF6F0;
        --deep: #1A1209;
        --warm: #3D2B1F;

        min-height: calc(100vh - 120px);
        display: grid;
        grid-template-columns: 1fr 1fr;
        position: relative;
        overflow: hidden;
        background: var(--cream);
        font-family: 'Jost', sans-serif;
        font-weight: 300;
    }

    /* ── Left: hero image + text ── */
    .gob-hero .hero-left {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        min-height: calc(100vh - 120px);
    }

    .gob-hero .hero-left-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transform: scale(1.02);
        transition: transform 8s ease;
    }

    .gob-hero .hero-left:hover .hero-left-bg {
        transform: scale(1.06);
    }

    .gob-hero .hero-left-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            rgba(26, 18, 9, 0.72) 0%,
            rgba(26, 18, 9, 0.45) 55%,
            rgba(26, 18, 9, 0.2) 100%
        );
        z-index: 1;
    }

    .gob-hero .hero-left-content {
        position: relative;
        z-index: 2;
        padding: 4rem;
        max-width: 560px;
    }

    .gob-hero .hero-eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        color: var(--gold-light);
        margin-bottom: 1.5rem;
        opacity: 0;
        animation: gobFadeUp 0.8s 0.3s forwards;
    }

    .gob-hero .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.8rem, 4.5vw, 5rem);
        font-weight: 300;
        line-height: 1.05;
        color: #fff;
        opacity: 0;
        animation: gobFadeUp 0.8s 0.5s forwards;
    }

    .gob-hero .hero-title em {
        font-style: italic;
        color: var(--gold);
    }

    .gob-hero .hero-sub {
        margin-top: 1.8rem;
        font-size: 0.95rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.88);
        max-width: 420px;
        opacity: 0;
        animation: gobFadeUp 0.8s 0.7s forwards;
    }

    .gob-hero .hero-cta {
        margin-top: 2.5rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        opacity: 0;
        animation: gobFadeUp 0.8s 0.9s forwards;
    }

    .gob-hero .btn-primary {
        background: var(--gold);
        color: white;
        border: none;
        padding: 0.95rem 2.5rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.72rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        text-decoration: none;
        transition: background 0.3s, transform 0.2s;
        display: inline-block;
    }

    .gob-hero .btn-primary:hover {
        background: var(--warm);
        color: white;
        transform: translateY(-2px);
    }

    .gob-hero .btn-outline {
        border: 1px solid rgba(255, 255, 255, 0.7);
        color: #fff;
        padding: 0.95rem 2.5rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.72rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        text-decoration: none;
        transition: background 0.3s, color 0.3s, border-color 0.3s, transform 0.2s;
        display: inline-block;
    }

    .gob-hero .btn-outline:hover {
        background: var(--gold);
        border-color: var(--gold);
        color: white;
        transform: translateY(-2px);
    }

    /* ── Right: circle shape + floating cards ── */
    .gob-hero .hero-right {
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 120px);
        background: var(--cream);
    }

    .gob-hero .hero-right::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #C9A96E22 0%, #D4A0A022 50%, #1A120911 100%);
        z-index: 1;
    }

    .gob-hero .hero-visual {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        min-height: inherit;
    }

    .gob-hero .hero-circle-bg {
        width: min(520px, 75vw);
        height: min(520px, 75vw);
        border-radius: 50%;
        background: linear-gradient(135deg, #E8D5B0 0%, #C9A96E 50%, #3D2B1F 100%);
        position: absolute;
        opacity: 0.22;
        animation: gobRotateSlow 20s linear infinite;
        z-index: 1;
    }

    .gob-hero .hero-product-showcase {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        padding: 4rem 3rem 3rem;
        height: 100%;
        width: 100%;
    }

    .gob-hero .showcase-label {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3rem, 8vw, 5rem);
        font-style: italic;
        color: var(--gold);
        opacity: 0.15;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
        pointer-events: none;
        letter-spacing: 0.06em;
        z-index: 1;
    }

    .gob-hero .floating-card {
        background: rgba(255, 255, 255, 0.82);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(201, 169, 110, 0.35);
        padding: 1rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        width: min(280px, 85%);
        text-decoration: none;
        color: inherit;
        box-shadow: 0 8px 32px rgba(61, 43, 31, 0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        opacity: 0;
        animation: gobFadeUp 0.8s forwards, gobFloat 5s ease-in-out infinite;
    }

    .gob-hero .floating-card:hover {
        transform: translateY(-4px) !important;
        box-shadow: 0 16px 48px rgba(61, 43, 31, 0.14);
    }

    .gob-hero .floating-card:nth-child(1) {
        animation-delay: 1s, 0s;
        align-self: flex-start;
        margin-left: 8%;
    }

    .gob-hero .floating-card:nth-child(2) {
        animation-delay: 1.2s, 1.5s;
        align-self: center;
    }

    .gob-hero .floating-card:nth-child(3) {
        animation-delay: 1.4s, 0.7s;
        align-self: flex-end;
        margin-right: 8%;
    }

    .gob-hero .card-icon {
        font-size: 2rem;
        flex-shrink: 0;
        width: 52px;
        text-align: center;
    }

    .gob-hero .card-thumb {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid rgba(201, 169, 110, 0.4);
    }

    .gob-hero .card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gob-hero .card-title {
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.1em;
        color: var(--deep);
        text-transform: uppercase;
    }

    .gob-hero .card-desc {
        font-size: 0.7rem;
        color: var(--warm);
        margin-top: 0.2rem;
    }

    @keyframes gobFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    @keyframes gobRotateSlow {
        to { transform: rotate(360deg); }
    }

    /* ── Marquee ── */
    .marquee-wrapper {
        overflow: hidden;
        background: #1A1209;
        padding: 1rem 0;
        border-top: 1px solid rgba(201, 169, 110, 0.2);
        border-bottom: 1px solid rgba(201, 169, 110, 0.2);
    }

    .marquee-track {
        display: flex;
        gap: 3rem;
        animation: gobMarquee 18s linear infinite;
        white-space: nowrap;
    }

    .marquee-item {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-size: 1rem;
        color: #E8D5B0;
        letter-spacing: 0.1em;
        flex-shrink: 0;
    }

    .marquee-dot {
        color: #C9A96E;
        margin: 0 0.5rem;
    }

    @keyframes gobFadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes gobMarquee {
        to { transform: translateX(-50%); }
    }

    @media (max-width: 1024px) {
        .gob-hero {
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .gob-hero .hero-left,
        .gob-hero .hero-right {
            min-height: 55vh;
        }

        .gob-hero .hero-left-content {
            padding: 3rem 2rem;
        }
    }

    @media (max-width: 900px) {
        .gob-hero .hero-right {
            min-height: 50vh;
        }

        .gob-hero .floating-card {
            margin-left: 0 !important;
            margin-right: 0 !important;
            align-self: center !important;
        }
    }

    @media (max-width: 600px) {
        .gob-hero .hero-cta {
            flex-direction: column;
        }

        .gob-hero .btn-primary,
        .gob-hero .btn-outline {
            text-align: center;
        }
    }
</style>
