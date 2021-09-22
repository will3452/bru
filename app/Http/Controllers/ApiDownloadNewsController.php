<?php

namespace App\Http\Controllers;

use App\Newspaper;
use ZipArchive;

class ApiDownloadNewsController extends Controller
{
    public function download($id)
    {

        $newspaper = Newspaper::find($id);

        $zipname = "newspaper.zip";

        $files = $newspaper->pages->pluck('content');

        $zip = new ZipArchive();

        $zip->open($zipname, ZipArchive::CREATE);

        foreach ($files as $file) {
            $zip->addFile($file);
        }

        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }
}
