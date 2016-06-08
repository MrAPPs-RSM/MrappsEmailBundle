<?php

namespace Mrapps\EmailBundle\Classes;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Utils
{
    public static function sendEmail(ContainerInterface $container, $subject = "", $from = null, $to = null, $emailParts = null, $logoUrl = null, $companyName = null, $street = null, $otherInfo = null)
    {
        if ($from === null ||
            $to === null ||
            $emailParts === null ||
            $logoUrl === null ||
            $companyName === null ||
            $street === null
        ) {
            return false;
        }

        $body = $container->get("mrapps.email")->composeEmail($emailParts, $logoUrl, $companyName, $street, $otherInfo);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, "text/html");

        $container->get("mailer")->send($message);
    }

    public static function troncaStringa($stringa = '', $lengthNeeded = 100, $stripTags = true) {

        $lengthNeeded = intval($lengthNeeded);
        if(($lengthNeeded <= 0) && !$stripTags) return $stringa;

        if($stripTags) $stringa = strip_tags($stringa);

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

        return implode(array_slice($parts, 0, $last_part))."...";
    }
}