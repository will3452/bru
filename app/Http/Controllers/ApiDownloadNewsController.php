<?php

namespace App\Http\Controllers;

use App\Newspaper;
use ZipArchive;

class ApiDownloadNewsController extends Controller
{
    public function download()
    {

        $newspaper = Newspaper::get();

        $zipname = "newspaper.zip";

        $files = [];

        foreach ($newspaper as $n) {

            foreach ($n->pages as $page) {
                $files[] = substr($page->content, 1);
            }

        }

        $zip = new ZipArchive;

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
