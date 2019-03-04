# How to keep products up to date

The state of **Kinguin offer** is changing dynamically and often.
This is very important because outdated data have an impact on the ordering process.
We present ways in which you can update products available through the API.
We recommend using those methods together to reduce the risk of having outdated data.


**Postback notifications**

Postback notifications are automatic product updates, which we send to a previously configured and verified endpoint.
Notifications are sent when the product price or quantity was changed.
You can [read more](features/Postback.md) about the notifications in a separate section of our documentation.


**Interval updates**

Each product available through the API has the `updatedAt` property.
This is a useful property when you want to filter products that have been updated at a given time.
For this purpose we can use the `updatedSince`:

```
curl -H "api-ecommerce-auth: [api-key]" -G --data-urlencode "updatedSince=2019-01-25T01:00:00+00:00" -XGET https://api2.kinguin.net/integration/v1/products
```

The date provided in `updatedSince` filter should be in the right format `Y-m-d\TH:i:sP` (please keep in mind that the dates are presented in `UTC` timezone).

When you call the specified request, the value of the `updatedSince` parameter should indicates the time in which you made the last request using the `updatedSince` parameter.
So you should always save the date when you use `updatedSince` filter.


**Updates while creating the order**

During the ordering you will may receive such an error:

```
{
    "code": 2610,
    "message": "Requested quantity \"1\" for product with id \"5\" and price \"0.95\" is not available"
}
```

This means that the product with the given price and the requested quantity does not exists. 
Perhaps you are getting this error because you have outdated product information by your side.
In this case, by responding to the error code `2610`, you can send a product request and update it.
If the product exists, you will be able to resend your order.


**Updates after order created**

If you do not decided to use **postback notifications** as a main way to update products you should always try to update products
that have been purchased in the last order request. It is handy, when you purchase the same products many times and for some reasons
you have not been able to update them on time.