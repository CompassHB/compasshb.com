<?php

namespace CompassHB\Www\Repositories\Upload;

use Aws\S3\S3Client;
use CompassHB\Www\Contracts\Upload as Contract;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AwsUploadRepository implements Contract
{
    private $client;
    private $key;
    private $secret;
    private $region;

    /**
     * Initialize object and authenticate.
     */
    public function __construct()
    {
        $this->key = env('AWS_ACCESS_KEY');
        $this->secret = env('AWS_SECRET_KEY');
        $this->region = env('AWS_REGION');

        $this->client = S3Client::factory(array(
            'credentials' => array('key' => $this->key, 'secret' => $this->secret),
            'region' => $this->region,
            'version' => '2006-03-01',
        ));
    }

    /**
     * Accepts a file from a form upload and
     * saves it to AWS S3 returning the URL.
     *
     * @param UploadedFile $file
     * @param $folder
     * @return string
     * @internal param $UploadedFile
     * @internal param $string
     *
     */
    public function uploadAndSaveS3(UploadedFile $file, $folder)
    {
        $response = $this->client->putObject(array(
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $folder.'/'.$file->getClientOriginalName(),
            'SourceFile' => $file->getRealPath(),
            'ContentType' => $file->getClientMimeType(),
            'ACL' => 'public-read',
        ));

        return $response['ObjectURL'];
    }
}
