<?php namespace CompassHB\Www\Repositories\Photo;

use Log;
use Cache;

class SmugmugPhotoRepository implements PhotoRepository
{
    private $url = 'https://compasshb.smugmug.com/hack/feed.mg?Type=nicknameRecentPhotos&Data=compasshb&format=rss200&Size=Medium';

    public function __construct()
    {
    }

    /**
     * Shows most recent photos on /photos page.
     *
     * @return array
     */
    public function getRecentPhotos()
    {
        if (Cache::has('getrecentphotos')) {
            return Cache::get('getrecentphotos');
        }

        $feedUrl = $this->url;
        $num = 40;

        $rawFeed = file_get_contents($feedUrl);
        $xml = new \SimpleXmlElement($rawFeed);
        $results = array();

        for ($i = 0; $i < $num; $i++) {
            // Parse Image Link
                $link = $xml->channel->item->link;
            $link = substr($link->asXML(), 6, -7);

                // Parse Image Source
                $namespaces = $xml->channel->item[$i]->getNameSpaces(true);
            $media = $xml->channel->item[$i]->children($namespaces['media']);
            $image = $media->group->content[3]->attributes();
            $image = $image['url']->asXML();
            $image = substr($image, 6, -1);

            $results[] = array($link, $image);
        }

        Cache::add('getrecentphotos', $results, '340');

        return $results;
    }

    public function getPhotos($num = 4)
    {
        if (Cache::has('getphotos'.$num)) {
            return Cache::get('getphotos'.$num);
        }

        // Smugmug
        $feedUrl = 'https://compasshb.smugmug.com/hack/feed.mg?Type=userkeyword&NickName=compasshb&Data=featured&format=rss200&Size=Medium';

        $rawfeed = '';
        $results = array();

        try {
            $rawFeed = file_get_contents($feedUrl);
            $xml = new \SimpleXmlElement($rawFeed);
        } catch (\Exception $e) {
            Log::warning('Connection refused to photos.compasshb.com');

            return $results;
        }
        $count = ($xml->channel->item->count() <= $num) ? $xml->channel->item->count() : $num;

        $i = 0;
        while ($i < $count)
{
            // Parse Image Link
            $link = $xml->channel->item[$i]->link;
            $link = substr($link->asXML(), 6, -7);

            // Parse Image URL
            $image = $xml->channel->item[$i]->guid;

            // Replace HTTP call with HTTPS
            $image = str_replace('http://', 'https://', $image);

            $results[] = array($link, $image);
            $i++;
        }

        Cache::add('getphotos'.$num, $results, '340');

        return $results;
    }
}
