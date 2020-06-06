# QX (or QueryX) Is a PHP Web Framework
This Framework processor in MVC Pattern 
so all code look likes beautiful code

And this version is "Beta 1", I tries to develop and did it better
> (Sorry I can't used English to good, but I can explain a little bit)

It seems like a basic, actually it's very basic for use.

## Template for use
My framework have template Controller and Model for you, It's in folder `system/template/..`

__Example: Controller__
```php
<?php

    /**
     * Controller
     * Created by QueryX Command
     */
    use QueryX\Common\Controller;
    use QueryX\Support\Loader;

    class %className% extends Controller {

        function __construct($request) {
            parent::__construct($request);
            # ...
        }

        // Your code
        public function index() {
            # ...
        }

    }

?>
```

## I'll tell you about View
In Framework I used Blade Template (Standalone Version). You can see how it do at below

__Example__
```php
<?php 

    /*
        In QueryX\Support\Loader;
        It in have method for call
        1. view('view_name', ['var' => 'data'])
        2. controller('controller@method')
        3. model('model')
        4. database()->getInstance()
        5. core() and helper(), when you call core or helper you can call ->get(boolean) in back
                                                                            true = will require in app/core, app/helper
                                                                            false = will require in system/core, system/helper
    */
    use QueryX\Support\Loader;
    
    # I show you how it do
    echo Loader::view('folder.subfolder.view');
?>
```

# Credit PHP Libraries
Database - [catfan/medoo](https://packagist.org/packages/catfan/medoo)
Router - [bramus/router](https://packagist.org/packages/bramus/router)
Blade Template [jenssegers/blade](https://packagist.org/packages/jenssegers/blade)

# Contact me
Facebook - [Kittichai Mala-in](https://facebook.com/frammhe)
Instagram - [framy.malain](https://instagram.com/framy.malain)
