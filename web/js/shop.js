/* Script simple para cargar productos y manejar un carrito en localStorage */
(function(){
  const productsEl = document.getElementById('products');
  const cartItemsEl = document.getElementById('cart-items');
  const cartTotalEl = document.getElementById('cart-total');

  let products = [];
  let cart = JSON.parse(localStorage.getItem('mh_cart') || '[]');

  function formatPrice(v){
    return new Intl.NumberFormat('es-AR', { style: 'currency', currency: 'ARS', maximumFractionDigits: 0 }).format(Number(v || 0));
  }

  const filters = { color: '', size: '' };

  function passesFilters(p){
    if(filters.color && (!(p.colors||[]).includes(filters.color))) return false;
    if(filters.size && (!(p.sizes||[]).includes(filters.size))) return false;
    return true;
  }

  function renderProducts(){
    productsEl.innerHTML = '';
    products.forEach(p => {
      if(!passesFilters(p)) return;
      const div = document.createElement('div');
      div.className = 'product-card';
      div.innerHTML = `
        <img src="${p.img}" alt="${p.name}">
        <h3>${p.name}</h3>
        <p class="price">${formatPrice(p.price)}</p>
        <p>${p.description}</p>
        <p><small>Colores: ${ (p.colors||[]).join(', ') } · Tallas: ${ (p.sizes||[]).join(', ') }</small></p>
        <div class="product-actions">
          <button class="btn btn-secondary" data-id="${p.id}">Agregar</button>
          <a class="btn btn-primary" href="product.php?id=${encodeURIComponent(p.id)}">Ver</a>
        </div>
      `;
      productsEl.appendChild(div);
    });
    // attach events
    productsEl.querySelectorAll('button[data-id]').forEach(btn => btn.addEventListener('click', e => {
      const id = e.currentTarget.getAttribute('data-id');
      addToCart(id);
    }));
  }

  function addToCart(id){
    const p = products.find(x=>x.id===id);
    if(!p) return;
    const item = cart.find(x=>x.id===id);
    if(item) item.qty += 1; else cart.push({ id: p.id, name: p.name, price: p.price, qty: 1 });
    saveCart();
    renderCart();
  }

  function saveCart(){ localStorage.setItem('mh_cart', JSON.stringify(cart)); }

  function renderCart(){
    if(cart.length===0){ cartItemsEl.textContent = 'No hay productos en el carrito.'; cartTotalEl.textContent = formatPrice(0); return; }
    cartItemsEl.innerHTML = '';
    let total = 0;
    cart.forEach(it => {
      const row = document.createElement('div');
      row.className = 'cart-row';
      row.innerHTML = `<div>${it.name} x${it.qty}</div><div>${formatPrice(it.price*it.qty)}</div>`;
      cartItemsEl.appendChild(row);
      total += it.price * it.qty;
    });
    cartTotalEl.textContent = formatPrice(total);
    const checkoutBtn = document.getElementById('checkout-btn');
    if(checkoutBtn){
      checkoutBtn.onclick = function(){
        if(cart.length===0){ alert('El carrito está vacío.'); return; }
        // Redirect to checkout form page; the form will read cart from localStorage
        window.location.href = (typeof CHECKOUT_URL !== 'undefined') ? CHECKOUT_URL.replace('checkout.php','checkout_form.php') : 'checkout_form.html';
      };
    }
  }

  function renderFilterControls(){
    const container = document.createElement('div');
    container.className = 'shop-filters';
    const colors = new Set();
    const sizes = new Set();
    products.forEach(p=>{ (p.colors||[]).forEach(c=>colors.add(c)); (p.sizes||[]).forEach(s=>sizes.add(s)); });
    let html = '<label>Color: <select id="filter-color"><option value="">Todos</option>' + Array.from(colors).map(c=>`<option value="${c}">${c}</option>`).join('') + '</select></label>';
    html += ' <label>Talla: <select id="filter-size"><option value="">Todas</option>' + Array.from(sizes).map(s=>`<option value="${s}">${s}</option>`).join('') + '</select></label>';
    container.innerHTML = html;
    productsEl.parentNode.insertBefore(container, productsEl);
    document.getElementById('filter-color').addEventListener('change', e=>{ filters.color = e.target.value; renderProducts(); });
    document.getElementById('filter-size').addEventListener('change', e=>{ filters.size = e.target.value; renderProducts(); });
  }

  function loadProducts(){
    fetch(PRODUCTS_URL).then(r=>r.json()).then(json=>{ products = json.products || []; renderFilterControls(); renderProducts(); renderCart(); }).catch(err=>{
      productsEl.innerHTML = '<p>Error cargando productos.</p>';
      console.error(err);
    });
  }

  // init
  if(!productsEl){ console.warn('No products container found'); } else { loadProducts(); }
})();
