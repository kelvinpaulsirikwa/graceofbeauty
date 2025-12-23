@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- User Feedback Section -->
@if($userFeedbacks && $userFeedbacks->count() > 0)
    <section class="user-feedback-section pt-8 pb-0 bg-gray-50">
        <div class="container mx-auto px-0">
            <div class="text-center mb-16 px-4">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                    See what our customers are saying about our products and services
                </h2>
            </div>

            <div class="feedback-grid-container">
                @foreach($userFeedbacks as $feedback)
                    <a href="{{ route('user.feedback.story', $feedback->feedback_id) }}" class="feedback-image-card group">
                        <div class="feedback-image-container">
                            <img src="{{ Storage::url($feedback->image) }}" 
                                 alt="User Feedback" 
                                 class="feedback-image">
                            <div class="feedback-overlay">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .user-feedback-section {
            font-family: 'Arial', sans-serif;
        }

        .feedback-grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 0; /* No gaps between images */
            max-width: 100%;
            margin: 0;
        }

        .feedback-image-card {
            display: block;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .feedback-image-card:hover {
            transform: translateY(-5px);
        }

        .feedback-image-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1/2; /* Taller aspect ratio for longer images */
            overflow: hidden;
            border-radius: 0;
            box-shadow: none;
            background: #f3f4f6;
        }

        .feedback-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .feedback-image-card:hover .feedback-image {
            transform: scale(1.05);
        }

        .feedback-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            opacity: 0;
        }

        .feedback-image-card:hover .feedback-overlay {
            background: rgba(0, 0, 0, 0.5);
            opacity: 1;
        }

        @media (max-width: 1200px) {
            .feedback-grid-container {
                grid-template-columns: repeat(3, 1fr);
                gap: 0;
            }
        }

        @media (max-width: 768px) {
            .user-feedback-section {
                padding-top: 2rem;
                padding-bottom: 0;
            }

            .feedback-grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .feedback-grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 0;
            }
        }
    </style>
@endif

