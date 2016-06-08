<?php

namespace Mrapps\EmailBundle\Controller;

use Mrapps\EmailBundle\Classes\EmailStyle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Mrapps\EmailBundle\Classes\EmailPart;

class EmailController extends Controller
{
    /**
     * @Route("/_email/preview")
     * @Method({"GET"})
     */
    public function previewAction()
    {

        $style=new EmailStyle($this->container);

        return $this->render('MrappsEmailBundle:Email:index.html.twig', array(
            /*stile email*/
            "background_color" => $style->getBackgroundColor(),
            "content_color" => $style->getContentColor(),
            "bold_color" => $style->getBoldColor(),
            "text_color" => $style->getTextColor(),
            "main_color" => $style->getMainColor(),
            "main_color_hover" => $style->getMainColorHover(),
            "text_on_main_color" => $style->getTextOnMainColor(),
            /* dati email*/
            'logo_url' => 'http://placehold.it/200x50',
            'company_name' => 'Azienda di test',
            'street' => 'Via Da Quella Parte 12, 1234 DoveTiPare',
            // 'other_info' => '4326574382',

            /*test*/
            "email_parts" => array(
                array("type" => EmailPart::Image, "image_url" => "http://placehold.it/600x300"),
                array("type" => EmailPart::OneColText, "title" => "Benvenuto!", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat.", "link" => "http://www.google.it", "link_title" => "Va al sito"),
                array("type" => EmailPart::BgImageWithText, "background_url" => "http://placehold.it/600x230/AE3742/C3505B", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat."),
                array("type" => EmailPart::TwoEvenColsXs, "title" => "Titolo 2 colonne", "xs_invariate" => false, "rows" => array(array("image_url" => "http://placehold.it/270", "description" => "descrizione breve 1"), array("image_url" => "http://placehold.it/270", "description" => "descrizione breve 2"), array("image_url" => "http://placehold.it/270", "description" => "descrizione breve 3"))),
                array("type" => EmailPart::ThreeEvenColsXs, "title" => "Titolo 3 colonne", "rows" => array(array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 1"), array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 2"), array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 3"), array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 4"))),
                array("type" => EmailPart::ThumbnailText, "image_url" => "http://placehold.it/170", "title" => "Maecenas sed ante pellentesque, posuere leo id", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat."),
                array("type" => EmailPart::ThumbnailText, "direction" => "left", "link" => "http://www.google.it", "link_title" => "Vai al sito", "image_url" => "http://placehold.it/170", "title" => "Maecenas sed ante pellentesque, posuere leo id", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat."),
            )));
    }
}
