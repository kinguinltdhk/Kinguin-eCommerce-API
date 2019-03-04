# How to buy pre-orders

Pre-orders are [products](apidocs/products/README.md#product-object) with field `isPreorder` set to `true` and field `preorderToDate` set to release date.

Ordering preorders genarally looks the same as ordering the rest of the products ([Place order](apidocs/order/README.md#place-order)).

**The differences:**
- Pre-order cannot be ordered with other products types.
- Cannot order more than one pre-order product in one order (but `qty` can be gross that 1).
- Dispatch will be made automatically after the date `preorderToDate`. After this it is possible to take `orderId` by calling the
[Dispatch order](apidocs/order/README.md#dispatch-order).