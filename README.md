# Install behat on Window 10

## Prerequisites

    1. Git Bash
	2. Chrome Driver 2.35
	3. Selenium 3.9.0
	4. Composer
	5. Xampp with PHP 7.0

## Step to add behat

1. Install behat through composer.json

    ```json
    "behat/behat": "~3.0",
    "behat/mink-goutte-driver": "1.2.1",
    "behat/mink-selenium2-driver": "~1.3.1",
    "behat/mink-extension": "~2.3@dev",
    "emuse/behat-html-formatter": "dev-master"
    ```
		    
## Run Behat Test

## Trouble Shooting

1. Go to this file `vendor\behat\mink-extension\src\Behat\MinkExtension\ServiceContainer\Driver\Selenium2Factory.php`
2. Change this below line

    ```php
   ->booleanNode('marionette')->defaultFalse()->end()
   ->booleanNode('marionette')->defaultNull()->end()
    ```


