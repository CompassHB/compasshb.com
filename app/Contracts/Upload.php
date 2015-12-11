<?php

namespace CompassHB\Www\Contracts;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface Upload
{
    public function uploadAndSaveS3(UploadedFile $file, $folder);
}
