import { useCallback, useEffect, useMemo, useState } from 'react'
import { apiRequest } from './api'
import './App.css'

const emptyProduct = {
  product_name: '',
  description: '',
  price: '',
  quantity: '',
}

function formatPrice(value) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
  }).format(Number(value))
}

function Login({ onLogin }) {
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [error, setError] = useState('')
  const [busy, setBusy] = useState(false)

  async function handleSubmit(event) {
    event.preventDefault()
    setError('')
    setBusy(true)

    try {
      const result = await apiRequest('/api/auth/login', {
        method: 'POST',
        body: { username, password },
      })
      onLogin(result)
    } catch (requestError) {
      setError(requestError.message)
    } finally {
      setBusy(false)
    }
  }

  return (
    <main className="login-page">
      <section className="login-card" aria-labelledby="login-title">
        <div className="brand-mark" aria-hidden="true">P</div>
        <p className="eyebrow">PRODUCT MANAGEMENT</p>
        <h1 id="login-title">Welcome back</h1>
        <p className="login-copy">Sign in to manage your product inventory.</p>
        <form className="login-form" onSubmit={handleSubmit}>
          <label>
            Username
            <input
              autoComplete="username"
              autoFocus
              onChange={(event) => setUsername(event.target.value)}
              placeholder="Enter your username"
              required
              value={username}
            />
          </label>
          <label>
            Password
            <input
              autoComplete="current-password"
              onChange={(event) => setPassword(event.target.value)}
              placeholder="Enter your password"
              required
              type="password"
              value={password}
            />
          </label>
          {error && <p className="form-error" role="alert">{error}</p>}
          <button className="button button-primary login-submit" disabled={busy} type="submit">
            {busy ? 'Signing in…' : 'Sign in'}
          </button>
        </form>
        <p className="login-footnote">Authorized users only</p>
      </section>
    </main>
  )
}

function ProductDialog({ product, onClose, onSave }) {
  const [values, setValues] = useState(product ?? emptyProduct)
  const [error, setError] = useState('')
  const [busy, setBusy] = useState(false)
  const editing = Boolean(product)

  function update(field, value) {
    setValues((current) => ({ ...current, [field]: value }))
  }

  async function handleSubmit(event) {
    event.preventDefault()
    setBusy(true)
    setError('')

    try {
      await onSave({
        ...values,
        price: Number(values.price),
        quantity: Number(values.quantity),
      })
      onClose()
    } catch (requestError) {
      setError(requestError.message)
    } finally {
      setBusy(false)
    }
  }

  return (
    <div className="dialog-backdrop" onMouseDown={(event) => {
      if (event.target === event.currentTarget) onClose()
    }}>
      <section aria-labelledby="dialog-title" aria-modal="true" className="dialog" role="dialog">
        <div className="dialog-heading">
          <div>
            <p className="eyebrow">{editing ? 'UPDATE INVENTORY' : 'INVENTORY'}</p>
            <h2 id="dialog-title">{editing ? 'Edit product' : 'Add product'}</h2>
          </div>
          <button aria-label="Close dialog" className="icon-button" onClick={onClose} type="button">×</button>
        </div>
        <form className="product-form" onSubmit={handleSubmit}>
          <label className="field-wide">
            Product name
            <input
              maxLength="100"
              onChange={(event) => update('product_name', event.target.value)}
              placeholder="e.g. Wireless headphones"
              required
              value={values.product_name}
            />
          </label>
          <label className="field-wide">
            Description <span className="optional-label">Optional</span>
            <textarea
              onChange={(event) => update('description', event.target.value)}
              placeholder="Add a short product description"
              rows="3"
              value={values.description}
            />
          </label>
          <label>
            Price
            <div className="input-with-prefix">
              <span>₱</span>
              <input
                min="0"
                onChange={(event) => update('price', event.target.value)}
                placeholder="0.00"
                required
                step="0.01"
                type="number"
                value={values.price}
              />
            </div>
          </label>
          <label>
            Quantity
            <input
              min="0"
              onChange={(event) => update('quantity', event.target.value)}
              placeholder="0"
              required
              step="1"
              type="number"
              value={values.quantity}
            />
          </label>
          {error && <p className="form-error field-wide" role="alert">{error}</p>}
          <div className="dialog-actions field-wide">
            <button className="button button-quiet" onClick={onClose} type="button">Cancel</button>
            <button className="button button-primary" disabled={busy} type="submit">
              {busy ? 'Saving…' : editing ? 'Save changes' : 'Add product'}
            </button>
          </div>
        </form>
      </section>
    </div>
  )
}

