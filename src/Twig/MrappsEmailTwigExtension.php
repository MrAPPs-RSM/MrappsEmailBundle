<?php

namespace Mrapps\EmailBundle\Twig;

use Twig_Extension;
use Mrapps\EmailBundle\Classes\Utils;

class MrappsEmailTwigExtension extends Twig_Extension {

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions() {
        return array();
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('tronca', function($string, $length, $stripTags = false) {
                return Utils::troncaStringa($string, $length, $stripTags);
            }),
        );
    }

    /**
     * @return string
     */
    public function getName() {
        return 'mrapps_email_twig_extension';
    }
}
