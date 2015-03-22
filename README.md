
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

          "ivanmijatovic89/proto-view-generator":  "dev-master",
          "dam1r89/proto-generator": "2.0.*"
  	},



add to `app/config/app.php`
```
	'providers' => [
	    ...
	    'ivanmijatovic89\ProtoViewGenerator\ProtoViewGeneratorServiceProvider',
        'dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider',
        'Illuminate\Html\HtmlServiceProvider',
    ]

    'aliases' =>
    [
        ...
        'Form' => 'Illuminate\Html\FormFacade',
        'Html' => 'Illuminate\Html\HtmlFacade',
    ]
```

  Go to `domain.com/protomaker`

  enjoy