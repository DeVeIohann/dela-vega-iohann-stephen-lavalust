# ProductDesk Front End

React and Vite client for the LavaLust product-management API.

## Run locally

1. Start Apache with `mod_rewrite` enabled and MySQL, configure the API, and import `BackEnd/schema.sql`.
2. Copy `.env.example` to `.env.local` and set `VITE_API_URL` to the LavaLust API root. The example points to the API in this WAMP project.
3. From this directory, run `npm install` and `npm run dev`.

The API root is the backend URL without an endpoint suffix, for example `https://your-api.onrender.com`. The client uses `/api/auth/login`, `/api/auth/me`, `/api/auth/logout`, and `/api/products`.

The client stores the short-lived access token in browser local storage and sends it as a Bearer token. Logging out discards the token locally.