function App() {
  const [token, setToken] = useState(() => window.localStorage.getItem('product_access_token'))
  const [user, setUser] = useState(() => {
    const username = window.localStorage.getItem('product_username')
    return username ? { username } : null
  })
  const [products, setProducts] = useState([])
  const [search, setSearch] = useState('')
  const [loading, setLoading] = useState(() => Boolean(window.localStorage.getItem('product_access_token')))
  const [error, setError] = useState('')
  const [dialogProduct, setDialogProduct] = useState(null)
  const [dialogOpen, setDialogOpen] = useState(false)

  const signOut = useCallback(() => {
    window.localStorage.removeItem('product_access_token')
    window.localStorage.removeItem('product_username')
    setToken(null)
    setUser(null)
    setProducts([])
    setError('')
    setLoading(false)
  }, [])

  useEffect(() => {
    window.addEventListener('auth:expired', signOut)
    return () => window.removeEventListener('auth:expired', signOut)
  }, [signOut])

  const loadProducts = useCallback(async () => {
    try {
      const result = await apiRequest('/api/products', { token })
      setError('')
      setProducts(result.products)
    } catch (requestError) {
      setError(requestError.message)
    } finally {
      setLoading(false)
    }
  }, [token])

  useEffect(() => {
    if (!token) return

    void Promise.resolve().then(loadProducts)
  }, [token, loadProducts])

  function handleLogin(result) {
    window.localStorage.setItem('product_access_token', result.token)
    window.localStorage.setItem('product_username', result.user.username)
    setUser(result.user)
    setLoading(true)
    setToken(result.token)
  }

  async function saveProduct(values) {
    const editing = Boolean(dialogProduct)
    await apiRequest(editing ? `/api/products/${dialogProduct.id}` : '/api/products', {
      method: editing ? 'PUT' : 'POST',
      token,
      body: values,
    })
    await loadProducts()
  }

  async function deleteProduct(product) {
    if (!window.confirm(`Delete “${product.product_name}”? This action cannot be undone.`)) return
    setError('')
    try {
      await apiRequest(`/api/products/${product.id}`, { method: 'DELETE', token })
      await loadProducts()
    } catch (requestError) {
      setError(requestError.message)
    }
  }

  const visibleProducts = useMemo(() => {
    const query = search.trim().toLowerCase()
    if (!query) return products
    return products.filter((product) =>
      [product.product_name, product.description].some((value) =>
        String(value ?? '').toLowerCase().includes(query),
      ),
    )
  }, [products, search])

  if (!token) return <Login onLogin={handleLogin} />

  return (
    <div className="app-shell">
      <aside className="sidebar">
        <a className="brand" href="#" onClick={(event) => event.preventDefault()}>
          <span className="brand-mark">P</span>
          <span>Product<span className="brand-light">Desk</span></span>
        </a>
        <p className="sidebar-label">WORKSPACE</p>
        <div className="nav-item nav-item-active"><span aria-hidden="true">▦</span> Products</div>
        <div className="sidebar-bottom">
          <div className="account-avatar">{(user?.username ?? 'U').slice(0, 1).toUpperCase()}</div>
          <div className="account-copy">
            <strong>{user?.username ?? 'Account'}</strong>
            <span>Administrator</span>
          </div>
          <button aria-label="Log out" className="icon-button logout-button" onClick={signOut} title="Log out" type="button">↗</button>
        </div>
      </aside>

      <main className="main-panel">
        <header className="topbar">
          <span>Workspace <span className="crumb-divider">/</span> Products</span>
          <button className="button button-outline topbar-logout" onClick={signOut} type="button">Log out</button>
        </header>

        <section className="content">
          <div className="page-heading">
            <div>
              <p className="eyebrow">YOUR INVENTORY</p>
              <h1>Products</h1>
              <p className="page-subtitle">Manage your products and keep inventory up to date.</p>
            </div>
            <button className="button button-primary add-button" onClick={() => {
              setDialogProduct(null)
              setDialogOpen(true)
            }} type="button">
              <span aria-hidden="true">+</span> Add product
            </button>
          </div>

          <div className="summary-card">
            <span className="summary-icon" aria-hidden="true">▦</span>
            <div><span className="summary-label">Total products</span><strong>{products.length}</strong></div>
            <span className="summary-note">in your catalog</span>
          </div>

          <section aria-labelledby="catalog-title" className="catalog-card">
            <div className="catalog-toolbar">
              <div>
                <h2 id="catalog-title">Product catalog</h2>
                <p>{products.length} {products.length === 1 ? 'item' : 'items'} in total</p>
              </div>
              <label className="search-box">
                <span aria-hidden="true">⌕</span>
                <input
                  aria-label="Search products"
                  onChange={(event) => setSearch(event.target.value)}
                  placeholder="Search products"
                  type="search"
                  value={search}
                />
              </label>
            </div>
            {error && <div className="notice-error" role="alert">{error}</div>}
            <div className="table-scroll">
              <table>
                <thead>
                  <tr><th>PRODUCT</th><th>PRICE</th><th>QUANTITY</th><th>STATUS</th><th><span className="sr-only">Actions</span></th></tr>
                </thead>
                <tbody>
                  {loading ? (
                    <tr><td className="empty-state" colSpan="5">Loading products…</td></tr>
                  ) : visibleProducts.length === 0 ? (
                    <tr>
                      <td className="empty-state" colSpan="5">
                        <span className="empty-icon">▦</span>
                        <strong>{search ? 'No matching products' : 'No products yet'}</strong>
                        <span>{search ? 'Try another search term.' : 'Add your first product to get started.'}</span>
                      </td>
                    </tr>
                  ) : visibleProducts.map((product) => (
                    <tr key={product.id}>
                      <td>
                        <div className="product-cell">
                          <span aria-hidden="true" className="product-avatar">{product.product_name.slice(0, 1).toUpperCase()}</span>
                          <span><strong>{product.product_name}</strong><small>{product.description || 'No description'}</small></span>
                        </div>
                      </td>
                      <td className="price-cell">{formatPrice(product.price)}</td>
                      <td>{product.quantity}</td>
                      <td><span className={`status-pill ${Number(product.quantity) > 0 ? 'status-in-stock' : 'status-out'}`}>
                        <span />{Number(product.quantity) > 0 ? 'In stock' : 'Out of stock'}
                      </span></td>
                      <td>
                        <div className="row-actions">
                          <button aria-label={`Edit ${product.product_name}`} className="icon-button" onClick={() => {
                            setDialogProduct(product)
                            setDialogOpen(true)
                          }} title="Edit product" type="button">✎</button>
                          <button aria-label={`Delete ${product.product_name}`} className="icon-button delete-action" onClick={() => deleteProduct(product)} title="Delete product" type="button">⌫</button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
            <div className="table-footer">Showing <strong>{visibleProducts.length}</strong> of <strong>{products.length}</strong> products</div>
          </section>
          <footer className="page-footer">ProductDesk <span>·</span> Inventory management</footer>
        </section>
      </main>
      {dialogOpen && (
        <ProductDialog
          onClose={() => setDialogOpen(false)}
          onSave={saveProduct}
          product={dialogProduct}
        />
      )}
    </div>
  )
}

export default App
