<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Process and store an image with optional resizing
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int|null $width Maximum width (null = no resize)
     * @param int|null $height Maximum height (null = no resize)
     * @param bool $maintainAspectRatio
     * @param int $quality JPEG quality (1-100)
     * @return string Path to stored image
     */
    public static function processAndStore(
        UploadedFile $file,
        string $folder,
        ?int $width = null,
        ?int $height = null,
        bool $maintainAspectRatio = true,
        int $quality = 85
    ): string {
        // Create ImageManager with GD driver
        $manager = ImageManager::gd();
        
        // Read the uploaded file
        $image = $manager->read($file->getPathname());

        // Resize if dimensions are provided
        if ($width || $height) {
            if ($maintainAspectRatio) {
                // Scale down maintaining aspect ratio
                $image->scaleDown($width, $height);
            } else {
                // Cover the dimensions (crop to fit)
                $image->cover($width ?? $image->width(), $height ?? $image->height());
            }
        }

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $filename;
        $fullPath = Storage::disk('public')->path($path);

        // Ensure directory exists
        Storage::disk('public')->makeDirectory($folder);

        // Encode and save image with quality setting
        $extension = strtolower($file->getClientOriginalExtension());
        if (in_array($extension, ['jpg', 'jpeg'])) {
            $encoded = $image->encode(new JpegEncoder($quality));
        } elseif ($extension === 'png') {
            $encoded = $image->encode(new PngEncoder());
        } elseif ($extension === 'webp') {
            $encoded = $image->encode(new WebpEncoder($quality));
        } else {
            $encoded = $image->encode();
        }

        // Save the encoded image
        $encoded->save($fullPath);

        return $path;
    }

    /**
     * Process product image (optimized for product display)
     */
    public static function processProductImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'product_images', 1200, 1200, true, 85);
    }

    /**
     * Process product front image (thumbnail)
     */
    public static function processProductFrontImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'products', 800, 800, true, 85);
    }

    /**
     * Process service image
     */
    public static function processServiceImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'service_images', 1200, 1200, true, 85);
    }

    /**
     * Process service front image
     */
    public static function processServiceFrontImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'services', 800, 800, true, 85);
    }

    /**
     * Process user/profile image (square, smaller)
     */
    public static function processUserImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'users', 400, 400, true, 90);
    }

    /**
     * Process category image
     */
    public static function processCategoryImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'categories', 800, 800, true, 85);
    }

    /**
     * Process brand image
     */
    public static function processBrandImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'brands', 600, 600, true, 85);
    }

    /**
     * Process leadership team image
     */
    public static function processLeadershipTeamImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'leadership_teams', 500, 500, true, 90);
    }

    /**
     * Process user feedback image
     */
    public static function processUserFeedbackImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'user_feedbacks', 1200, 1200, true, 85);
    }

    /**
     * Process payment image
     */
    public static function processPaymentImage(UploadedFile $file): string
    {
        return self::processAndStore($file, 'payments', 600, 400, false, 85);
    }
}

