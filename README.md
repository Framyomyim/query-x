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
