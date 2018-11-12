<?php namespace app\Helpers;

/**
 * Akkar Global Services - File Manager Helper
 *
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 */

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUpload extends UploadedFile
{

    /**
     * $default_path
     * It is the folder where all the files will be stored
     * @var string
     */
    private static $default_path = 'files';
    
    private static $full_path = '';
    private $options = [];

    /**
     * $sections
     * It contains the options which will be used in upload process
     * @var [type]
     */
    private static $sections = [
        'default' => ['path' => 'documents', 'secure_path' => true, 'filesystem' => 'default', 'type' => 'all', 'valid' => '/[\.\/](.+)$/i'],
        'profile_img' => ['path' => 'profile_img', 'secure_path' => true, 'filesystem' => 's3', 'type' => 'img', 'valid' => '/[\.\/](jpe?g|png)$/i', 'maxwidth' => 600, 'square' => true],
    ];
}
