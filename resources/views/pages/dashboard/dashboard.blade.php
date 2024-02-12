@extends('layouts.app')

@section('header')
    <header class="bg-white shadow m-2 rounded-md">
        <div class="mx-auto max-w-7xl px-2 py-2 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
            </div>
            <div class="">
                <a href="" class="relative inline-flex items-center justify-center p-2 px-6 py-1 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-gray-800 rounded-full shadow-md group">
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gray-800 group-hover:translate-x-0 ease">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span> 
                    <span class="absolute flex items-center justify-center w-full h-full text-black transition-all duration-300 transform group-hover:translate-x-full ease">Create Post</span>
                    <span class="relative invisible">Create Post</span>
                </a>

            </div>

        </div>
    </header>
@endsection

{{-- @section('exited')   

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900 italic">just funn! 🐳</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 quote">
                Footer element can be used to display a site map, followed by copyright information and social media icons.

                Additional navigation on the page includes basic support content such as links, buttons, company information, copyright and forms. The footer can be easily customized to fit your style and is responsive by default.
            </p>
        </div>
    </div>

@endsection --}}

@section('content')   
    <div class="min-h-full">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>Footer element can be used to display a site map, followed by copyright information and social media icons.

                Additional navigation on the page includes basic support content such as links, buttons, company information, copyright and forms. The footer can be easily customized to fit your style and is responsive by default.</p>
        </div>
    </div>

@endsection