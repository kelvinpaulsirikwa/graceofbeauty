@extends('websitepages.layouts.app')

@section('title', 'Home')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet">
@endpush

@section('content')

@include('websitepages.homepage.categories-section', ['categories' => $categories ?? collect()])


@include('websitepages.homepage.products-section', ['products' => $products ?? collect(), 'allCategories' => $allCategories ?? collect(), 'productAttributes' => $productAttributes ?? collect()])

@include('websitepages.homepage.brandfeatured', ['hotTrendBrands' => $hotTrendBrands ?? collect(), 'bestSellerProducts' => $bestSellerProducts ?? collect(), 'featuredProducts' => $featuredProducts ?? collect()])

@include('websitepages.payment.payment', ['payments' => $payments ?? collect()])

@endsection
