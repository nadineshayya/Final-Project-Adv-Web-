@extends('front.layouts.app')
<style>.team-card {
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.team-card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 350px;
    object-fit: cover;
}
</style>
@section('content')
<<<<<<< HEAD

@endsection
=======
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item active">About Us</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-10 py-5">
        <div class="container">
            <h1 class="my-3">About Us</h1>
            <div class="row">
                <!-- Introductory Content -->
                <div class="col-md-6">
                    <p class="lead" style="line-height: 1.8;">
                        Welcome to THREAD & TREND Store, where passion meets quality! 
                        Our journey began with a simple vision: to deliver exceptional products and unparalleled service to our customers.
                    </p>
                    <p style="line-height: 1.8;">
                        Over the years, we’ve grown from a small dream to a thriving business, but our core values remain the same. 
                        We are dedicated to providing innovative, sustainable, and customer-focused solutions that make a difference in your life.
                    </p>
                </div>

                <!-- Image or Additional Visual -->
                <div class="col-md-6">
                    <img src="{{ asset('front-assets/images/With our shop.png') }}" alt="About Us" class="img-fluid rounded shadow">
                </div>
            </div>

            <!-- Mission, Vision, and Values -->
            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <h3 class="mb-3">Our Mission</h3>
                    <p>
                        To create products that enrich lives, inspire trust, and promote sustainability.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <h3 class="mb-3">Our Vision</h3>
                    <p>
                        To be a global leader known for quality, innovation, and customer satisfaction.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <h3 class="mb-3">Our Values</h3>
                    <p>
                        Integrity, innovation, and inclusivity are at the heart of everything we do.
                    </p>
                </div>
            </div>

     
            <section class="section-10 py-5">
        <div class="container">
            <h1 class="my-3 text-center">Meet Our Team</h1>
            <div class="row">
                <!-- Team Member 1 -->
                <div class="col-md-4">
                    <div class="card team-card shadow-sm">
                        <img src="{{ asset('front-assets/images/Untitled design (3).png') }}" class="card-img-top" alt="Team Member 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Nadine</h5>
                            <p class="card-text">CEO & Founder</p>
                            <p>Nadine is the visionary behind THREAD & TREND, leading the company with passion and expertise.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-md-4">
                    <div class="card team-card shadow-sm">
                        <img src="{{ asset('front-assets/images/Untitled design (4).png') }}" class="card-img-top" alt="Team Member 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Razan</h5>
                            <p class="card-text">Creative Director</p>
                            <p>Razan brings our brand to life with innovative designs and creative strategies.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-md-4">
                    <div class="card team-card shadow-sm">
                        <img src="{{ asset('front-assets/images/Untitled design (5).png') }}" class="card-img-top" alt="Team Member 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cyrine</h5>
                            <p class="card-text">Marketing Head</p>
                            <p>Cyrine ensures our products reach the right audience with impactful marketing campaigns.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        </div>
    </section>
</main>
@endsection
>>>>>>> d6de60f91cebdf81650c28accbae90a6fd9e543f
