# Mrapps Email
Gestione email - bundle per Symfony2

## Requisiti

  - PHP 5.4+
  - Symfony2 2.6+

## Installazione

composer.json:
```json
{
	"require": {
		"mrapps/emailbundle": "dev-master"
	}
}
```

AppKernel.php:
```php
$bundles = array(
    [...]
    new Mrapps\EmailBundle\MrappsEmailBundle(),
);
```

routing.yml:
```yaml
mrapps_email:
    resource: "@MrappsEmailBundle/Controller/"
    prefix:   /
```

config.yml: (configurazione minima)
```yaml
mrapps_email:
    style: ~
```

config.yml: (configurazione completa)
```yaml
mrapps_email:
    style:
        background_color: '#F5F5F5'
        content_color: '#FFFFFF'
        bold_color: '#000000'
        text_color: '#555555'
        main_color: '#AE3742'
        main_color_hover: '#882A34'
        text_on_main_color: '#FFFFFF'
```

## Utilizzo

Esempio di compose email:

use Mrapps\EmailBundle\Classes\EmailPart;

....

$this->container->get("mrapps.email")->composeEmail(array(
            array("type" => EmailPart::Image, "image_url" => "http://placehold.it/600x300"),
            array("type" => EmailPart::OneColText, "title" => "Benvenuto!", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat.", "link" => "http://www.google.it", "link_title" => "Va al sito"),
            array("type" => EmailPart::BgImageWithText, "background_url" => "http://placehold.it/600x230/AE3742/C3505B", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat."),
            array("type" => EmailPart::TwoEvenColsXs, "xs_invariate" => false, "rows" => array(array("image_url" => "http://placehold.it/270", "description" => "descrizione breve 1"), array("image_url" => "http://placehold.it/270", "description" => "descrizione breve 2"), array("image_url" => "http://placehold.it/270", "description" => "descrizione breve 3"))),
            array("type" => EmailPart::ThreeEvenColsXs, "rows" => array(array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 1"), array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 2"), array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 3"), array("image_url" => "http://placehold.it/170", "description" => "descrizione breve 4"))),
            array("type" => EmailPart::ThumbnailText, "image_url" => "http://placehold.it/170", "title" => "Maecenas sed ante pellentesque, posuere leo id", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat."),
            array("type" => EmailPart::ThumbnailText, "direction" => "left", "link" => "http://www.google.it", "link_title" => "Vai al sito", "image_url" => "http://placehold.it/170", "title" => "Maecenas sed ante pellentesque, posuere leo id", "description" => "Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat."),
        ),'http://placehold.it/200x50','Azienda di test','Via Da Quella Parte 12, 1234 DoveTiPare'));
        
## Spool messaggi

config.yml:

```yaml
swiftmailer:
    transport: "%mailer_transport%"
    host:      "%mailer_host%"
    username:  "%mailer_user%"
    password:  "%mailer_password%"
    spool:
        type: file
        path: '%kernel.root_dir%/spool'
```

configurare chiamata command 'swiftmailer:pool:send --message-limit=20 --env=prod' per inviare le email dallo spool invece che direttamente prima della response

configurare chiamata command 'mrapps:email:clear-failures' che periodicamente riprova ad inviare i messaggi e li cancella nel caso fallisca

escludere i seguenti file da git:

spool/*.sending
spool/*.loading
spool/*.message
