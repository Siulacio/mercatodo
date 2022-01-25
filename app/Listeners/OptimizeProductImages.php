<?php

namespace App\Listeners;

use App\Events\ProductSaved;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OptimizeProductImages
{
    public function __construct()
    {
    }

    public function handle(ProductSaved $event) : void
    {
        $optimizeImage = Image::make(Storage::disk('public')->get($event->image->image))
            ->widen(config('utilities.image_width_optimize'))
            ->limitColors(config('utilities.limit_colors_image'))
            ->encode();

        Storage::disk('public')->put($event->image->image, (string) $optimizeImage);
    }
}
