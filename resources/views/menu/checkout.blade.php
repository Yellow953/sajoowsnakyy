@extends('menu.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">

<header class="checkout-header shadow-sm">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('menu') }}" class="btn btn-dismiss">
                <i class="fas fa-chevron-left"></i>
                Menu
            </a>
            <a href="{{ route('menu') }}">
                <img src="{{ asset('assets/images/yellowpos_black_transparent_bg.png') }}" class="logo-img" width="60"
                    height="60">
            </a>
            <a href="{{ route('menu') }}">
                <span class="logo-text ms-2">Sajoo w Snakee</span>
            </a>
        </div>
    </div>
</header>

<div class="container checkout-container">
    <!-- Stepper -->
    <div class="stepper mb-4">
        <div class="stepper-progress">
            <div class="stepper-progress-bar" style="width: 33.33%"></div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="stepper-item active">
                <div class="stepper-icon text-white"><i class="fas fa-info-circle"></i></div>
                <div class="stepper-title mt-2">Information</div>
            </div>
            <div class="stepper-item">
                <div class="stepper-icon"><i class="fas fa-truck"></i></div>
                <div class="stepper-title mt-2">Delivery</div>
            </div>
            <div class="stepper-item">
                <div class="stepper-icon"><i class="fa-solid fa-receipt"></i></div>
                <div class="stepper-title mt-2">Summary</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Checkout Form -->
        <div class="col-lg-8 offset-md-2 mb-4">
            <form class="multi-step-form" action="#" enctype="multipart/form-data">
                @csrf

                <!-- Step 1 -->
                <div class="step active" data-step="1">
                    <div class="card order-summary p-5">
                        <h3 class="mb-4">Order Information</h3>
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <label for="name" class="required mb-2">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-12 my-2">
                                <label for="phone" class="required mb-2">Phone</label>
                                <input type="phone" name="phone" class="form-control" placeholder="70 285 659" required>
                            </div>

                            <div class="col-md-6 mt-2 mb-4">
                                <label for="order_type" class="required mb-2">Order Type</label>
                                <select name="order_type" class="form-select" id="order_type" required>
                                    <option value="store">In Store</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="payment_method" class="required mb-2">Payment Method</label>
                                <select name="payment_method" class="form-select" id="payment_method" required>
                                    <option value="cash">Cash On Delivery</option>
                                    <option value="whish">Whish Payment</option>
                                </select>
                            </div>
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-yellow next-step">Continue <i
                                        class="fas fa-arrow-right ms-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step" data-step="2">
                    <div class="card order-summary p-5">
                        <h3 class="mb-4">Delivery Details</h3>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="map-card">
                                    <div class="form-group position-relative">
                                        <input type="text" id="autocomplete" class="form-control form-control-lg"
                                            placeholder="Enter your address">
                                        <small class="instruction-text">Start typing your address or use your current
                                            location</small>
                                    </div>

                                    <div class="map-container">
                                        <button id="current-location" class="current-location-btn" type="button">
                                            <i class="fas fa-location-arrow me-2"></i>Use Current Location
                                        </button>
                                        <div id="map"></div>
                                    </div>

                                    <!-- Hidden Fields -->
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <input type="hidden" name="formatted_address" id="formatted_address">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-dismiss prev-step"><i
                                        class="fas fa-arrow-left me-2"></i>Back</button>
                                <button type="button" class="btn btn-yellow next-step">Continue <i
                                        class="fas fa-arrow-right ms-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step" data-step="3">
                    <div class="card order-summary p-5">
                        <h2 class="mb-4">Order Summary</h2>

                        <div id="orderSummary">
                            <!-- Items will be dynamically added here -->
                        </div>

                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span id="checkoutSubtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Delivery</span>
                                <span>Free</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span id="checkoutTotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total LBP</span>
                                <span id="checkoutTotalLBP">0.00LBP</span>
                            </div>
                        </div>

                        <div class="mt-4 secure-note text-center">
                            <i class="fas fa-lock me-1"></i>
                            Secure checkout
                            <i class="fa-brands fa-whatsapp me-1 ms-2"></i>
                            Whatsapp
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <button type="button" class="btn btn-dismiss prev-step"><i
                                    class="fas fa-arrow-left me-2"></i>Back</button>
                            <button type="submit" class="btn btn-yellow" id="submitBtn">Confirm Order <i
                                    class="fas fa-check me-2"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('scripts.checkout')
@endsection