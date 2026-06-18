@extends('front.layouts.master')
@section('content')
    <!-- Topbar -->
    @include('front/Partials/Topbar/topbar')

    <!-- Header -->
    @include('front/Partials/Header/header')
    </header>

    <main>
      <!-- Hero -->
       @include('front.Partials.Banners.hero')

      <!-- Categories -->

      <!-- New products -->
       @include('front.Partials.NewProductsList.products')

      <!-- Promo banners -->
     @include('front.Partials.Banners.promo')

      <!-- Brands -->
     @include('front.Partials.Brands.brands')

      <!-- Newsletter -->
      @include('front.Partials.NewsLatter.newsLatter')

  @include('front.partials.Footer.footer')
@endsection
 