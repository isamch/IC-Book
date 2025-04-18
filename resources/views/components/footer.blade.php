<!-- Footer Section -->
<footer class="bg-gray-800 py-6 text-center">
    <div class="flex justify-center space-x-4">
        @foreach (['facebook-f', 'twitter', 'instagram', 'linkedin', 'pinterest'] as $icon)
            <a href="#" class="text-white">
                <i class="fab fa-{{ $icon }}"></i>
            </a>
        @endforeach
    </div>
</footer>
