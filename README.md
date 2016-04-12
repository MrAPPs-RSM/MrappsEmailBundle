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

