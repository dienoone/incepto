<?php

namespace App\Helpers;

use App\Enums\ImageEntity;
use App\Enums\ImageType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageGeneratorHelper
{
    /**
     * Build the full directory path.
     * e.g., "avatars/seekers", "logos/companies"
     */
    private static function buildPath(ImageType $type, ?ImageEntity $entity = null): string
    {
        return $entity
            ? "{$type->value}/{$entity->value}"
            : $type->value;
    }

    /**
     * Download image from URL and store it locally.
     */
    private static function downloadAndStore(string $url, ImageType $type, ?ImageEntity $entity = null): string
    {
        $response = Http::withOptions([
            'allow_redirects' => true,
            'verify'          => false,
            'timeout'         => 30,
        ])->get($url);

        if (!$response->successful()) {
            return $url;
        }

        $extension = self::guessExtension($response->header('Content-Type'));
        $directory = self::buildPath($type, $entity);
        $filename  = $directory . '/' . Str::uuid() . '.' . $extension;

        Storage::disk('public')->put($filename, $response->body());

        return $filename;
    }

    /**
     * Guess file extension from Content-Type header.
     */
    private static function guessExtension(?string $contentType): string
    {
        return match ($contentType) {
            'image/png'     => 'png',
            'image/gif'     => 'gif',
            'image/webp'    => 'webp',
            'image/svg+xml' => 'svg',
            default         => 'jpg',
        };
    }

    /**
     * Resolve the final output: stored path or external URL.
     */
    private static function resolve(string $url, bool $store, ImageType $type, ?ImageEntity $entity): string
    {
        return $store
            ? self::downloadAndStore($url, $type, $entity)
            : $url;
    }

    /**
     * Convert a stored path to a full URL for views.
     * Works with both local paths and external URLs.
     */
    public static function url(?string $path): string
    {
        if (!$path) {
            return '';
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return asset('storage/' . $path);
    }

    /**
     * Real photo from picsum.photos
     */
    public static function generateRealImage(
        int          $width  = 200,
        int          $height = 200,
        ?int         $num    = null,
        ImageType    $type   = ImageType::IMAGE,
        ?ImageEntity $entity = null,
        bool         $store  = true
    ): string {
        $num = $num ?? fake()->numberBetween(1, 1000);
        $url = "https://picsum.photos/{$width}/{$height}?random={$num}";

        return self::resolve($url, $store, $type, $entity);
    }

    /**
     * Text-based avatar/logo from ui-avatars.com
     */
    public static function generateFakeAvatar(
        ?string      $name   = null,
        ImageType    $type   = ImageType::LOGO,
        ?ImageEntity $entity = null,
        bool         $store  = true
    ): string {
        $logo = $name ?? fake()->name();
        $url  = 'https://ui-avatars.com/api/?name=' . urlencode($logo)
            . '&size=200'
            . '&background=' . str_replace('#', '', fake()->hexColor())
            . '&color=ffffff'
            . '&bold=true'
            . '&format=png';

        return self::resolve($url, $store, $type, $entity);
    }

    /**
     * Random human avatar from pravatar.cc
     */
    public static function generateRealAvatar(
        ?int         $num    = null,
        ImageType    $type   = ImageType::AVATAR,
        ?ImageEntity $entity = null,
        bool         $store  = true
    ): string {
        $num = $num ?? fake()->numberBetween(1, 70);
        $url = "https://i.pravatar.cc/150?img={$num}";

        return self::resolve($url, $store, $type, $entity);
    }
}
