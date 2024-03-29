@extends('layout')

@section('title', 'Welcome to Parcel Pirate')

@section('content')

<div class="hero-section" style="position: relative; background-image: url('{{ asset('images/hero-background2.webp') }}'); text-align: center; padding: 50px 20px; overflow: hidden; border-radius: 15px;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.8); border-radius: 15px;"></div>
    <div style="position: relative; ">
        <h1 style="color: #fff; font-size: 2.5em; font-weight: bold;">Simplify Your Shipments in the Turks and Caicos</h1>
        <p style="color: #fff; font-size: 1.2em;">Join the adventure with Parcel Pirate and navigate the seas of freight forwarding with ease.</p>
        <a href="/register" class="btn btn-primary">Start Your Journey - <i>it's totally FREE!</i></a>
    </div>
</div>

<div class="container-home">
    <div class="features-section" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <div class="feature" style="flex: 1; min-width: 250px; background-color: #f2f2f2; padding: 20px; border-radius: 8px;">
            <h3>Direct Invoice Imports</h3>
            <p>Automatically import your invoices from Amazon and other retailers with a click.</p>
        </div>
        <div class="feature" style="flex: 1; min-width: 250px; background-color: #f2f2f2; padding: 20px; border-radius: 8px;">
            <h3>Shipment Tracking</h3>
            <p>Track every milestone of your shipments, from warehouse to your house.</p>
        </div>
        <div class="feature" style="flex: 1; min-width: 250px; background-color: #f2f2f2; padding: 20px; border-radius: 8px;">
            <h3>Paperwork Simplified</h3>
            <p>Easily generate necessary receipts for a smooth customs process.</p>
        </div>
    </div>
</div>


<div class="status-section">
  <div class="content-wrap"> <!-- Wrapper for flex behavior -->
    <div class="text-content"> <!-- Text content class -->
      <div class="status-title">Your trusted mate in navigating the seas of freight forwarding.</div>
      At Parcel Pirate, I understand the whirlwind of managing shipments, especially when your treasures are journeying through freight forwarders to reach the serene shores of the Turks and Caicos Islands. Born from a personal quest to tame the chaos of my own shipments, I crafted Parcel Pirate to be the compass that guides you through every wave and wind of your freight forwarding adventures.
      <div class="status-title" style="margin-top: 20px;">My Mission</div>
      To offer a seamless, user-friendly platform that empowers residents of the Turks and Caicos Islands to effortlessly organize their shipment receipts, track their freight at every leg of the journey, and ensure their treasures navigate smoothly from warehouse to warm sands, all without costing a doubloon.
      <div class="status-title" style="margin-top: 20px;">How We Set Sail Together</div>
      <ul>
      <li><b>Direct Invoice Imports:</b> Effortlessly import your invoices from Amazon, or manually enter receipts for any order.</li>
      <li><b>Shipment Breakdowns:</b> Divide your orders into individual shipments, making organization and tracking a breeze.
      <li><b>Comprehensive Tracking:</b> From order placement to the final pickup, follow your shipment’s voyage across every milestone.
      <li><b>Customs Made Easy:</b> Generate PDFs and spreadsheets of your receipts to smooth out the customs process, ensuring your goods land without a hitch.
      <li><b>Designed with You in Mind:</b> Tailored specifically for use with OEC and other freight forwarders serving the Turks and Caicos Islands, because we’re part of the same crew.
      </ul>
      <div class="status-title" style="margin-top: 20px;">My Promise</div>
      Parcel Pirate is more than a service; it's a commitment to my neighbors and fellow islanders. As a software developer who has weathered the storm of disorganized shipments, I built this platform for myself and quickly realized it was a lifeline others needed too. Parcel Pirate is here to eliminate the confusion and clutter of managing freight forwarding, letting you focus on the joy of your shipments arriving safely to our beautiful islands.
      <br><br>
      <b>Join me on this journey.</b> Let's make shipment tracking a breeze and keep our islands connected to the world, one organized parcel at a time.
      <div class="status-title" style="margin-top: 20px;">Ready to Navigate Your Shipments with Ease?</div>
      Start your voyage with Parcel Pirate today - it's free!
    </div>
    <div class="image-content"> <!-- Image content class -->
      <img src="{{ asset('images/pirate_homepage.webp') }}" alt="Homepage Hero Image" style="width: 100%; height: auto;">
    </div>
  </div>
</div>


<div class="container-home">
  <div class="testimonials-section" style="margin-top: 40px;">
    <div class="section-title" style="font-size: 2em; font-weight: bold; margin-bottom: 20px;">What Our Users Say</div>
    <div class="testimonial" style="background-color: #f2f2f2; padding: 20px; border-radius: 8px; margin-top: 20px;">
      <p>"Man, Parcel Pirate done make shipping life a breeze! Used to run 'round like a headless chicken with all them receipts. Now? Smooth sailing, just like cruising down Grace Bay on a lazy Sunday. No fuss, no muss, just me and my shipments in harmony. Big up to Parcel Pirate, the real MVP of the high seas and paperwork!"</p>
      <cite>- <a href="https://chat.openai.com/">ChatGPT</a> when asked for a quote with local flare since there aren't any users on this brand new system, soon come!</cite>
    </div>
  </div>
  <div class="cta-section" style="background-color: #1a1a1a; color: #E5BE01; text-align: center; padding: 40px 20px; margin-top: 40px;">
    <div class="section-title" style="font-size: 2em; font-weight: bold; margin-bottom: 20px;">Ready to Take Control of Your Shipments?</div>
    <p>Embark on your hassle-free shipping journey with Parcel Pirate today.</p>
    <a href="/register" style="color: #fff; background-color: #007bff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Sign Up Now</a>
  </div>
</div>



@endsection