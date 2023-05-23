<?php

namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use App\Helpers\UploadFilesHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function store_file($options = [])
    {
        $options = array_merge([
            //'source'=>"",
            'validation' => "file",
            'path_to_save' => '/uploads/',
            'type' => '',
            'type_id' => "",
            'user_id' => null,
            'resize' => [400, 15000],
            'small_path' => 'small/',
            'visibility' => 'PUBLIC',
            'file_system_type' => env('FILESYSTEM_DRIVER', 's3'),
            'optimize' => false,
            'new_extension' => "",
            'used_at' => null,
        ], $options);
        return UploadFilesHelper::store_file($options);
    }

    public function remove_hub_file($name)
    {
        return UploadFilesHelper::remove_hub_file($name);
    }

    public function use_hub_file($name, $type_id, $user_id = null, $is_main = 0)
    {
        return UploadFilesHelper::use_hub_file($name, $type_id, $user_id = null, $is_main = 0);
    }

    /**
     * Add text to image and save with the same name
     *
     * @param string $imagePath The path to the image file
     * @param string $text      The text to add to the image
     * @param integer $fontSize The font size to use for the text (optional, defaults to 100)
     */
    function appendWaterMark($imagePath)
    {
        UploadFilesHelper::appendWaterMark($imagePath);
    }
}
