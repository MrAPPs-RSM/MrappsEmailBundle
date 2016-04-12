<?php

namespace Mrapps\EmailBundle\Classes;

class EmailStyle
{
    private $backgroundColor;

    private $contentColor;

    private $boldColor;

    private $textColor;

    private $mainColor;

    private $mainColorHover;

    private $textOnMainColor;

    public function __construct($container)
    {
        $this->backgroundColor = $container->getParameter('mrapps_email.style.background_color');
        $this->contentColor = $container->getParameter('mrapps_email.style.content_color');

        $this->boldColor = $container->getParameter('mrapps_email.style.bold_color');
        $this->textColor = $container->getParameter('mrapps_email.style.text_color');
        $this->mainColor = $container->getParameter('mrapps_email.style.main_color');
        $this->mainColorHover = $container->getParameter('mrapps_email.style.main_color_hover');
        $this->textOnMainColor = $container->getParameter('mrapps_email.style.text_on_main_color');
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