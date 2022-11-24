<?php
define('ProPayPal', 0);
if(ProPayPal){
    define("PayPalClientId", "*********************");
    define("PayPalSecret", "*********************");
    define("PayPalBaseUrl", "https://api.paypal.com/v1/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "AQKaN1b7G_5fepeRXC5pXXc0zu3yxYI1iNoFhRsC52haWdIaTUIG_CGOwZUjDoy0KIoKep7cG7POJKq6");
    define("PayPalSecret", "ECU-cd7H4MotdF-W7yMvM5mPkGR45cbjf5JN7WkknitU-LApGo1F9LroWvBG8S4Y9OcrJPKLRebdErOz");
    define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
    define("PayPalENV", "sandbox");
}
?>
