<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

function uploadFile($file, $folder)
{
    $ext = $file->getClientOriginalExtension();
    if ($file->isValid()) {
        $file_name = $folder . '_' . date('YmdHis') . ".$ext";
        $file->storeAs($folder, $file_name, 'public');
        return $file_name;
    }
    return false;
}

function updateFile($data, $path, $file, $folder)
{
    $exist = file_exists(storage_path('app/public/' . $path . '/' . $data));
    if (isset($data) && $exist) {
        Storage::delete('public/' . $path . '/' . $data);
    }
    $ext = $file->getClientOriginalExtension();
    if ($file->isValid()) {
        $file_name = $folder . '_' . date('YmdHis') . ".$ext";
        $file->storeAs($folder, $file_name, 'public');
        return $file_name;
    }
    return false;
}

function deleteFile($data, $path)
{
    $exist = file_exists(storage_path('app/public/' . $path . '/' . $data));
    if (isset($data) && $exist) {
        Storage::delete('public/' . $path . '/' . $data);
    }
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