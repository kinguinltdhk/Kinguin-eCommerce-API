# Products

Version: `v1`

## Table of Contents

- [List products](#list-products)
- [Get single product](#get-single-product)
- [Product Object](#product-object)
- [Tags](#tags)
- [Regions](#regions)

## List products

`GET /{version}/products`


### Input

Parameter | Type | Required | Description
--------- | -----| :--------: | -----------
page | int | - | Page number
limit | int | - | Limit results (default: `10`, maximum: `100`)
name | string | - | Product name (minimum: `3` characters)
sortBy | string | - | Sort field name (values: `kingiunId`, `name`, `qty` or `price`)
sortType | string | - | Sort type (values: `asc` or `desc`)
priceFrom | float | - | Cheapest price from
priceTo | float | - | Cheapest price to
platform | string | - | Platform name
genre | string | - | [Genre](#genres)
kinguinId | string | - | Comma separated list of products ids (maximum: `100`)
languages | string | - | Language
isPreorder | string | - | Preorders (values: `yes` or `no`)
activePreorder | string | - | Only active preorders (values: `yes`)
regionId | int | - | [Region id](#regions)
tags | string | - | Comma separated list of [tags](#tags)
updatedSince | string | - | UTC date
updatedTo | string | - | UTC date
onlyText** | string | - | Products with `text` keys only (values: `yes`)
vendorName** | string | - | Offer vendor name

`** in case of use please contact our business manager`

### Output

Parameter | Type | Description
--------- | -----| --------
results | array-object | Array of [Product Object](#product-object)
item_count | int | Total number of available products matching filters

#### Example
```
curl -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/products?limit=10
```

#### Example response
```
{
    "results": [
        {
            "kinguinId": 4,
            "name": "Anno 2070 Uplay CD Key",
            "description": "Anno 2070 is a city-building and economic simulation game (...)",
            "coverImage": "https://storage.googleapis.com/api-ecommerce/anno-2070_cover.jpg",
            "developers": [
                "Blue Byte Software",
                "Related Designs"
            ],
            "publishers": [
                "Ubisoft Entertainment"
            ],
            "genres": [
                "Real Time Strategy (RTS)",
                "Simulator",
                "Strategy"
            ],
            "platform": "Uplay",
            "releaseDate": "2011-11-17",
            "qty": 230,
            "price": 4.39,
            (...)
        },
        {
            ...
        }
    ],
    "item_count": 10972
}
```

## Get single product


`GET /{version}/products/{kinguinId}`

### Input

Parameter | Type | Required | Description
--------- | -----| :--------: | -----------
kinguinId | int | + | Product id

### Output

Returns the [Product Object](#product-object)

#### Example
```
curl -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/products/4
```

#### Example response
```
{
    "kinguinId": 4,
    "name": "Anno 2070 Uplay CD Key",
    (...)
}
```


## Product Object

Field | Type | Description
--------- | -----| -------- 
kinguinId | int | Product id
name | string | Product name
originalName`*` | string | Original name
description`*` | string | Product description
coverImage`*` | string | Cover image (thumb)
coverImageOriginal`*` | string | Cover image (full size)
developers`*` | array | Developers list
publishers`*` | array | Publishers list
genres | array | [Genres](#genres)
platform | string | Platform name
releaseDate`*` | string | First release date
qty | int | Cheapest offer quantity
price | float | Cheapest price
textQty** | int | Quantity of `text` keys
imageQty** | int | Quantity of `image` keys
offers** | array-object | List of available [offers](/#offer-object)
offersCount** | int | Total number of product offers
totalQty** | int | Total quantity of products offers
originScore | float | Origin score
isPreorder | bool | Is preorder
preorderFromDate | string | Preorder date from
preorderToDate | string | Preorder date to
metacriticScore | float | Metacritic score
regionalLimitations | string | Region name
regionId | id | [Region id](#regions)
activationDetails | string | Activation details
screenshots`*` | array-object | Screenshots
videos`*` | array-object | Videos
languages | array | Languages
updatedAt | string | Last update date (UTC format)
status | string | Offer status
type | string | Product type (values: `serial`)
systemRequirements | array-object | System requirements
tags | array | Array of [tags](#tags)

`* optional attribute`

`** optional attribute, in case of use please contact our business manager`

## Offer Object

Field | Type | Description
--------- | -----| --------
price | float | Offer price
offerId | int | Offer id
qty | int | Total quantity
textQty** | int | Quantity of text serials
imageQty** | int | Quantity of image serials
status | string | Current offer status
type | string | Offer type
isPreorder | bool | Preorder
name | string | Offer name
vendorName | string | Vendor name
isCheapest | bool | Has lowest price

`** optional attribute, in case of use please contact our business manager`

## Tags

Available list of product's tags:

* `preorder`
* `indie valley`
* `dlc`
* `base`
* `software`
* `prepaid`
* `steam gift`

## Regions

Id | Region name
--- | ----------------------
1  | Europe
2  | United States
3  | Region free
4  | Other
5  | Outside Europe
6  | RU VPN
7  | Russia
8  | United Kingdom
9  | China
10 | RoW (Rest of World)
11 | Latin America
12 | Asia
13 | Germany
14 | Australia
15 | Brazil
16 | India
17 | Japan
18 | North America

## Genres

| Genre
| ----------------------
| Action
| Adventure
| Anime
| Casual
| Co-op
| Dating Simulator
| Fighting
| FPS
| Hack and Slash
| Hidden Object
| Horror
| Indie
| Life Simulation
| MMO
| Music / Soundtrack
| Online Courses
| Open World
| Platformer
| Point & click
| PSN Card
| Puzzle
| Racing
| RPG
| Simulation
| Software
| Sport
| Story rich
| Strategy
| Subscription
| Survival
| Third-Person Shooter
| Visual Novel
| VR Games
| XBOX LIVE Gold Card
| XBOX LIVE Points
