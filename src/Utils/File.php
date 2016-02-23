<?php

namespace Fsrestapi\Utils;

class File
{
    public static function exists($path)
    {
        return file_exists($path);
    }

    public static function delete($path)
    {
        unlink($path);
    }

    public static function getContent($path)
    {
        return file_get_contents($path);
    }

    public static function setContent($path, $content)
    {
        file_put_contents($path, $content);
    }

    public static function getMetadata($path)
    {
        $result = array();

        $stat = stat($path);

        if (!is_null($stat)) {
            $result['size'] = $stat['size'];
            $result['lastAccessTime'] = date('d.m.Y H:i:s', $stat['atime']);
            $result['lastModificationTime'] = date('d.M.Y H:i:s', $stat['mtime']);
        }

        return $result;
    }
}