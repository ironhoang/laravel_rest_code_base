### Project Laravel codebase

[Contact email](mailto:ironhoang@gmail.com)

CodeBase from https://github.com/sMmominur/restapi-laravel.git

# Project Documentation

## Technologies Used in the Project

- **Language**: PHP 8.2
- **Framework**: Laravel 11
- **Database**: SQLite  
  *(Chosen for its lightweight nature and short development cycle. It can be switched to PostgreSQL or MySQL anytime.)*

---

## Preparation

- Install **PHP 8.2**  
  Link PHP 8.2:
  ```bash
  brew link php@8.2
  ```
- Ensure Composer is installed.
- Configure AWS Keys for uploading images to S3.

## Getting Started

1. Clone the Project

```bash
   git@github.com:ironhoang/laravel_rest_code_base.git
 ```

2. Set Up Environment File

```bash
cp -r .env.example .env
```

Update the .env file with AWS keys, region, and bucket information.

3. Generate JWT Key

```bash
php artisan jwt:secret
```

4. Generate Application Key

```
php artisan key:generate
```

5. Migrate Database

```
php artisan migrate
```

6. Seed the Database
   Note: This will populate the database with default data, including:

```
{"email":"test@example.com","password":"Testtest"}
{"email":"admin@example.com","password":"TestAdmin"}
```

Daily meals, exercises, body metrics, posts, and categories also will be create.

```
php artisan db:seed
```

### Unittest

```
php artisan test
```

![unittest result](documents/unittest.png)

## [APIs](documents/rest_code_base.postman_collection.json)

### Public APIs (No Login Required)

* Register

```
POST: api/auth/register
```

* Login

```
POST: api/auth/login
```

* Fetch Public Posts

```
GET: api/v1/public_posts
```

### User APIs

#### Fetch Profile Information

```
GET: api/v1/profile
```

#### Update Profile Information

```
PUT: api/v1/profile
```

Use the API to fetch posts:

```
GET: api/v1/public_posts
```

## Admin APIs

### Categories CRUD

```
api/v1/categories
```

### Posts CRUD

```
api/v1/posts
```
