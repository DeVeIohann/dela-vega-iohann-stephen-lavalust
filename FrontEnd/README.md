# ProductDesk Front End

React and Vite client for the LavaLust product-management API.

## Run locally

1. Start Apache with `mod_rewrite` enabled and MySQL, configure the API, and import `BackEnd/schema.sql`.
2. Copy `.env.example` to `.env.local` and set `VITE_API_URL` to the LavaLust API root. The example points to the API in this WAMP project.
3. From this directory, run `npm install` and `npm run dev`.

The API root is the backend URL without an endpoint suffix, for example `https://your-api.onrender.com`. The client uses `/api/auth/login`, `/api/auth/me`, `/api/auth/logout`, and `/api/products`.

The client stores its short-lived access token in browser local storage and sends it with authenticated API requests. Logging out discards the token locally.

## Deploy to Render

Deploy this folder as a **Static Site** (not a Web Service):

1. In Render, create a new Static Site and connect the GitHub repository.
2. Set **Root Directory** to `FrontEnd`.
3. Set **Build Command** to `npm ci && npm run build`.
4. Set **Publish Directory** to `dist`.
5. Add the environment variable `VITE_API_URL` with the root URL of your deployed LavaLust API, such as `https://your-api.onrender.com`. Do not add `/api` to the end. This value is embedded during the frontend build, so set it before deploying.
6. Deploy the site. If the Render URL changes, update `VITE_API_URL` and redeploy.

The API must also allow requests from the deployed site's exact origin. Set the backend's `FRONTEND_ORIGIN` environment variable to the Render frontend URL (for example, `https://your-productdesk.onrender.com`) and redeploy the API. Use HTTPS URLs for both services.
