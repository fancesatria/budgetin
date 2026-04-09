@extends('layouts.fullscreen-layout')

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="relative h-[115vh] w-full bg-[linear-gradient(to_bottom,#D9E7F6_43%,#B5CFED_100%)]">
            {{-- Logo --}}
            <div class="pl-31 pt-13">
                <img class="w-40" src="/images/logo/logo.png" />
            </div>
            
            {{-- Content --}}
            <div class="flex flex-1 pt-29 pl-31">
                <div class="w-[45%] flex flex-col gap-10">
                    <h1 class="text-7xl font-medium">
                        Take Control of Your Finances, <br> Effortlessly
                    </h1>
                    <p class="text-xl font-light">
                        Track your income, manage expenses, and plan your financial future with a simple yet powerful platform.
                    </p>
                    <a href="{{ route('login') }}" class="bg-white w-40 h-15 rounded-full text-lg flex items-center justify-center">
                        Get Started
                    </a>
                </div>
                <div class="w-[55%] flex justify-center">
                    <img src="/images/landing.png" alt="Landing page asset" class="max-w-[80%] h-auto">
                </div>
            </div>
            <div class="absolute bottom-0 w-full h-[120px] bg-white-def rounded-t-[100%]"></div>
        </div>
        <div class="h-screen">
        </div>
    </div>
@endsection
