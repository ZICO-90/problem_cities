<?php
namespace App\Http\Traits ;

use Illuminate\Support\Facades\File;
trait uplaodTrait
{

    private function uploadImage($file, $fileName, $path, $oldFile = null)
    {
        $file->move( $path, $fileName);

        if(!is_null($oldFile))
        {
            File::delete($oldFile);
        }
    }


}