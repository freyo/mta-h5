# Mobile Tencent Analytics HTML5

PHP SDK for Mobile Tencent Analytics HTML5

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