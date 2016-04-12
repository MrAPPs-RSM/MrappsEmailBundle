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


## Utilizzo

