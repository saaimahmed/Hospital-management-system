<?php

namespace App\Helper;

class Helper
{
//  Generate Image Url
    protected static $imageName;
    protected static $imageUrl;

    public static function getImageUrl($image ,$imageDirectory, $modelimage = null)
    {
        if ($image)
        {
            if ($modelimage && file_exists($modelimage))
            {
                unset($modelimage);
            }
            self::$imageName = time().rand(10,1000).'.'.$image->getClientOriginalExtension();
            $image->move($imageDirectory,self::$imageName);
            self::$imageUrl = $imageDirectory.self::$imageName;
        }
        else
        {
            self::$imageUrl = $modelimage;
        }
        return self::$imageUrl;

    }

}
