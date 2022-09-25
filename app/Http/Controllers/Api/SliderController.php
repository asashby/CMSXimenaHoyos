<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Slider;

class SliderController extends Controller
{
    public function index()
    {
        return [
            'data' => Slider::query()->with(['product'])->get()->append([
                'full_url_image'
            ])
        ];
    }
}
