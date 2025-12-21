@extends('websitepages.layouts.app')

@section('title', 'Home')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;700&display=swap" rel="stylesheet">
@endpush

@section('content')

@include('websitepages.homepage.categories-section', ['categories' => $categories ?? collect()])

@include('websitepages.homepage.products-section', ['products' => $products ?? collect(), 'allCategories' => $allCategories ?? collect(), 'productAttributes' => $productAttributes ?? collect()])
@endsection
