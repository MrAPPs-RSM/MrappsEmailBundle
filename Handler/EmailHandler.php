<?php

namespace Mrapps\EmailBundle\Handler;

use Symfony\Component\DependencyInjection\Container;
use Mrapps\EmailBundle\Classes\EmailStyle;

class EmailHandler
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * compone un'email html partendo dai dati passati.
     *
     * @param array $emailParts array che contiene la struttura della email da comporre
     * @param string $logoUrl url assoluto immagine logo
     * @param string $companyName nome azienda che invia la email
     * @param string $street via dell'azienda
     * @param string $otherInfo campo in cui mettere altre info (per esempio telefono)
     *
     * @return string html generato
     *
     */
    public function composeEmail($emailParts = array(), $logoUrl = null, $companyName = null, $street = null, $otherInfo = null)
    {
        $style = new EmailStyle($this->container);

        return $this->container->get("twig")->render('MrappsEmailBundle:Email:index.html.twig', array(
            /*stile email*/
            "background_color" => $style->getBackgroundColor(),
            "content_color" => $style->getContentColor(),
            "bold_color" => $style->getBoldColor(),
            "text_color" => $style->getTextColor(),
            "main_color" => $style->getMainColor(),
            "main_color_hover" => $style->getMainColorHover(),
            "text_on_main_color" => $style->getTextOnMainColor(),
            /* dati email*/
            'logo_url' => $logoUrl,
            'company_name' => $companyName,
            'street' => $street,
            'other_info' => $otherInfo,
            "email_parts" => $emailParts));
    }

}