## LavaLust 4 (Latest 4.5.0)
<p align="center">
    <img width="200" height="300" src="https://lavalust.netlify.app/_images/logo.png">
</p>
    LavaLust is a lightweight Web Framework - (using MVC pattern) - for people who are developing web sites using PHP. It helps you write code easily using Object-Oriented Approach. It also provides set of libraries for commonly needed tasks, as well as a helper functions to minimize the amount of time coding.

## Documentation
[LavaLust Documentation Link](https://lavalust.netlify.app)

## Laboratory Exercise 5

This project includes an authenticated product CRUD application at `/products`.
Unauthenticated requests are redirected to `/login`.

### Database setup

1. Create an Aiven MySQL service and database.
2. Run [`database/schema.sql`](database/schema.sql) against that database.
3. Generate a password hash and insert an application user:

```bash
php -r "echo password_hash('your-password', PASSWORD_DEFAULT), PHP_EOL;"
```

```sql
INSERT INTO users (username, password) VALUES ('admin', 'PASTE_HASH_HERE');
```

Do not commit the real password. Configure `DB_HOST`, `DB_PORT`, `DB_DATABASE`,
`DB_USERNAME`, and `DB_PASSWORD` as environment variables. See
[`.env.example`](.env.example) for the variable names.

### Render deployment

Create a Render Web Service from the GitHub repository with Docker deployment.
The included `Dockerfile` starts Apache and enables URL rewriting. Add the five
database environment variables in Render using the values supplied by Aiven.

Verify the workflow in order: `/login`, `/products`, create, edit, and delete.
Capture the login, product list, add form, edit form, delete result, and Aiven
`products` table for submission.

<p>
    Note: If you are using PLDT, you need to use google dns (8.8.8.8) to open the documentation website. There is
    an issue with PLDT and Netlify websites.
</p>

## Installation and Tutorials

[Checkout LavaLust Tutorial's Youtube Channel](https://youtube.com/ronmarasigan)

### Licence
<p>
    MIT License

    Copyright (c) 2020 Ronald M. Marasigan

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
</p>
