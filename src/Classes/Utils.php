<?php

namespace Mrapps\EmailBundle\Classes;

class Utils
{
    public static function troncaStringa($stringa = '', $lengthNeeded = 100, $stripTags = true)
    {

        $lengthNeeded = intval($lengthNeeded);
        if (($lengthNeeded <= 0) && !$stripTags) return $stringa;

        if ($stripTags) $stringa = strip_tags($stringa);

        $parts = preg_split('/([\s\n\r]+)/', $stringa, null, PREG_SPLIT_DELIM_CAPTURE);
        $parts_count = count($parts);

        $length = 0;
        $last_part = 0;
        for (; $last_part < $parts_count; ++$last_part) {
            $length += strlen($parts[$last_part]);
            if ($length > $lengthNeeded) {
                break;
            }
        }

        $output = trim(implode(array_slice($parts, 0, $last_part)));
        if (substr($output, strlen($output) - 1, 1) != '.') {
            $output .= '...';
        }

        return $output;
    }
}
