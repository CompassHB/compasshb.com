<?php

namespace CompassHB\Www\Repositories\Transcoder;

use Bugsnag;
use CompassHB\Www\Contracts\Transcoder as Contract;

class ZencoderTranscoderRepository implements Contract
{
    private $key;
    private $zencoder;
    private $bucket = 's3://compasshb/media/';

    public function __construct()
    {
        $this->key = env('ZENCODER_KEY', '');
        $this->zencoder = new \Services_Zencoder($this->key);
    }

    public function saveAudio($url, $slug)
    {
        try {
            $encoding_job = $this->zencoder->jobs->create(
                array(
                    'input' => $url,
                    'outputs' => array(
                        array(
                            'base_url' => $this->bucket,
                            'filename' => $slug.'.mp3',
                            'format' => 'mp3',
                            'public' => true,
                        ),
                    ),
                )
            );
        } catch (\Services_Zencoder_Exception $e) {
            Bugsnag::notifyError('Error', 'MP3 ZencoderTranscoderRepository Error:'.$e);
        }

        return $encoding_job;
    }
}
