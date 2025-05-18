@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="hero-section position-relative">
        <div class="hero-content">
        <div class="container">
            <div class="row align-items-center">
                    <div class="col-lg-6 text-white">
                        <h1 class="display-3 fw-bold mb-3">Welcome to PFA Blood</h1>
                        <p class="lead mb-4">Connect with blood donors and recipients in real-time. Every drop counts in saving a life.</p>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Go to Dashboard</a>
                        @else
                            <a href="{{ auth()->user()->role === 'patient' ? route('patient.dashboard') : route('donor.dashboard') }}" 
                               class="btn btn-light btn-lg px-4">Go to Dashboard</a>
                        @endguest
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image">
                            <img src="{{ asset('images/blood-donation-hero.jpg') }}" style="max-width: 450px; height: auto;" alt="Blood Donation" class="img-fluid rounded-3 shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            
    <!-- Features Section -->
    <div class="container py-5">
            <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-danger bg-opacity-10 text-danger rounded-circle mb-3 mx-auto">
                            <i class="fas fa-search fa-2x"></i>
                        </div>
                        <h3 class="h4 mb-3">Find Donors</h3>
                        <p class="text-muted mb-0">Quickly locate blood donors near you based on blood type and location.</p>
                    </div>
                </div>
                                </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-danger bg-opacity-10 text-danger rounded-circle mb-3 mx-auto">
                            <i class="fas fa-bell fa-2x"></i>
                        </div>
                        <h3 class="h4 mb-3">Emergency Alerts</h3>
                        <p class="text-muted mb-0">Send urgent blood requests to nearby donors in emergency situations.</p>
                    </div>
                </div>
                                </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-danger bg-opacity-10 text-danger rounded-circle mb-3 mx-auto">
                            <i class="fas fa-hospital fa-2x"></i>
                        </div>
                        <h3 class="h4 mb-3">Blood Centers</h3>
                        <p class="text-muted mb-0">Find nearby blood donation centers and track available blood units.</p>
                    </div>
                </div>
            </div>
        </div>
            </div>
            
    <!-- Statistics Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold text-danger mb-0">
                        @php
                            try {
                                echo \App\Models\User::where('role', 'donor')->count();
                            } catch (\Exception $e) {
                                echo '0';
                            }
                        @endphp
                    </h2>
                    <p class="text-muted">Registered Donors</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold text-danger mb-0">
                        @php
                            try {
                                echo \App\Models\BloodRequest::where('status', 'approved')->count();
                            } catch (\Exception $e) {
                                echo '0';
                            }
                        @endphp
                    </h2>
                    <p class="text-muted">Successful Donations</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold text-danger mb-0">
                        @php
                            try {
                                echo \App\Models\User::where('role', 'patient')->count();
                            } catch (\Exception $e) {
                                echo '0';
                            }
                        @endphp
                    </h2>
                    <p class="text-muted">Registered Patients</p>
                                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold text-danger mb-0">
                        @php
                            try {
                                echo \App\Models\Center::count();
                            } catch (\Exception $e) {
                                echo '0';
                            }
                        @endphp
                    </h2>
                    <p class="text-muted">Blood Centers</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
        <div class="container py-5">
            <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="display-5 mb-4">Ready to Save Lives?</h2>
                <p class="lead mb-4">Join our community of blood donors and help save lives today.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-danger btn-lg">Get Started</a>
                @endguest
            </div>
        </div>
                    </div>
                </div>
                
<style>
.hero-section {
    background: linear-gradient(to right, #dc3545 50%, #f8f9fa 50%);
    min-height: 480px;
    overflow: hidden;
}

.hero-content {
    padding: 60px 0;
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.95) 50%, rgba(248, 249, 250, 0.95) 50%);
}

.hero-image {
    position: relative;
    z-index: 1;
    padding: 15px;
    display: flex;
    justify-content: center;
}

.hero-image img {
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.hero-image img:hover {
    transform: translateY(-5px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

@media (max-width: 991.98px) {
    .hero-section {
        background: #dc3545;
    }
    
    .hero-content {
        background: rgba(220, 53, 69, 0.95);
        padding: 60px 0;
    }
    
    .hero-image {
        margin-top: 40px;
    }
}
</style>
@endsection