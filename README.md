# Mobile Tencent Analytics HTML5

PHP SDK for Mobile Tencent Analytics HTML5

<div>
  <p align="">
    <a href="LICENSE">
      <image src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License">
    </a>
    <a href="https://scrutinizer-ci.com/g/freyo/mta-h5">
      <image src="https://img.shields.io/scrutinizer/g/freyo/mta-h5.svg?style=flat-square" alt="Quality Score">
    </a>
    <a href="https://packagist.org/packages/freyo/mta-h5">
      <image src="https://img.shields.io/packagist/v/freyo/mta-h5.svg?style=flat-square" alt="Packagist Version">
    </a>
  </p>
</div>

## Installation

  ```shell
  composer require freyo/mta-h5
  ```

## Bootstrap

  ```php
  <?php
  use Freyo\MtaH5\Application;

  include __DIR__ . '/vendor/autoload.php';

  $config = [
      'app_id' => 'your-app-id',
      'secret_key' => 'your-secret-key',
  ];
  
  $app = new Application($config);
  
  ```
### API

```php
$app->trend->query($startDate, $endDate);
$app->trend->realtime();
$app->trend->heartbeat();

$app->user->realtime($page = 1);
$app->user->compare($startDate, $endDate);
$app->user->portrait($startDate, $endDate);

$app->device->query($startDate, $endDate, $typeId, $typeContents = []);
$app->device->operator($startDate, $endDate, $typeIds);
$app->device->area($startDate, $endDate, $typeIds);
$app->device->province($startDate, $endDate, $typeIds);

$app->page->realtime();
$app->page->offline($startDate, $endDate, $page = 1);
$app->page->query($startDate, $endDate, $urls);
$app->page->depth($startDate, $endDate);
$app->page->speed($startDate, $endDate, $typeContents, $type);

$app->custom->query($startDate, $endDate, $custom);

$app->source->query($startDate, $endDate, $urls);
$app->source->land($startDate, $endDate, $urls);
$app->source->leave($startDate, $endDate, $urls);

$app->adtag->query($startDate, $endDate, $adTags);
```

## Use in Laravel
  
**Laravel 5.5+ uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.**

```php
$app = app('mta-h5');
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Ffreyo%2Fmta-h5.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Ffreyo%2Fmta-h5?ref=badge_large)
