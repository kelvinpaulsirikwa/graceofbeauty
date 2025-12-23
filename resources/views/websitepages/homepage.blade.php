@extends('websitepages.layouts.app')

@section('title', 'Home')

@push('styles')
<link href="{{ asset('css/fonts/playfair/playfair.css') }}" rel="stylesheet">
@endpush

@section('content')

@include('websitepages.homepage.categories-section', ['categories' => $categories ?? collect()])


@include('websitepages.homepage.products-section', ['products' => $products ?? collect(), 'allCategories' => $allCategories ?? collect(), 'productAttributes' => $productAttributes ?? collect()])

@include('websitepages.homepage.brandfeatured', ['hotTrendBrands' => $hotTrendBrands ?? collect(), 'bestSellerProducts' => $bestSellerProducts ?? collect(), 'featuredProducts' => $featuredProducts ?? collect()])

@include('websitepages.payment.payment', ['payments' => $payments ?? collect()])

@endsection
