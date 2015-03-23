
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
[https://github.com/caffeinated/modules](https://github.com/caffeinated/modules)

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
publish config file - look at docs

### Translations

Instal Laravel-Translatable

[https://github.com/dimsav/laravel-translatable](https://github.com/dimsav/laravel-translatable)

#### Step 1: Install translation package

Add the package in your composer.json by executing the command.

```bash
composer require dimsav/laravel-translatable
```

Next, add the service provider to `app/config/app.php`

```
'Dimsav\Translatable\TranslatableServiceProvider',
```

#### Step 2: Publish Translation Config

```bash
php artisan vendor:publish
//or
php artisan vendor:publish --provider="Dimsav\Translatable\TranslatableServiceProvider"
```


### Examples with command line

Than to make module type:
```
php artisan module:make vendor
```

than create crud
```
php artisan proto vendor --fields='{"name":{"type":"text"},"user_id":{"type":"integer","relation":{"class":"\\App\\User","field":"email","name":"user","type":"hasOne"}}}' --data='{"namespace":"App\\Modules\\Vendor\\"}'  --output="App/Modules/Vendor"  --output="App/Modules/Vendor" --template="modul" -r
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


