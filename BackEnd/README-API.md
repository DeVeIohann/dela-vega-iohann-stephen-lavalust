# Product API setup

This LavaLust application provides a JSON API for the React ProductDesk client.

## Database

Create an Aiven MySQL database, then import `schema.sql`. It creates the `products` table and a `users` table for login credentials. User passwords are stored as PHP password hashes.

Set these environment variables for the PHP application. A ready-to-copy example is in [`.env.example`](./.env.example):

- `MYSQL_HOST`
- `MYSQL_PORT`
- `MYSQL_DATABASE`
- `MYSQL_USERNAME`
- `MYSQL_PASSWORD`
- `MYSQL_SSL_CA` (path to Aiven's CA certificate, if required by the service)
- `JWT_SECRET` (a randomly generated secret of at least 32 characters)
- `JWT_REFRESH_SECRET` (a separate secret for refresh-token encryption)
- `FRONTEND_ORIGIN` (the exact origin serving the React app, such as `https://your-app.example`)

Generate a JWT secret with `php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"`. Never commit database credentials or JWT secrets.

For local development, the database configuration defaults to MySQL at `127.0.0.1:3306`, database `crud_with_authentication`, and user `root`; set the password with `MYSQL_PASSWORD` if needed. Set `JWT_SECRET` and `FRONTEND_ORIGIN=http://localhost:5173` in the PHP server environment.

## Create the first login

There is no public registration endpoint. Generate a password hash on the server with:

```sh
php -r "echo password_hash('choose-a-strong-password', PASSWORD_DEFAULT), PHP_EOL;"
```

Insert the chosen username and generated hash into the `users` table:

```sql
INSERT INTO users (username, password_hash) VALUES ('admin', '<generated-password-hash>');
```

## Routes

All responses are JSON. Product routes require `Authorization: Bearer <token>`.

| Method | Route | Access | Purpose |
| --- | --- | --- | --- |
| POST | `/api/auth/login` | Public | Authenticate with `username` and `password`; returns a one-hour token |
| GET | `/api/auth/me` | Authenticated | Return the current token identity |
| POST | `/api/auth/logout` | Authenticated | Confirm client sign-out; discard the token |
| GET | `/api/products` | Authenticated | List products |
| POST | `/api/products` | Authenticated | Create a product |
| PUT | `/api/products/{id}` | Authenticated | Replace a product |
| PATCH | `/api/products/{id}` | Authenticated | Partially update a product |
| DELETE | `/api/products/{id}` | Authenticated | Delete a product |

Product JSON fields are `product_name`, `description`, `price`, and `quantity`. Price must be between 0 and 99,999,999.99 and quantity a non-negative integer.

Logout is stateless: the API does not maintain a token denylist, so the client must discard its token. Tokens expire after one hour.

For Render, deploy the `BackEnd` directory as the PHP service and set the environment variables above. Set `FRONTEND_ORIGIN` to the deployed front-end origin. Set `VITE_API_URL` in the front-end build environment to the deployed API root. For Aiven TLS, provide the service CA file through `MYSQL_SSL_CA`.
