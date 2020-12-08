<?php

abstract class PublicBase
{
    /**
     * Generates uuid
     * @return string
     */
    public static function makeHash()
    {
        return sprintf( '%04x%04x%04x',
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}