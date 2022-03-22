<?php
/**
 * Project Kyrie - An Arkan App service oriented to the health area.
 * Created by:
 *  > Mauricio Cruz Portilla <mauricio.portilla@hotmail.com>
 * 
 * This project was created in the hope that it will be useful for any
 * professionist from this area.
 * 
 * July 21st, 2020
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrivateImagesManager extends Controller {
    /**
     * Creates a new instance.
     */
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Returns the content of a private file stored in a disk.
     *
     * @param string $disk
     * @param string $fileName
     * @return mixed
     */
    public function getPictureFile(string $disk, string $fileName) {
        return Storage::disk($disk)->get($fileName);
    }
}
