# Coupon code

- [Ask for coupon](#ask-for-coupon)
- [Using coupon](#using-coupon)

## Ask for coupon

To get the coupon code, please contact your business manager.

## Using coupon

After receiving your own discount code, you can use it in any order placed through our API.
The coupon should reduce the total amount of the order, so the amount to be paid by you is also lower.
The amount that has been charged from your balance is available in the `paymentPrice` field. Total order value without discount is available in the `totalPrice` field.
Because of the API can pick the offer with lower price than requested price, we save the original total products price in `requestTotalPrice` field. Also, each product in [order object](../api/order/v1/README.md#order-object) has similar `requestPrice` field.

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79}],"couponCode":"ESA3"}' \
     https://gateway.kinguin.net/esa/api/v1/order
```
