<div class="flex justify-center gap-2 mb-2">
    @if (count($images) > 0)
        @foreach ($images as $index => $image)
            <div class="relative">
                <button wire:click="removePic({{ $index }})" type="button"
                    class="absolute top-0 right-1 text-red-600" title="delete image">
                    <i class="fa-solid fa-circle-minus"></i>
                </button>
                <img src="{{ asset($image) }}" alt="product image" width="100">
            </div>
        @endforeach
    @endif

</div>
