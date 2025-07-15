@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{!! $page->hero_title ?? 'Get in <br> touch' !!}</h1>
        </div>
    </header>

    @php
        $content = $page->content;
    @endphp

    <section class="contact">
        <div class="contact__info">
            <p class="contact__title">{{ $content['contact_details']['title'] ?? 'Contact details:' }}</p>
            <p class="contact__description">{!! $content['contact_details']['office_address'] ?? 'Office address: <br>
                <br>
                1 Waterside <br>
                Station Road <br>
                Harpenden <br>
                AL5 4US' !!}
            </p>
            <p class="contact__description">
                {{ $content['contact_details']['registered_label'] ?? 'Registered address:' }}
            </p>
            <p class="contact__description">
                {!! $content['contact_details']['registered_address'] ?? 'Unit 4 <br>
                The Edge Business Park <br>
                Brownfields <br>
                Welwyn Garden City <br>
                Hertfordshire <br>
                AL7 1WX' !!}
            </p>
        </div>
        <form class="contact__form" method="POST" action="{{ route('contact.submit', app()->getLocale()) }}">
            @csrf
            <label for="first-name">{{ __('First name') }}*</label>
            <input type="text" id="first-name" name="first_name" required>
            
            <label for="last-name">{{ __('Last name') }}*</label>
            <input type="text" id="last-name" name="last_name" required>
            
            <label for="company">{{ __('Company') }}</label>
            <input type="text" id="company" name="company">
            
            <label for="your-site">{{ __('Your site') }}*</label>
            <select name="site_type" id="your-site">
                <option value="residential-apartment">{{ __('Residential Apartment') }}</option>
                <option value="hotel-and-leisure">{{ __('Hotel & Leisure') }}</option>
                <option value="holiday-park">{{ __('Holiday park') }}</option>
                <option value="workplace">{{ __('Workplace') }}</option>
            </select>
            
            <label for="address">{{ __('Address') }}</label>
            <input type="text" id="address" name="address">
            
            <label for="city">{{ __('City') }}</label>
            <input type="text" id="city" name="city">
            
            <label for="post-code">{{ __('Post code') }}*</label>
            <input type="text" id="post-code" name="post_code" required>
            
            <label for="email">{{ __('Email') }}*</label>
            <input type="email" id="email" name="email" required>
            
            <label for="telephone">{{ __('Telephone') }}</label>
            <input type="tel" id="telephone" name="telephone">
            
            <label for="message">{{ __('Please tell us a bit about your site') }}</label>
            <textarea id="message" name="message"></textarea>
            
            <div class="contact__checkbox">
                <input type="checkbox" id="privacy" name="privacy" required>
                <label for="privacy">{{ __('I agree with the privacy statement') }}*</label>
            </div>
            
            <button type="submit" class="circleBg-btn contact__button">
                <span>{{ __('Send message') }}</span>
                <div class="_i_bg"></div>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    @endpush
@endsection