<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk('backup');


        $files = $disk->files('/Laravel/');

        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                'file_path' => $f,
                'file_name' => str_replace(config('laravel-backup.backup.name') . 'Laravel/', '', $f),
                'file_size' => $disk->size($f),
                'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);
        return view("backend.pages.backup.index")->with(compact('backups'));
    }

    public static function humanFileSize($size, $unit = "")
    {
        if((!$unit && $size >= 1 << 30) || $unit == "GB") {
            return number_format($size / (1 << 30), 2)."GB";
        }
        if((!$unit && $size >= 1 << 20) || $unit == "MB") {
            return number_format($size / (1 << 20), 2)."MB";
        }
        if((!$unit && $size >= 1 << 10) || $unit == "KB") {
            return number_format($size / (1 << 10), 2)."KB";
        }
        return number_format($size)." bytes";
    }

    public function create()
    {
        try {
            /* only database backup*/
            Artisan::call('backup:run --only-db');
            /* all backup */
            /* Artisan::call('backup:run'); */
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
            session()->flash('success', 'Successfully created backup!');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function download($file_name)
    {
        $disk = Storage::disk('backup');
        $file = config('laravel-backup.backup.name') . '/Laravel/' . $file_name;

        if ($disk->exists($file)) {
            $response = new StreamedResponse(function () use ($disk, $file) {
                $stream = $disk->readStream($file);
                fpassthru($stream);
                fclose($stream);
            }, 200, [
                "Content-Type" => $disk->mimeType($file), // Use mimeType method
                "Content-Length" => $disk->size($file),
                "Content-Disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);

            return $response;
        } else {
            abort(404, "Backup file doesn't exist.");
        }
    }
    public function delete($file_name)
    {
        $disk = Storage::disk('backup');
        if ($disk->exists(config('laravel-backup.backup.name') . '/Laravel/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/Laravel/' . $file_name);
            session()->flash('delete', 'Successfully deleted backup!');
            return redirect()->back();
        } else {
            abort(404, "Backup file doesn't exist.");
        }
    }
}
