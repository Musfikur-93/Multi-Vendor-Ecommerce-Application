@extends('frontend.master_dashboard')
@section('main')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Vendor Details <span></span> {{ $vendor->name }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="archive-header-2 text-center pt-80 pb-50">
        <h1 class="display-2 mb-50">{{ $vendor->name }}</h1>
    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($vporduct) }}</strong> items for you!</p>
                </div>
            </div>
            <div class="row product-grid">

                @foreach ($vporduct as $product)

                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                        <img class="default-img" src="{{asset($product->product_thambnail)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount/$product->selling_price) * 100;
                                @endphp

                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($product->discount_price == NULL)
                                        <span class="new">New</span>
                                    @else
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @endif

                                </div>
                            </div>

                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                </div>
                                <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ Str::limit($product->product_name,30) }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>

                                <div>
                                    @if ($product->vendor_id == NULL)
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                    @else
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                    @endif
                                </div>

                                <div class="product-card-bottom">

                                    @if ($product->discount_price == NULL)
                                        <div class="product-price">
                                            <span>${{ $product->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $product->discount_price }}</span>
                                            <span class="old-price">${{ $product->selling_price }}</span>
                                        </div>
                                    @endif

                                    <div class="add-cart">
                                        <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach

            </div>
            <!--product grid-->

            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--End Deals-->
        </div>

        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo):url('upload/no_image.jpg') }}" alt="" />
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                    </div>
                    <h4 class="mb-5"><a href="vendor-details-1.html" class="text-heading">{{ $vendor->name }}</a></h4>
                    <div class="product-rate-cover mb-15">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                    </div>
                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>

                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span> {{ $vendor->address }}</span></li>
                            <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span> {{ $vendor->phone }}</span></li>
                        </ul>
                        <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
