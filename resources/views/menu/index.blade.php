@extends('menu.app')

@section('content')
<div class="container-md padding-0">
    <!-- Hero Image Section -->
    <div class="restaurant-banner " id="banner"
        style="background-image: url({{ asset('assets/images/menu/menu-hero.jpg')}});">
        <div class="banner-overlay">
        </div>
    </div>
    <div class="menu-bg mx-custom px-3 py-5">
        <!-- Restaurant Details -->
        <div class="d-flex justify-content-center align-items-center justify-content-center">
            <div class="d-flex card restaurant-details text-center mb-4 box-shadow">
                <h1 class="fw-bold">Sajoo w Snakee</h1>
                <hr class="w-100 divider">
                <p class="mb-1">{{ $business->phone }}</p>
                <p class="mb-1">{{ $business->address }}</p>
                @if ($business->google_maps_link)
                <p class="mb-1">
                    <a href="{{ $business->google_maps_link }}" class="text-yellow" target="blank">
                        <i class="fa-solid fa-location-dot"></i>
                        visit us
                    </a>
                </p>
                @endif
            </div>
        </div>
        <!-- Menu Categories -->
        <div
            class="d-flex flex-nowrap gap-3 py-3 justify-content-start overflow-x-auto w-100 menu-categories custom-rounded">
            <div class="card category-div box-shadow mb-2">
                <a href="{{ route('menu', $business->name) }}#all" class="d-flex flex-column align-items-center">
                    <button class="btn btn-custom rounded-pill fw-bold pb-0">All</button>
                </a>
            </div>
            @foreach ($categories as $category)
            <div class="card category-div box-shadow mb-2">
                <a href="{{ route('menu', $business->name) }}#{{ $category->name }}"
                    class="d-flex flex-column align-items-center">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image">
                    <button class="btn btn-custom rounded-pill fw-bold pb-0">{{ ucwords($category->name) }}</button>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Menu Items -->
        <div id="menuItems" class="px-md-5 px-2">
            <h2 class="text-yellow text-center fw-bold ms-md-5 fs-1 mt-5">MENU</h2>
            <div id="all"></div>

            @foreach ($products as $index => $productGroup)
            <h3 class="fw-bold ms-md-5 fs-2 mt-4" id="{{ $productGroup[0]->category->name ?? '' }}">{{
                ucwords($productGroup[0]->category->name ?? '') }}</h3>

            <div class="row">
                @foreach ($productGroup as $product)
                <!--Item Link-->
                <a data-bs-toggle="modal" data-bs-target="#productModal"
                    class="col-md-6 dim-on-hover rounded product-item" data-name="{{ ucwords($product->name) }}"
                    data-price="{{ number_format($product->price, 2, '.', '') }}"
                    data-description="{{ $product->description }}" data-image="{{ asset($product->image) }}">
                    <div class="row me-md-3 justify-content-center justify-content-md-between">
                        <div class="col-5 col-md-3 justify-content-center justify-content-md-end">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="menu-img">
                        </div>
                        <div class="col-6 col-md-8 mt-3">
                            <div class="d-flex flex-column ms-md-5">
                                <p class="mb-1 ms-md-2 fs-5">{{ ucwords($product->name) }}</p>
                                <p class="mb-1 ms-md-2 text-muted fs-6">
                                    {{ $product->description }}
                                </p>
                                <div class="d-flex align-items-end justify-content-between my-1 ms-md-2 fw-bold fs-5">
                                    <span class="text-muted ms-2 fs-5">${{ number_format($product->price,
                                        2)}}</span>
                                    <span class="text-muted-custom ms-2 fs-7">
                                        {{ number_format($product->price * $rate,2) }}LBP
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 my-auto">
                            <button type="button" class="btn px-3 py-2 fs-6 btn-atb-quick">
                                <i class="fa-solid fa-bag-shopping p-0"></i></button>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <hr>
            @endforeach
        </div>

        <div class="row mb-4" id="business">
            <!-- Business Hours -->
            <div class="offset-md-3 col-md-6 mt-4 mb-5 px-md-5">
                <h4 class="fw-bold mb-3">Business Hours</h4>
                <div class="business-hours p-3 custom-rounded text-center">
                    @foreach ($operating_hours as $oh)
                    <p class="my-1">{{ $oh->day }}:
                        @if($oh->open)
                        {{ $oh->opening_hour }} - {{ $oh->closing_hour }}
                        @else
                        Closed
                        @endif
                    </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('menu._nav')
@include('menu._product')
@include('menu._bag')
@include('menu._scripts')

@endsection