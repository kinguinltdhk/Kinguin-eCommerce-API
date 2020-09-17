# How to order pre-orders

**Requirements for ordering pre-orders items**

1. Pre-order can't be ordered with other products types.
2. An array with products should have only one pre-order item (`qty` field can be grater than 1).
3. Pre-order's are dispatched automatically after the release date. Attempt to dispatch order before the release date will fail. To get `dispatchId` try to send [request for dispatch](../apidocs/order/README.md#dispatch-order) after release date.
4. Setting key type for pre ordered products is not allowed.
