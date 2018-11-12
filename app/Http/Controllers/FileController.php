<?php

namespace app\Http\Controllers;

/**
 * Akkar Group - Files Manager Controller
 *
 * @author  Julio Hernandez <jhernandez@yezzcorp.com>
 */

use Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use app\Http\Controllers\Response;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

    /**
     * The default image.
     *
     * @var string
     */
    private $defaultImage = 'images/nopic.png';

    /**
     * Images path.
     *
     * @var string
     */
    private $baseDir = 'images';

    /**
     * Show the images requested.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $file
     * @return Intervention\Image\Facades\Image $image
     */
    public function img(Request $request, $file)
    {
        $img = $this->getPath($file);

        return $this->retrieveImage($img, $request->only(['w', 'h']));
    }

    public function showFile($order, $type, $file)
    {
        $path = storage_path()."/files/documents/$order/$type";

        if (!file_exists("$path/$file") || !is_file("$path/$file")) {
            return $this->notFound();
        }
        $finfo=finfo_open(FILEINFO_MIME_TYPE);
        header('Content-Type: '.finfo_file($finfo, "$path/$file"));
        readfile("$path/$file");
    }

    protected function notFound()
    {
        abort(404);
    }

    /**
     * Get image path and validate if the file given meets the validation rules.
     *
     * @param  string $file
     * @return string $path
     */
    private function getPath($file)
    {
        $file = storage_path() . '/' . $this->baseDir . '/' . $file;

        return (file_exists($file) && $this->isValid($file)) ? $file : storage_path() . '/' . $this->defaultImage;

    }

    /**
     * Validate a image format.
     *
     * @param  string $file
     * @param  string $type
     * @return boolean $valid
     */
    private function isValid($file, $type = 'img')
    {
        switch ($type) {
            case 'img': return preg_match('/\.(gif|png|jpe?g)$/', $file);
        }

        return false;
    }

    /**
     * Retrieve one image from the storage folder. Also, it validates
     * if there was a redimention request to return the imagen size
     * required by the user.
     *
     * @param  string $file
     * @param  array  $resize
     * @return Intervention\Image\Facades\Image $image
     */
    private function retrieveImage($file, $resize = [])
    {
        $img = Image::make($file);

        if ($resize['w'] != null || $resize['h'] != null) {

            $w = $resize['w'] != null ? $resize['w'] : null;
            $h = $resize['h'] != null ? $resize['h'] : null;

            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

        }

        return $img->response();
    }
}
