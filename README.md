
  composer.json

      "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/ivanmijatovic89/proto-maker-generator"
        },
        {
          "type": "vcs",
          "url": "https://github.com/ivanmijatovic89/laravel-proto-generator"
        }
      ],

  	"require-dev": {
  		"phpunit/phpunit": "~4.0",
  		"phpspec/phpspec": "~2.1",
          "ivanmijatovic89/proto-view-generator":  "dev-master",
          "dam1r89/proto-generator": "2.0.*"
  	},

  add to `app/config/app.php`

```php
   'ivanmijatovic89\ProtoViewGenerator\ProtoViewGeneratorServiceProvider',
   'dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider',
```


  Go to `domain.com/protomaker`

  enjoy