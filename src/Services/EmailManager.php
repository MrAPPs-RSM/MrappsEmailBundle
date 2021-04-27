<?php

namespace Mrapps\EmailBundle\Services;

use Mrapps\EmailBundle\Classes\EmailStyle;
use Swift_Message;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class EmailManager
{
    /**@var \Twig_Environment $twig */
    private $twig;

    /**@var \Swift_Mailer $mailer */
    private $mailer;

    /**@var ParameterBagInterface $parameters */
    private $parameters;

    /**@var EmailStyle $style */
    private $style;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function setParameters(ParameterBagInterface $params)
    {
        $this->parameters = $params;
        $this->style = new EmailStyle($params);
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
        if ($emailParts === null ||
            $logoUrl === null ||
            $companyName === null ||
            $street === null
        ) {
            return null;
        }

        return $this->twig->render('MrappsEmailBundle:Email:index.html.twig',
            [
                /*stile email*/
                "background_color" => $this->style->getBackgroundColor(),
                "content_color" => $this->style->getContentColor(),
                "bold_color" => $this->style->getBoldColor(),
                "text_color" => $this->style->getTextColor(),
                "main_color" => $this->style->getMainColor(),
                "main_color_hover" => $this->style->getMainColorHover(),
                "text_on_main_color" => $this->style->getTextOnMainColor(),
                /* dati email*/
                'logo_url' => $logoUrl,
                'company_name' => $companyName,
                'street' => $street,
                'other_info' => $otherInfo,
                "email_parts" => $emailParts]
        );
    }

    /**
     * invia un'email partendo dai dati passati.
     *
     * @param string $subject soggetto email
     * @param $from
     * @param array $to riceventi
     * @param array $emailParts array che contiene la struttura della email da comporre
     * @param string $logoUrl url assoluto immagine logo
     * @param string $companyName nome azienda che invia la email
     * @param string $street via dell'azienda
     * @param string $otherInfo campo in cui mettere altre info (per esempio telefono)
     *
     * @param array | string $bcc email che ricevono in copia il messaggio
     * @return  boolean operazione completata
     */
    public function sendEmail($subject, $from, $to, $emailParts, $logoUrl, $companyName, $street, $otherInfo = null, $bcc = null)
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

        $body = $this->composeEmail($emailParts, $logoUrl, $companyName, $street, $otherInfo);

        $message = (new Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, "text/html");

        if($bcc){
            $message->setBcc($bcc);
        }

        return $this->mailer->send($message);
    }

}
