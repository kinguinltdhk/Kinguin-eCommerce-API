# Products API

Version: `v1`

## Table of Contents

- [Get product](#get-product)
- [Search products](#search-products)
- [Product object](#product-object)
- [Offer object](#offer-object)
- [Tags](#tags)
- [Regions](#regions)


## Get product

`GET /v1/products/{kinguinId}`

### Path parameters

Parameter | Type | Description
--------- | :-----: | -----------
`kinguinId` | int | Product ID

### Output

HTTP Status: `200`

Content-Type: `application/json`

Returns the [Product Object](#product-object)

#### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/products/1949
```

#### Example response

```json
{
    "name": "Counter-Strike: Source Steam CD Key",
    "description": "Counter-Strike: Source blends Counter-Strike&#39;s award-winning teamplay action with the advanced technology of Source™ technology. Featuring state of the art graphics, all new sounds, and introducing physics, Counter-Strike: Source is a must-have for every action gamer.",
    "coverImage": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_cover.jpg",
    "coverImageOriginal": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_cover_original.jpg",
    "developers": [
        "Valve Corporation",
        "Hidden Path Entertainment"
    ],
    "publishers": [
        "Valve Corporation"
    ],
    "genres": [
        "Action"
    ],
    "platform": "Steam",
    "releaseDate": "2004-11-01",
    "qty": 149,
    "textQty": 149,
    "price": 5.79,
    "cheapestOfferId": [
        "5f7efe3b369b4a0001c5b46f"
    ],
    "isPreorder": false,
    "metacriticScore": 88,
    "regionalLimitations": "Region free",
    "regionId": 3,
    "activationDetails": "Go to:  http://store.steampowered.com/ and download STEAM client\r\n\r\n\r\nClick \"Install Steam\" (from the upper right corner)\r\n\r\n\r\nInstall and start application, login with your Account name and Password (create one if you don't have).\r\n\r\n\r\nPlease follow these instructions to activate a new retail purchase on Steam:\r\n\r\nLaunch Steam and log into your Steam account.\r\nClick the Games Menu.\r\nChoose Activate a Product on Steam...\r\nFollow the onscreen instructions to complete the process.\r\n\r\nAfter successful code verification go to the \"MY GAMES\" tab and start downloading.",
    "kinguinId": 1949,
    "productId": "5c9b5f6b2539a4e8f172916a",
    "originalName": "Counter-Strike: Source",
    "screenshots": [
        {
            "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_1.jpg",
            "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_1.jpg"
        },
        {
            "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_2.jpg",
            "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_2.jpg"
        },
        {
            "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_3.jpg",
            "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_3.jpg"
        },
        {
            "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_4.jpg",
            "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_4.jpg"
        },
        {
            "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_5.jpg",
            "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_5.jpg"
        }
    ],
    "videos": [
        {
            "name": "Trailer",
            "video_id": "bvI62FUDpKA"
        }
    ],
    "languages": [
        "German",
        "English",
        "French",
        "Spanish",
        "Japanese",
        "Russian",
        "Chinese",
        "Korean",
        "Italian"
    ],
    "systemRequirements": [
        {
            "system": "Windows",
            "requirement": [
                "OS: Windows® 7 (32/64-bit)/Vista/XP",
                "Processor: 1.7 GHz ",
                "Memory: 512MB RAM",
                "Graphics: DirectX® 8.1 level Graphics Card (Requires support for SSE)",
                "Input: Mouse, Keyboard",
                "Additional note: Internet Connection"
            ]
        },
        {
            "system": "Mac",
            "requirement": [
                "OS: OS X version Leopard 10.5.8, Snow Leopard 10.6.3",
                "Memory: 1GB RAM",
                "Graphics: NVIDIA GeForce 8 or higher, ATI X1600 or higher, or Intel HD 3000 or higher ",
                "Input: Mouse, Keyboard",
                "Additional note: Internet Connection"
            ]
        },
        {
            "system": "Linux",
            "requirement": [
                "Processor: 1.7 GHz ",
                "Memory: 512MB RAM",
                "Input: Mouse, Keyboard",
                "Additional note: Internet Connection"
            ]
        }
    ],
    "tags": [
        "base"
    ],
    "offers": [
        {
            "name": "Counter-Strike: Source Steam CD Key",
            "offerId": "5f7efe3b369b4a0001c5b46f",
            "price": 5.79,
            "qty": 149,
            "textQty": 149,
            "merchantName": "KinguinHK",
            "isPreorder": false,
            "releaseDate": "2004-11-01"
        }
    ],
    "offersCount": 1,
    "totalQty": 149,
    "merchantName": [
        "KinguinHK"
    ],
    "updatedAt": "2020-10-24T09:34:13+00:00"
}
```

## Product Object

Field | Type | Description
--------- | :-----:| -------- 
`kinguinId` | int | Product ID
`productId` | string | Another product ID
`cheapestOfferId` | string[] | Array of cheapest offers id
`name` | string | Product name
`originalName` | string | Product original name
`description` | string | Product description
`coverImage` | string | Cover image (thumb)
`coverImageOriginal` | string | Full size cover image
`developers`| string[] | Array of developers list
`publishers` | string[] | Array of publishers list
`genres` | string[] |  Array of [Genres](#genres)
`platform` | string | Platform name
`releaseDate` | string | Release date
`qty` | int | Total cheapest offers quantity
`price` | float | Cheapest offer price
`textQty`* | int | Quantity of `text` serials
`offers`* | object[] | Array of [Offer Object](/#offer-object)
`offersCount`* | int | Total number of offers
`totalQty`* | int | Total quantity from all offers
`isPreorder` | bool | PRE-ORDER
`metacriticScore` | float | Metacritic score
`regionalLimitations` | string | Region name
`regionId` | int | [Region](#regions)
`activationDetails` | string | Activation details
`screenshots` | object[] |  Array of screenshots
`videos` | object[] |  Array of videos
`languages` | string[] | Array of languages
`updatedAt` | string | Last update date
`systemRequirements` | object[] | System requirements
`tags` | string[] | Array of [Tags](#tags)
`merchantName` | string[] | Array of cheapest offers seller names

> *feature property, in case of use please contact your business manager


## Offer Object

Field | Type | Description
--------- | -----| --------
`name` | string | Offer name
`offerId` | string | Offer ID
`price` | float | Offer price
`qty` | int | Offer quantity
`textQty`* | int | Text serials quantity
`status` | string | Offer status
`isPreorder` | bool | PRE-ORDER
`releaseDate` | string | Release date
`merchantName` | string | Seller name

> *feature property, in case of use please contact your business manager



## Search products

`GET /v1/products`

### Query parameters

Parameter | Type | Description
--------- | :-----: | -----------
`page` | int | Page number (default: `1`)
`limit` | int | Number products on page (default: `25`, maximum: `100`)
`name` | string | Product name (minimum: `3` characters)
`sortBy` | string | Sort field name (values: `kingiunId`, `name`, `qty` or `price`)
`sortType` | string | Sort type (values: `asc` or `desc`)
`priceFrom` | float | Price from
`priceTo` | float | Price to
`platform` | string | Comma separated list of platforms
`genre` | string | Comma separated list of [Genre](#genres)
`kinguinId` | string | Comma separated list of product ID
`productId` | string | Comma separated list of another product ID
`languages` | string | Language
`isPreorder` | string | PRE-ORDER (values: `yes` or `no`)
`activePreorder` | string | Only active PRE-ORDER (values: `yes`)
`regionId` | int | [Region](#regions)
`tags` | string | Comma separated list of [Tags](#tags)
`updatedSince` | string | Filter products since given update time
`updatedTo` | string | Filter products updated to given time
`withText`* | string | Filter products only with text serials (values: `yes`)
`merchantName` | string | Seller name

`* fetaure property, in case of use please contact your business manager`

### Output

HTTP Status: `200`

Content-Type: `application/json`

Field | Type | Description
--------- | :-----: | --------
`results` | object[] | Array of [Product Object](#product-object)
`item_count` | int | Total number of available products matching criteria

#### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/products?name=forza
```

#### Example response

```json
{
    "results": [
        {
            "name": "Counter-Strike: Source Steam CD Key",
            "description": "Counter-Strike: Source blends Counter-Strike&#39;s award-winning teamplay action with the advanced technology of Source™ technology. Featuring state of the art graphics, all new sounds, and introducing physics, Counter-Strike: Source is a must-have for every action gamer.",
            "coverImage": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_cover.jpg",
            "coverImageOriginal": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_cover_original.jpg",
            "developers": [
                "Valve Corporation",
                "Hidden Path Entertainment"
            ],
            "publishers": [
                "Valve Corporation"
            ],
            "genres": [
                "Action"
            ],
            "platform": "Steam",
            "releaseDate": "2004-11-01",
            "qty": 149,
            "textQty": 149,
            "price": 5.79,
            "cheapestOfferId": [
                "5f7efe3b369b4a0001c5b46f"
            ],
            "isPreorder": false,
            "metacriticScore": 88,
            "regionalLimitations": "Region free",
            "regionId": 3,
            "activationDetails": "Go to:  http://store.steampowered.com/ and download STEAM client\r\n\r\n\r\nClick \"Install Steam\" (from the upper right corner)\r\n\r\n\r\nInstall and start application, login with your Account name and Password (create one if you don't have).\r\n\r\n\r\nPlease follow these instructions to activate a new retail purchase on Steam:\r\n\r\nLaunch Steam and log into your Steam account.\r\nClick the Games Menu.\r\nChoose Activate a Product on Steam...\r\nFollow the onscreen instructions to complete the process.\r\n\r\nAfter successful code verification go to the \"MY GAMES\" tab and start downloading.",
            "kinguinId": 1949,
            "productId": "5c9b5f6b2539a4e8f172916a",
            "originalName": "Counter-Strike: Source",
            "screenshots": [
                {
                    "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_1.jpg",
                    "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_1.jpg"
                },
                {
                    "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_2.jpg",
                    "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_2.jpg"
                },
                {
                    "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_3.jpg",
                    "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_3.jpg"
                },
                {
                    "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_4.jpg",
                    "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_4.jpg"
                },
                {
                    "url": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_thumb_5.jpg",
                    "url_original": "https://storage.googleapis.com/api-ecommerce/counter-strike-source_original_5.jpg"
                }
            ],
            "videos": [
                {
                    "name": "Trailer",
                    "video_id": "bvI62FUDpKA"
                }
            ],
            "languages": [
                "German",
                "English",
                "French",
                "Spanish",
                "Japanese",
                "Russian",
                "Chinese",
                "Korean",
                "Italian"
            ],
            "systemRequirements": [
                {
                    "system": "Windows",
                    "requirement": [
                        "OS: Windows® 7 (32/64-bit)/Vista/XP",
                        "Processor: 1.7 GHz ",
                        "Memory: 512MB RAM",
                        "Graphics: DirectX® 8.1 level Graphics Card (Requires support for SSE)",
                        "Input: Mouse, Keyboard",
                        "Additional note: Internet Connection"
                    ]
                },
                {
                    "system": "Mac",
                    "requirement": [
                        "OS: OS X version Leopard 10.5.8, Snow Leopard 10.6.3",
                        "Memory: 1GB RAM",
                        "Graphics: NVIDIA GeForce 8 or higher, ATI X1600 or higher, or Intel HD 3000 or higher ",
                        "Input: Mouse, Keyboard",
                        "Additional note: Internet Connection"
                    ]
                },
                {
                    "system": "Linux",
                    "requirement": [
                        "Processor: 1.7 GHz ",
                        "Memory: 512MB RAM",
                        "Input: Mouse, Keyboard",
                        "Additional note: Internet Connection"
                    ]
                }
            ],
            "tags": [
                "base"
            ],
            "offers": [
                {
                    "name": "Counter-Strike: Source Steam CD Key",
                    "offerId": "5f7efe3b369b4a0001c5b46f",
                    "price": 5.79,
                    "qty": 149,
                    "textQty": 149,
                    "merchantName": "KinguinHK",
                    "isPreorder": false,
                    "releaseDate": "2004-11-01"
                }
            ],
            "offersCount": 1,
            "totalQty": 149,
            "merchantName": [
                "KinguinHK"
            ],
            "updatedAt": "2020-10-24T09:34:13+00:00"
        }
    ],
    "item_count": 1
}
```


## Tags

| Name
| ----------------------
| `indie valley`
| `dlc`
| `base`
| `software`
| `prepaid`


## Regions

ID | Name
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

| Name
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
