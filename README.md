# okezoneid-php-oauth2

#How To Use
Inlcude the okezoneid folder to your library folder

Fill these items with client,  secret id and redirect _url
```php
$this->oauth2_client_id = '90115be9b31d99709292bbcf0a1ff801cfb6a844d0687076dd9e308e6ad9a89b';'
$this->oauth2_secret = '47a2090a38124a12649cbe84bb8c33059e95f6d2918c3f330cacde750d9253c8';
$this->oauth2_redirect = 'http://phpdemo.okezone.com/okeid-php/login.php';
$this->oauth2_url = "http://ssodev.okezone.com/"; 
```

note: for production oauth2_url will use : https://id.okezone.com

#Example
The Example file is login.php, demo.php, and comment.php


