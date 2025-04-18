@extends('layouts.main')

@section('title', 'Book Details')

@section('content')

    <div class="flex-grow w-full h-full" style="height: calc(100vh - 50px);">
        <iframe src="{{ asset('storage/' . $ElectronicBook->file) }}" type="application/pdf" class="w-full h-full border-none"
            allowfullscreen>
            <p class="p-4">Your browser doesn't support iframes. <a href="{{ asset('storage/' . $ElectronicBook->file) }}"
                    target="_blank" class="text-green-500 hover:underline">Click here to view the PDF directly</a>.</p>
        </iframe>
    </div>

@endsection
