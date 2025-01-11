<?php

use Illuminate\Support\Facades\View;
use Nozom\LandingPagePackage\Core\Utility;

define("HTML", "Html");
define("COLOR", "Color");
define("SWITCH_TYPE", "Switch");
define("IMAGE", "Image");
define("SVG", "Svg");
define("SINGLE_TAG", "Singel tag");
define("IMAGE_URL", "Image Url");


function getViewPath($viewName)
{
    try {
        // Use the View finder to get the path of the view
        return View::getFinder()->find($viewName);
    } catch (\InvalidArgumentException $e) {
        // Handle the case where the view does not exist
        return false;
    }
}

function upload_file($request, $key_name, $name, $path, $custom_validation = [])
{


    try {
        $settings = Utility::getAdminPaymentSettings();
        if (!empty($settings['storage_setting'])) {

            if ($settings['storage_setting'] == 'wasabi') {

                config(
                    [
                        'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                        'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                        'filesystems.disks.wasabi.region' => $settings['wasabi_region'],
                        'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                        'filesystems.disks.wasabi.endpoint' => 'https://s3.' . $settings['wasabi_region'] . '.wasabisys.com'
                    ]
                );

                $max_size = !empty($settings['wasabi_max_upload_size']) ? $settings['wasabi_max_upload_size'] : '2048';
                $mimes = !empty($settings['wasabi_storage_validation']) ? $settings['wasabi_storage_validation'] : '';
            } else if ($settings['storage_setting'] == 's3') {
                config(
                    [
                        'filesystems.disks.s3.key' => $settings['s3_key'],
                        'filesystems.disks.s3.secret' => $settings['s3_secret'],
                        'filesystems.disks.s3.region' => $settings['s3_region'],
                        'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                        'filesystems.disks.s3.use_path_style_endpoint' => false,
                    ]
                );
                $max_size = !empty($settings['s3_max_upload_size']) ? $settings['s3_max_upload_size'] : '2048';
                $mimes = !empty($settings['s3_storage_validation']) ? $settings['s3_storage_validation'] : '';
            } else {

                $max_size = !empty($settings['local_storage_max_upload_size']) ? $settings['local_storage_max_upload_size'] : '2048';

                $mimes = !empty($settings['local_storage_validation']) ? $settings['local_storage_validation'] : '';
            }

            if (!is_string($key_name)) {
                $file = $key_name;
            } else
                $file = $request->$key_name;


            if (count($custom_validation) > 0) {
                $validation = $custom_validation;
            } else {

                $validation = [
                    'mimes:' . $mimes,
                    'max:' . $max_size,
                ];
            }
            if (is_string($key_name))
                $validator = \Validator::make($request->all(), [
                    $key_name => $validation
                ]);
            if (is_string($key_name))
                if ($validator->fails()) {
                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];
                    return $res;
                }

            $name = $name;

            if ($settings['storage_setting'] == 'local') {
                // dd($name);
                // dd($request->$key_name);
                $file = $request->$key_name;

                $fileName = $file->getClientOriginalName();

                $fileNameSlug = str()->slug(pathinfo($fileName, PATHINFO_FILENAME));

                $fileExtension = $file->getClientOriginalExtension();

                $randomName = \Str::random(40);
                $fullSlugFileNameHash = $randomName . "." . $fileExtension;
                $fullSlugFileName = $fileNameSlug . "." . $fileExtension;
                if ($name == "test" || $name == "") {
                    $request->$key_name->move(storage_path("/app/public/" . $path), $fullSlugFileNameHash);

                    $path = $path . $fullSlugFileNameHash;
                } else {
                    $request->$key_name->move(storage_path("/app/public/" . $path), $name);
                    $path = $path . $name;
                }
            } else if ($settings['storage_setting'] == 'wasabi') {

                $path = \Storage::disk('wasabi')->putFileAs(
                    $path,
                    $file,
                    $name
                );

                // $path = $path.$name;

            } else if ($settings['storage_setting'] == 's3') {

                $path = \Storage::disk('s3')->putFileAs(
                    $path,
                    $file,
                    $name
                );
                // $path = $path.$name;
                // dd($path);
            }


            $res = [
                'flag' => 1,
                'msg' => 'success',
                'url' => $path,
                "http_url" => url("storage/") . "/" . $path ,
                'hash_file_name' => $fullSlugFileNameHash ?? "",
                "file_name" => $fullSlugFileName ?? "",
                "random_name" => $randomName ?? ""

            ];
            // dd($res);
            return $res;
        } else {
            $res = [
                'flag' => 0,
                'msg' => __('Please set proper configuration for storage.'),
            ];
            return $res;
        }
    } catch (\Exception $e) {
        $res = [
            'flag' => 0,
            'msg' => $e->getMessage(),
        ];
        return $res;
    }
}