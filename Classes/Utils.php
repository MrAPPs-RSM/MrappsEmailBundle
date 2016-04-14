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
}