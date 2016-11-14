<?php

namespace Mrapps\EmailBundle\Classes;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class EmailStyle
{
    private $backgroundColor;

    private $contentColor;

    private $boldColor;

    private $textColor;

    private $mainColor;

    private $mainColorHover;

    private $textOnMainColor;

    public function __construct(ParameterBagInterface $params)
    {
        $this->backgroundColor = $params->get('mrapps_email.style.background_color');
        $this->contentColor = $params->get('mrapps_email.style.content_color');

        $this->boldColor = $params->get('mrapps_email.style.bold_color');
        $this->textColor = $params->get('mrapps_email.style.text_color');
        $this->mainColor = $params->get('mrapps_email.style.main_color');
        $this->mainColorHover = $params->get('mrapps_email.style.main_color_hover');
        $this->textOnMainColor = $params->get('mrapps_email.style.text_on_main_color');
    }

    /**
     * @return mixed
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @return mixed
     */
    public function getContentColor()
    {
        return $this->contentColor;
    }

    /**
     * @return mixed
     */
    public function getBoldColor()
    {
        return $this->boldColor;
    }

    /**
     * @return mixed
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @return mixed
     */
    public function getMainColor()
    {
        return $this->mainColor;
    }

    /**
     * @return mixed
     */
    public function getMainColorHover()
    {
        return $this->mainColorHover;
    }

    /**
     * @return mixed
     */
    public function getTextOnMainColor()
    {
        return $this->textOnMainColor;
    }


}