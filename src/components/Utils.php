<?php


class Utils
{
    public static function hash()
    {
        return sprintf( '%04x%04x%04x',
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}
