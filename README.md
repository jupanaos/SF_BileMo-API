# 🟣 BileMo
## A webservice exposing a REST API
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/562c8fa90fca405dbd3f7c0f9d967ed2)](https://www.codacy.com/gh/jupanaos/SF_BileMo-API/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=jupanaos/SF_BileMo-API&amp;utm_campaign=Badge_Grade)

## 🧰 Getting started
Follow the next steps if you would like to install this project. Or you can skip and go to the API documentation further below.

### Prerequisites
- Composer
- Node.js
- Download the [Symfony CLI](https://symfony.com/download)
- PHP 8.1
- MySQL 8.0
- Apache 2.4
- OpenSSL
> **NOTE** : I used Laragon on local.

### Installation
1. Clone the repo
   ```sh
   git clone https://github.com/jupanaos/SF_BileMo-API.git
   ```
2. Install required packages with composer
   ```sh
   composer install
   ```

### 🔧 Configuration
Create your own `.env.local` in the main folder `/` and enter your datas.

### ⚙️ Database
Create your database. This will use the DATABASE_URL from your `.env.local`.<br>
```bash
php bin/console doctrine:database:create
```
Generate the database schema.<br>
```bash
php bin/console doctrine:schema:update --force
```
Load fixtures.<br>
```bash
php bin/console doctrine:fixtures:load --append
```

#### Run the server

You can now run your web server with
```bash
symfony server:start
```

## 📖 API documentation
You can access the documentation through the following URI : `/api/doc`

### API resources
You will next find the list and description of the API resources.

#### Product
Products sold by BileMo (phones, accessories, etc.)

#### Customer
A customer is someone registered to a user.

#### User (not a resource)
A user is BileMo's own customer who has been granted access to the BileMo API. Each user has a list of customers that belong to them.

### Authentication
To access the API resources, you will need to authenticate yourself with JWT and the credentials that have been provided to you.
This should look like this :
| Method | URL                                    | Body                                                                          | Headers                          | Response body                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
|--------|----------------------------------------|-------------------------------------------------------------------------------|----------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| POST   | http://127.0.0.1:8000/api/login | ```{ "username": "username@email.com", "password": "password"} ``` | 'Content-Type: application/json' | ``` {"token": "3t1nsUlkVz9WZN7uNfRR4XzYKnGJnBlp5Z5KV2nzIVzWlI5H37DZkcuKM2hZK4HsZ7XicJg25wSOHErWBynAYo8U95Gn4TG8FZ2qNI6keCAmj9fQhlGp49qXuf74RiDJBXcdDTQsutlslvMoDfPW4hqMZuaWUCUbHRN5d6PAfubLfT2qAXuIRExehriilDpn91EQJL9rfccNzIqwY15CJMVFPnPjfeZAruz0NnpdOj9TH5wHP6ZsaKljbDmv9kokA", "refresh_token": "1EQJL9rfccNzIqwY15CJMVFPnPjfeZAruz0NnpdOj9TH5wHP6ZsaKljbDmv9kokA"} ``` |

Now you can send this token in the header for each request you make.
| Method | URL                                  | Headers                                                                                                                                                                                                                                                                                                                                                       | Response body                                                                                                                                                                                                                                                                                                                                                                                                | Successful response status code  |
|--------|--------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------|
| GET    | http://127.0.0.1:8000/api/products  | 'Authorization: Bearer 3t1nsUlkVz9WZN7uNfRR4XzYKnGJnBlp5Z5KV2nzIVzWlI5H37DZkcuKM2hZK4HsZ7XicJg25wSOHErWBynAYo8U95Gn4TG8FZ2qNI6keCAmj9fQhlGp49qXuf74RiDJBXcdDTQsutlslvMoDfPW4hqMZuaWUCUbHRN5d6PAfubLfT2qAXuIRExehriilDpn91EQJL9rfccNzIqwY15CJMVFPnPjfeZAruz0NnpdOj9TH5wHP6ZsaKljbDmv9kokA'  | ```[{"id": 1,"name": "A name","description": "A description.","category": "category", "createdAt": "2022-11-29T20:21:16+00:00","updatedAt": "2022-11-30T20:21:16+00:00" ]```      | 200                              |

## ✉️ Contact & links
Julie Pariona - https://github.com/jupanaos/
