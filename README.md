
  composer.json

      "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/ivanmijatovic89/proto-maker-generator"
        }
      ],

  	"require-dev": {

          "ivanmijatovic89/proto-view-generator":  "dev-master",
          "dam1r89/proto-generator": "dev-master"
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
        'HTML' => 'Illuminate\Html\HtmlFacade',
    ]
```

##  Go to `domain.com/protomaker`

### For Modules install
        https://github.com/caffeinated/modules
```
"require": {
    "caffeinated/modules": "~1.0"
   }
```
Service Provider
```
'providers' => [
        'Caffeinated\Modules\ModulesServiceProvider'
        ]
```
Facade
```
'aliases' =>
    [
        'Module' => 'Caffeinated\Modules\Facades\Module'
    ]
```

Than to make module type:
```
php artisan module:make vendor
```

than create crud
```
php artisan proto vendor --fields='{"name":{"type":"text"},"user_id":{"type":"integer","relation":{"class":"\\App\\User","field":"email","name":"user","type":"hasOne"}}}' --output="App/Modules/Vendor"  --output="App/Modules/Vendor" --template="modul" -r
```

than migrate vendor module
```
php artisan module:migrate vendor
```

just for example add POST

```
php artisan module:make post
php artisan proto post --fields='{"name":{"type":"text","validation":"required|max:25|min:8"}, "body":{"type":"text"},"user_id":{"type":"integer","relation":{"class":"\\App\\User","field":"email","name":"user","type":"hasOne"}},"vendors":{"type":"integer","relation":{"class":"\\App\\Modules\\Vendor\\Models\\Vendor","field":"name","name":"vendors","type":"belongsToMany"}}}' --output="App/Modules/Post" --template="modul" -r
php artisan module:migrate post
```

go to domain/vendors


