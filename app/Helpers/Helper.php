<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function imageUpload($file, $filepath = 'uploads')
    {
        $path = $file->store('public/'.$filepath);
        return Storage::url($path);
    }
    public static function deleteImage($filePath)
    {

        try
        {
            if ($filePath && Storage::disk('public')->exists($filePath))
            {
                return Storage::disk('public')->delete($filePath);
            }
        }
        catch (\Exception $e)
        {
            Log::error('Image Deletion Error: ' . $e->getMessage());
        }
        return false;
    }
}
?>
