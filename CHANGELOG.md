# Changelog

## [Unreleased]

### Removed
- the `https://api2.kinguin.net/integration/v1` will be removed at end of the 2020, please switch to `https://gateway.kinguin.net/esa/api`

## [2020-10-30]

### Changed
- type of `orderId` and `offerId` fields transformed to `string`,
- error response format, [details here](api/ErrorsCodes.md)

### Added
- added `couponCode` field to order request payload, [details here](features/CouponCode.md#ask-for-coupon)
- added `orderExternalId` field to order request payload, [details here](features/OrderExternalId.md)
- added `orderExternalId` filter for `/api/v1/order` endpoint,
- added `offerId`, `productId` fields to response from `/api/v1/order/dispatch/keys` endpoint,
- added `paymentPrice`, `requestTotalPrice`, `products.requestPrice`, `products.releaseDate`, `isPreorder`, `preorderReleaseDate` fields to order, [details here](features/CouponCode.md#using-coupon)
- added `X-Api-Key` header as a replacement/alias for `Api-Ecommerce-Auth`,
- added `/api/v2/order` endpoint, [details here](api/order/v2/README.md#place-order)
- added `/api/v2/order/{orderId}/dispatch` endpoint, [details here](api/order/v2/README.md#dispatch)
- added `/api/v2/order/{orderId}/keys` endpoint, [details here](api/order/v2/README.md#get-keys)
- added `/api/v2/products/{productId}` endpoint, [details here](api/products/v2/README.md#get-product)
- added multiple values search for `genre` and `platform` filters,
- added `withText` filter for `/api/v1/products` endpoint,
- added more order details in create order response,
- added `merchantName` field to offer,
- added `merchantName` filter for `/api/v1/products` endpoint,
- added `productId` filter for `/api/v1/products` endpoint,
- added more details about order in `/api/v1/order` endpoint,

### Removed
- removed product `preorderFromDate`, `preorderToDate`, `imageQty`, `originScore`, `type`, `status` fields, use `releaseDate` instead,
- removed offer `type`, `vendorName`, `isCheapest`, `imageQty` fields,
- removed product `vendorName` filter,
- removed tags `steam gift` and `preorder`,
- removed `image` choice from `keyType` property,

## [2019-12-10]

### Added
- possibility to select key type (`text` or `image`), [details here](features/KeyType.md#how-to-buy-text-serial)
- possibility to buy selected offer, [details here](features/BuyOffer.md#how-to-buy-specific-offer)
- added `vendorName` and `onlyText` filters to products, [details here](api/products/v1/README.md#search-products)
- added `textQty`, `imageQty` to product, [details here](api/products/v1/README.md#product-object)
- added `offers`, `offersCount`, `totalQty` to product, [details here](api/products/v1/README.md#offer-object)

### Removed
- removed `newsFromDate`, `newsToDate`, `stock` from product (was DEPRECATED before)

## [2019-03-27]

### Added
- min length validation for `name` filter, [details here](api/products/v1/README.md#search-products)

### Changed
- `kinguinId` filter accepts multiple `kinguinId` values, [details here](api/products/v1/README.md#search-products)
- `stock` field is **DEPRECATED** and will be removed, use `qty` field instead

### Removed
- removed `steamScore` from products fields
- removed `stock` filter

## [2019-02-28]

### Added
- added `isPreorder` filter to orders endpoint, [details here](api/order/v1/README.md#search-orders)
- added `isPreorder` to `order.products` collection, [details here](api/order/v1/README.md#search-orders)

## [2019-02-21]

### Added
- added `coverImageOriginal` to product, [details here](api/products/v1/README.md#product-object)
- added `genre` filter, [details here](api/products/v1/README.md#search-products)

### Changed
- updated products genres list, [details here](api/products/v1/README.md#genres)

## [2019-01-23]

### Added
- add `offerId` to `order.products` collection, [details here](api/order/v1/README.md#search-orders)

## [2019-01-09]

### Added
- postback notifications for products updates, [details here](features/Postback.md#products-updates-notifications)

## [2018-11-20]

### Added
- new endpoint GET /order, [details here](api/order/v1/README.md#search-orders)

## [2018-11-14]
### Changed
- product `regionalLimitations` field now stores a *name of region* instead of url to icon
- fields such as `originalName`, `description`, `coverImage`, `screenshots`, `videos`, `developers`, `publishers` and `releaseDate` have become optional fields and may not be accessible for all products
- product `sortBy` field has been limited to `kingiunId`, `name`, `qty` and `price` values
- product `sortType` filed has been limited to `asc` and `desc`
  
### Added
- product `regionId` filed which stores id of *region name*, [details here](api/products/v1/README.md#regions)
- `originalName` field which stores base name of product
- `isPreorder` field
- `status` filed which indicates if offer is active and ready to buy at Kinguin platform. The valid product should have `active` status. *IMPORTANT: Products only with that status can be ordered at Kinguin platform*
- `type` field which stores the type of product. For now there is only one `serial` available value. *IMPORTANT: Only `serial` products will be exposed by Product Api*
- `systemRequirements` field which stores list of hardware requirements for the product
- `tags` field which stores list of product's tags, [details here](api/products/v1/README.md#tags)
- added `isPreorder` parameter to query filters (acceptable values are `yes` and `no`)
- added `activePreorder` parameter to query filters (acceptable value is `yes`). It checks only the date of preorder activity, so if you want get only active preorders just use both parameters `isPreorder=yes` and `activePreorder=yes`
- added `regionId` parameter to query filters
- added `tags` parameter to query filters. It should be comma separated list of tags
- added `updatedSince` and `updatedTo` parameters to query filters. Both should be a valid UTC date. It allows to filter products by last update date

## [2018-11-13]
### Changed
- improved [errors and messages](api/ErrorsCodes.md)

### Added
- `kinguinId` in order/dispatch/keys endpoint
