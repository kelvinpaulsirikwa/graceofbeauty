@extends('websitepages.layouts.app')
@section('title', 'Contact Us')

@section('content')
<!-- Contact Section -->
<section style="background-color: #ffffff; padding: 70px 20px; text-align: center;">
    @php($company = config('company'))
    <div style="max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: 48px; font-weight: 700; color: #0f172a; margin-bottom: 20px;">Contact us</h1>
        <p style="color: #64748b; font-size: 16px; line-height: 1.6; margin-bottom: 4px;">
            Have questions or need more details about our services?
        </p>
        <p style="color: #64748b; font-size: 16px; line-height: 1.6; margin-bottom: 4px;">
            Send us a message, we’re here to help and will get back to you soon.
        </p>
        <p style="color: #64748b; font-size: 16px; line-height: 1.6;">
            Your enquiry matters, and we’ll make sure it reaches the right team quickly.
        </p>
    </div>

    <div style="max-width: 1100px; margin: 35px auto 0; display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
        
        <!-- Office Address -->
        <div style="background: #ffffff; border-radius: 16px; padding: 50px 40px; text-align: center; box-shadow: 0 18px 35px rgba(15,23,42,0.08); border: 1px solid #e2e8f0;">
            <div style="width: 70px; height: 70px; background: #0f172a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
            </div>
            <h3 style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #0f172a; margin-bottom: 10px;">Office Address</h3>
            <p style="color: #94a3b8; font-size: 14px; margin-bottom: 12px;">Find Us Here</p>
            <p style="color: #64748b; font-size: 15px; line-height: 1.8;">
            {{ config('site.contact.address') }}
            </p>
        </div>

        <!-- Phone Number -->
        <div style="background: #ffffff; border-radius: 16px; padding: 50px 40px; text-align: center; box-shadow: 0 12px 25px rgba(15,23,42,0.06); border: 1px solid #e2e8f0;">
            <div style="width: 70px; height: 70px; background: #0f172a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </div>
            <h3 style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #0f172a; margin-bottom: 10px;">Phone Number</h3>
            <p style="color: #94a3b8; font-size: 14px; margin-bottom: 12px;">Call Us Now</p>
            <p style="color: #64748b; font-size: 17px; font-weight: 600;">{{ config('site.contact.phone') }}</p>
        </div>

        <!-- Email Address -->
        <div style="background: #ffffff; border-radius: 16px; padding: 50px 40px; text-align: center; box-shadow: 0 12px 25px rgba(15,23,42,0.06); border: 1px solid #e2e8f0;">
            <div style="width: 70px; height: 70px; background: #0f172a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>
            <h3 style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #0f172a; margin-bottom: 10px;">Email Address</h3>
            <p style="color: #94a3b8; font-size: 14px; margin-bottom: 12px;">Send Us Mail</p>
            <p style="color: #64748b; font-size: 15px; font-weight: 600;">{{ config('site.contact.email') }}</p>
        </div>
    </div>
</section>


<!-- Schedule Consultation Section -->
<section style="padding: 45px 20px 80px; background: linear-gradient(to bottom, #ffffff 0%, #f8fafc 100%);">
    <div style="max-width: 1100px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
            
            <!-- Form Column -->
            <div>
                <div style="background: #0f172a; padding: 55px 50px; border-radius: 20px;">
                    <h2 style="color: white; font-size: 38px; margin-bottom: 40px; font-weight: 700; line-height: 1.2;">✨ Set Up a Styling Consultation ✨</h2>
                    
                    <form action="#" method="POST">
                        @csrf
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;">
                            <input type="text" name="name" placeholder="Your Name" required 
                                style="padding: 16px 18px; border: none; border-radius: 8px; font-size: 15px; width: 100%; box-sizing: border-box; background: white; color: #1e293b; font-family: inherit;">
                            <input type="email" name="email" placeholder="Your Email" required 
                                style="padding: 16px 18px; border: none; border-radius: 8px; font-size: 15px; width: 100%; box-sizing: border-box; background: white; color: #1e293b; font-family: inherit;">
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;">
                            <input type="tel" name="phone" placeholder="Your Phone" required 
                                style="padding: 16px 18px; border: none; border-radius: 8px; font-size: 15px; width: 100%; box-sizing: border-box; background: white; color: #1e293b; font-family: inherit;">
                            <input type="text" name="services" placeholder="Your Services" 
                                style="padding: 16px 18px; border: none; border-radius: 8px; font-size: 15px; width: 100%; box-sizing: border-box; background: white; color: #1e293b; font-family: inherit;">
                        </div>
                        
                        <textarea name="message" placeholder="Message" rows="5" required 
                            style="padding: 16px 18px; border: none; border-radius: 8px; font-size: 15px; width: 100%; box-sizing: border-box; margin-bottom: 28px; resize: vertical; background: white; color: #1e293b; font-family: inherit; line-height: 1.5;"></textarea>
                        
                        <button type="submit" 
                            style="background: #10b981; color: white; padding: 16px 40px; border: none; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; text-transform: uppercase; letter-spacing: 0.8px; transition: background 0.3s ease; font-family: inherit;">
                            SEND MESSAGE
                        </button>
                    </form>
                </div>
            </div>

            <!-- Image Column -->
            <div style="position: relative;">
                <!-- Green shape -->
                <div style="position: absolute; top: -40px; left: -50px; width: 280px; height: 280px; background: linear-gradient(135deg, #10b981 0%, #34d399 100%); border-radius: 45% 55% 60% 40% / 50% 60% 40% 50%; z-index: 0; opacity: 0.85;"></div>
                
                <!-- Blue shape -->
                <div style="position: absolute; bottom: -50px; right: -50px; width: 250px; height: 250px; background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); border-radius: 60% 40% 45% 55% / 40% 50% 50% 60%; z-index: 0; opacity: 0.85;"></div>
                
 
                <!-- Image -->
                <img src="{{ asset('images/static_image/contactus.jpg') }}"  
                    alt="Customer Support Representative" 
                    style="width: 100%; height: auto; border-radius: 20px; position: relative; z-index: 1; display: block;">
            </div>

        </div>
    </div>
</section>

  <!-- Section 3: Full Width Map -->
  <section>
  <div class="w-full" style="height: 600px;">
        <iframe 
            src="https://www.google.com/maps?q=VV4X+88C+Ihumwa+Dodoma+Tanzania&output=embed&zoom=15" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>
<style>
    input::placeholder,
    textarea::placeholder {
        color: #94a3b8;
    }

    input:focus,
    textarea:focus {
        outline: none;
    }

    button:hover {
        background: #059669 !important;
    }

    @media (max-width: 992px) {
        section > div:last-child {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
        }
        h1 {
            font-size: 36px !important;
        }
        h2 {
            font-size: 30px !important;
        }
    }
</style>
@endsection
