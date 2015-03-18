
  composer.json

    "require-dev": {
          "ivanmijatovic89/proto-view-generator":  "dev-master"
  	},
    "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/ivanmijatovic89/proto-maker-generator"
      }
    ],

  add to `app/config/app.php`

```php
   'ivanmijatovic89\ProtoViewGenerator\ProtoViewGeneratorServiceProvider',
   'dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider',
```