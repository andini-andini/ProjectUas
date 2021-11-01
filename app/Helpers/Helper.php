<?php

namespace App\Helpers;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

function uploadFile($file, $folder)
{
    $filename = $file->getClientOriginalName();
    $endpoint = 'https://objectstorage.ap-osaka-1.oraclecloud.com/p/xGw7JStWR_t3AnrYKstXwoIzL9e-_wOthBqW7xy0s18Y3xBwjY94dAaw7SEhVBrU/n/axg5nyxhqqks/b/hotelly/o/';
    $s3 = new S3Client([
        'region'  => 'ap-osaka-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => 'b4ab70f54693cb202c2b6efd7964754dbab68efb',
            'secret' => '0Z2R0L9WTdnvSuG/KNzA4TDVhIBShLBULkgl96tGes0='
        ],
        'bucket_endpoint' => true,
        'endpoint' => $endpoint
    ]);

    $result = $s3->putObject([
        'Bucket' => 'hotelly',
        'Key' => $filename,
        'SourceFile' => $file,
        'StorageClass' => 'REDUCED_REDUNDANCY'
    ]);
    return $endpoint . 'hotelly/' . $filename;
    // return $result->data['ObjectURL'];
    // $ext = $file->getClientOriginalExtension();
    // if ($file->isValid()) {
    //     $file_name = $folder . '_' . date('YmdHis') . ".$ext";
    //     $file->storeAs($folder, $file_name, 'public');
    //     return $file_name;
    // }
    // return false;
}

function updateFile($data, $path, $file, $folder)
{
    $exist = file_exists(storage_path('app/public/' . $path . '/' . $data));
    if (isset($data) && $exist) {
        Storage::delete('public/' . $path . '/' . $data);
    }
    $ext = $file->getClientOriginalExtension();
    if ($file->isValid()) {
        // $file_name = $folder . '_' . date('YmdHis') . ".$ext";
        // $file->storeAs($folder, $file_name, 'public');
        // return $file_name;
        $filename = $file->getClientOriginalName();
        $endpoint = 'https://objectstorage.ap-osaka-1.oraclecloud.com/p/xGw7JStWR_t3AnrYKstXwoIzL9e-_wOthBqW7xy0s18Y3xBwjY94dAaw7SEhVBrU/n/axg5nyxhqqks/b/hotelly/o/';
        $s3 = new S3Client([
            'region'  => 'ap-osaka-1',
            'version' => 'latest',
            'credentials' => [
                'key'    => 'b4ab70f54693cb202c2b6efd7964754dbab68efb',
                'secret' => '0Z2R0L9WTdnvSuG/KNzA4TDVhIBShLBULkgl96tGes0='
            ],
            'bucket_endpoint' => true,
            'endpoint' => $endpoint
        ]);

        $result = $s3->putObject([
            'Bucket' => 'hotelly',
            'Key' => $filename,
            'SourceFile' => $file,
            'StorageClass' => 'REDUCED_REDUNDANCY'
        ]);
        return $endpoint . 'hotelly/' . $filename;
    }
    return false;
}

function deleteFile($data, $path)
{
    $exist = file_exists(storage_path('app/public/' . $path . '/' . $data));
    if (isset($data) && $exist) {
        Storage::delete('public/' . $path . '/' . $data);
    }
    return false;
}

function autonumber($table, $primary, $prefix)
{
    $q = DB::table($table)->select(DB::raw('MAX(RIGHT(' . $primary . ',5)) as kd_max'));
    $prx = $prefix;
    if ($q->count() > 0) {
        foreach ($q->get() as $k) {
            $tmp = ((int)$k->kd_max) + 1;
            $kd = $prx . sprintf("%06s", $tmp);
        }
    } else {
        $kd = $prx . "000001";
    }
    return $kd;
}

function dateDiffInDays($date1, $date2)
{
    $diff = strtotime($date2) - strtotime($date1);
    return abs(round($diff / 86400));
}
