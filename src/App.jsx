import React, { useState, useEffect } from 'react';
import API from './services/api';
import './App.css';

function App() {
  const [token, setToken] = useState(localStorage.getItem('token') || '');
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [products, setProducts] = useState([]);
  const [form, setForm] = useState({ id: null, product_name: '', description: '', price: '', quantity: '' });
  const [isEditing, setIsEditing] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    try {
      const res = await API.get('/api/products');
      setProducts(res.data.data || []);
    } catch (err) {
      console.error(err);
    }
  };

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const res = await API.post('/api/auth/login', { username, password });
      const authToken = res.data.data.token;
      localStorage.setItem('token', authToken);
      setToken(authToken);
      setError('');
    } catch (err) {
      setError('Invalid username or password');
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('token');
    setToken('');
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      if (isEditing) {
        await API.put(`/api/products/${form.id}`, form);
      } else {
        await API.post('/api/products', form);
      }
      setForm({ id: null, product_name: '', description: '', price: '', quantity: '' });
      setIsEditing(false);
      fetchProducts();
    } catch (err) {
      alert('Operation failed. Ensure you are logged in.');
    }
  };

  const handleEdit = (product) => {
    setForm(product);
    setIsEditing(true);
  };

  const handleDelete = async (id) => {
    if (window.confirm('Delete this product?')) {
      try {
        await API.delete(`/api/products/${id}`);
        fetchProducts();
      } catch (err) {
        alert('Delete failed.');
      }
    }
  };

  return (
    <div className="container" style={{ padding: '20px', fontFamily: 'sans-serif' }}>
      <h1>Product Management System</h1>

      {!token ? (
        <div style={{ maxWidth: '300px', margin: 'auto' }}>
          <h2>Login</h2>
          {error && <p style={{ color: 'red' }}>{error}</p>}
          <form onSubmit={handleLogin}>
            <div>
              <label>Username</label>
              <input type="text" value={username} onChange={(e) => setUsername(e.target.value)} required style={{ width: '100%', marginBottom: '10px' }} />
            </div>
            <div>
              <label>Password</label>
              <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} required style={{ width: '100%', marginBottom: '10px' }} />
            </div>
            <button type="submit" style={{ width: '100%', padding: '8px' }}>Login</button>
          </form>
        </div>
      ) : (
        <div>
          <button onClick={handleLogout} style={{ float: 'right', marginBottom: '10px' }}>Logout</button>
          
          <h2>{isEditing ? 'Edit Product' : 'Add Product'}</h2>
          <form onSubmit={handleSubmit} style={{ marginBottom: '20px', display: 'flex', gap: '10px', flexWrap: 'wrap' }}>
            <input type="text" placeholder="Product Name" value={form.product_name} onChange={(e) => setForm({ ...form, product_name: e.target.value })} required />
            <input type="text" placeholder="Description" value={form.description} onChange={(e) => setForm({ ...form, description: e.target.value })} />
            <input type="number" step="0.01" placeholder="Price" value={form.price} onChange={(e) => setForm({ ...form, price: e.target.value })} required />
            <input type="number" placeholder="Quantity" value={form.quantity} onChange={(e) => setForm({ ...form, quantity: e.target.value })} required />
            <button type="submit">{isEditing ? 'Update' : 'Add'}</button>
            {isEditing && <button type="button" onClick={() => { setIsEditing(false); setForm({ id: null, product_name: '', description: '', price: '', quantity: '' }); }}>Cancel</button>}
          </form>

          <h2>Product List</h2>
          <table border="1" cellPadding="8" style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {products.map((p) => (
                <tr key={p.id}>
                  <td>{p.id}</td>
                  <td>{p.product_name}</td>
                  <td>{p.description}</td>
                  <td>${parseFloat(p.price).toFixed(2)}</td>
                  <td>{p.quantity}</td>
                  <td>
                    <button onClick={() => handleEdit(p)} style={{ marginRight: '5px' }}>Edit</button>
                    <button onClick={() => handleDelete(p.id)}>Delete</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}

export default App;