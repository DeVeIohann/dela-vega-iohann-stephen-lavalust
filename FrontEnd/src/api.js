const API_URL = (import.meta.env.VITE_API_URL || 'http://localhost/CRUD%20with%20Authentication/BackEnd')
  .replace(/\/+$/, '')

export async function apiRequest(path, { method = 'GET', token, body } = {}) {
  let response

  try {
    response = await fetch(`${API_URL}${path}`, {
      method,
      headers: {
        Accept: 'application/json',
        ...(body ? { 'Content-Type': 'application/json' } : {}),
        ...(token ? { Authorization: `Bearer ${token}` } : {}),
      },
      ...(body ? { body: JSON.stringify(body) } : {}),
    })
  } catch {
    throw new Error(`Could not reach the API at ${API_URL}. Check the API URL and server.`)
  }

  let result
  try {
    result = await response.json()
  } catch {
    throw new Error(`The API returned an invalid response (HTTP ${response.status}).`)
  }

  if (!response.ok) {
    if (response.status === 401 && token) {
      window.dispatchEvent(new Event('auth:expired'))
    }
    throw new Error(result.error || result.message || `Request failed (HTTP ${response.status}).`)
  }

  return result
}
