<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 12:21
 */
declare(strict_types=1);

namespace rest\services;

use Yii;
use yii\helpers\Url;

/**
 * Class ParseContentService
 * @package rest\services
 */
class ParseContentService
{
    const TYPE_ATTR_SRC = 'src';
    const NO_IMG_NAME = 'no_image.png';

    /**
     * @param string $url
     * @return string|null
     */
    public function saveFile($url)
    {
        $noImgLink = Url::to('/img/' . self::NO_IMG_NAME, true);
        //Download the file using file_get_contents.
        try {
            $downloadedFileContents = file_get_contents($url);
        } catch (\Exception $exception) {
            return $noImgLink;
        }

        //Check to see if file_get_contents failed.
        if ($downloadedFileContents === false) {
            return $noImgLink;
        }

        $ext = pathinfo($url, PATHINFO_EXTENSION);
        if ($ext) {
            $fileName = time() . '_' . md5($url) . '.' . $ext;
        } else {
            $fileName = time() . '_' . md5($url);
        }
        $fullName = Yii::getAlias('@rest') . '/web/mirror-files/' . $fileName;
        $save = file_put_contents($fullName, $downloadedFileContents);

        if ($save) {
            return $this->getFileLink($fileName);
        }

        return $noImgLink;
    }

    /**
     * @param $filename
     * @return string
     */
    public function getFileLink($filename)
    {
        return Url::to('/mirror-files/' . $filename, true);
    }

    /**
     * @param $htmlString
     * @param bool $getAttrs
     * @return array
     */
    public function getImages($htmlString)
    {
        $postImages = [];

        // Get all images
        preg_match_all('/<img (.+)>/', $htmlString, $imageMatches, PREG_SET_ORDER);

        // Loop the images and add the raw img html tag to $post_images
        foreach ($imageMatches as $imageMatch) {
            preg_match_all('/\s+?(.+)="([^"]*)"/U', $imageMatch[0], $imageAttrMatches, PREG_SET_ORDER);

            foreach ($imageAttrMatches as $imageAttr) {
                if ($imageAttr[1] == self::TYPE_ATTR_SRC) {
                    $postImages[] = $imageAttr[2];
                }
            }
        }

        return $postImages;
    }

    /**
     * @param $html
     * @return mixed
     */
    function mirrorImageInContent($html)
    {
        if (!$html) {
            return $html;
        }

        $images = $this->getImages($html);

        foreach ($images as $image) {
            //download image
            $newImageLink = $this->saveFile($image);
            $html = str_replace($image, $newImageLink, $html);
        }

        return $html;
    }
}