<?php

declare(strict_types=1);

namespace App\Utilities;

class LocationUtility
{
    /**
     * Generate google map image url.
     * https://maps.googleapis.com/maps/api/staticmap?center=53.456388,-2.616447&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7C53.456388,-2.616447&key=sampleKeyHere.
     */
    public static function generateGoogleMapImageUrl(\App\Models\Branch $branch): ?string
    {
        if (empty($branch)) {
            return null;
        }
        $googleMapBaseUrl = config('map.base_url');
        if (empty($googleMapBaseUrl)) {
            return null;
        }
        if (empty($branch->latitude) || empty($branch->longitude)) {
            return null;
        }

        return $googleMapBaseUrl.'?center='.$branch->latitude.','.$branch->longitude.'&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7C'.$branch->latitude.','.$branch->longitude.'&key='.config('map.api_key');
    }

    /**
     * Generate google map url.
     * https://www.google.com/maps/search/?api=1&query=53.456388,-2.616447.
     */
    public static function generateGoogleMapUrl(\App\Models\Branch $branch): ?string
    {
        if (empty($branch)) {
            return null;
        }
        $googleMapWebBaseUrl = config('map.web_base_url');
        if (empty($googleMapWebBaseUrl)) {
            return null;
        }
        if (empty($branch->latitude) || empty($branch->longitude)) {
            return null;
        }

        return $googleMapWebBaseUrl.'dir/?api=1&destination='.$branch->latitude.','.$branch->longitude;
    }
}
