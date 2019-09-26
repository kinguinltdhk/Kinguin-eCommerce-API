# Woocommerce Kinguin Integration

##### Disclaimer: this is a proof-of-concept and should be treated as one

## How does it work?

User has to first download all products by clicking a button in admin panel. The php script initializes the transaction with the Kinguin API and runs in batches of 100 products, generates proper product objects and tells Woocommerce by Ajax to add products to the database.

In order to debug, see debug.log and dev console in the browser.

The app hooks to Woo in order to check and update the product quantity and the price every time it is shown on the website (it's a filter that hooks to woocommerce_get_price_html).

The app allows users to check his keys in Orders section in the Client Panel after logging in, also it sends the email with keys listed inside.


## Installation:

Set api auth key in config.ini, update api url if needed and just copy the folder to the theme root and:

```


/**
 * Woocommerce -  Kinguin API import
 */

include_once( get_stylesheet_directory() .'/Kinguin/main.php'); 
include_once( get_stylesheet_directory() .'/Kinguin/admin.php'); 



```
to functions.php


