<?php namespace app\Helpers;

/**
 * Akkar Global Services - Files Validations Helper
 *
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 */

use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File {
    /**
     * $default_path
     * It is the folder where all the files will be stored
     * @var string
     */
    private static $default_path = '';

    /**
     * $sections
     * It contains the validation rules which will be used in upload process
     * @var [type]
     */
    private static $sections =
        [
        'default' => ['path' => 'documents', 'secure_path' => true, 'type' => 'all', 'valid' => '/[\.\/](.+)$/i'],
        'profile_img' => ['path' => 'profile_img', 'secure_path' => true, 'filesystem' => 's3', 'type' => 'img', 'valid' => '/[\.\/](jpe?g|png)$/i', 'maxwidth' => 2048, 'square' => true],
        'product_key' => ['path' => 'products/key_code', 'type' => 'text', 'code' => true, 'valid' => '/[\.\/](txt)$/i'],
        'product_software' => ['path' => 'products/software', 'type' => 'compact', 'code' => true, 'valid' => '/[\.\/](zip|rar)$/i'],
    ];

    //variables
    private static $full_path = '';
    private $options = [];

    public function __construct($options = []) {
        $this->options = $options;
        return $this;
    }

    /**
     * metodo "section" declarado con  __callStatic & __call
     * para que pueda llamarse de forma estatica y dimanica
     * @param  [type] $name      [description]
     * @param  array  $arguments [description]
     * @return [type]            [description]
     */
    public static function __callStatic($name, array $arguments) {
        if ($name == 'section') {
            $file = new File();
            return $file->callableSection($arguments[0], @$arguments[1]);
        }
    }
    public function __call($name, array $arguments) {
        if ($name == 'section') {
            return $this->callableSection($arguments[0], @$arguments[1]);
        }
    }

    private function callableSection($section = '', $clean = false) {
        return $this->setting(self::$sections[$section ?: 'img'], $clean);
    }

    public function setting(array $options, $clean = false) {
        if (@$clean) {
            $this->options = [];
        }
        $this->options = $this->options + $options;
        return $this;
    }

    /**
     * upload
     * this method allows uploading one or more than one file
     * @param  [object] $files catains all the file information
     * @return [array] returns an array with the file(s) uploaded
     */
    public function upload($files) {
        //checking if it's just one file
        if ($files instanceof UploadedFile) {
            $many = false;

            //more than one file
        } elseif (is_array($files)) {
            $many = true;

            //there was no files selected
        } else {
            return '';
        }

        //one file validation
        if (!$many) {
            $files = [$files];
        }

        /**
         * $uploaded
         * It is the array that will contains all the uploaded files information
         * @var array
         */
        $uploaded = [];
        foreach ($files as $file) {
            $info = (object) pathinfo(strtolower($file->getClientOriginalName()));
            $options = (object) $this->options;

            //setting file path
            $path = (@$options->secure_path) ? [(@$options->filesystem == 's3' ? null : storage_path().'/'.self::$default_path), $options->path] : [(@$options->filesystem == 's3' ? null : public_path()), $options->path];
            if (@$options->code && \Auth::check()) {
                if (@$options->code_value) {
                    $path[] = $options->code_value;
                } else {
                    $path[] = \Auth::id();
                }
            }
            //subfolder define in options
            if (@$options->subpath) {
                $path[] = $options->subpath;
            }
            
            //file type validation - if file type or any file type are allowed
            if ((!isset($options->valid) || preg_match($options->valid, '.' . $info->extension)) && $file->isValid()) {
                //subfolder
                $path = implode('/', $path);

                //destiny file
                $file_destiny = md5(time()) . '.' . $info->extension;

                switch (@$options->filesystem) {
                    case 's3':
                        $filePath = $path.'/'.$file_destiny;
                        $response = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
                        if ($response) {
                            $uploaded[] = $filePath;
                        } else {
                            $uploaded[] = "Error: " . trans('messages.globals.file_upload_error');
                        }
                        
                        break;
                    
                    default:
                        //folder validation - if there is not folder, it will be created
                        if (!is_dir($path)) {
                            mkdir($path, 0777, true);
                        }

                        //uploading file
                        $return = $file->move($path, $file_destiny);

                        //normalization of the file sent
                        $this->normalice("$path/$file_destiny");
                        
                        //keeping the uploaded file path
                        $uploaded[] = explode((@$options->secure_path) ? self::$default_path : public_path(), str_replace('\\', '/', $return))[1];
                        
                        break;
                }

            } else {

                $MaxFilesize = File::formatBytes($file->getMaxFilesize());
                $uploaded[] = "Error: " . trans('messages.globals.file_maxsize_error', ['MaxFilesize' => $MaxFilesize]);
            }
        }

        return $many ? $uploaded : $uploaded[0];
    }

    /**
     * Delete a file
     * $file = Patch
     * $secure_path = storage path (true) or public path (false)
     */
    public static function deleteFile($file, $filesystem = 'default', $secure_path = true) {
        
        $path = explode('/', $file);

        switch ($filesystem) {
            case 's3':
                if(Storage::disk('s3')->exists($file)) {
                    return Storage::disk('s3')->delete($file) ? 0 : 1;
                }
                break;
            
            default:
                $file = (($secure_path) ? storage_path().'/'.self::$default_path : public_path()).$file;
                if (file_exists($file)) {
                    unlink($file);
                    return file_exists($file) ? 0 : 1;
                } 
                
                break;
        }
        return 0;
    }

    /**
     * normalice
     * This method controlls files size and shape
     * @param  [object] $file file to evaluated
     * @return [object] $file file normalized
     */
    public function normalice($file) {
        $info = (object) pathinfo($file);
        $options = (object) $this->options;

        //images control
        if (@$options->type == 'img') {
            $img = \Image::make($file);
            $maxwidth = @$options->maxwidth ?: null;
            $maxheight = @$options->maxheight ?: null;

            //resizing images
            if (@$options->square) {
                //square picture
                $height = $img->height();
                $width = $img->width();
                $offset = floor(abs($width - $height) / 2);
                if ($height > $width) {
                    $img->crop($width, $width, 0, $offset);
                } else {
                    $img->crop($height, $height, $offset, 0);
                }
            }

            if ($maxwidth || $maxheight) {
                $img->resize($maxwidth, $maxheight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $img->save();
        }
        return $this;
    }

    public static function formatBytes($size, $precision = 2) {
        $base = log($size, 1024);
        $suffixes = array('', 'k', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }
}
