<?php

namespace CompassHB\Www\Repositories\Upload;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadRepository
{
    public function uploadAndSaveS3(UploadedFile $file, $folder);
}
