<?php
require_once 'includes/config.php';
$pageTitle = 'Formulario de Checkout';
require_once 'includes/header.php';
?>

<div class="container">
  <h2>Finalizar compra</h2>
  <p>Revisa tu información y elige método de pago.</p>
  <form id="checkout-form" method="POST" action="checkout.php">
    <label>Nombre completo:<br><input type="text" name="buyer_name" required></label><br>
    <label>Email:<br><input type="email" name="buyer_email" required></label><br>
    <label>Teléfono:<br><input type="text" name="buyer_phone"></label><br>
    <label>Método de pago:<br>
        <select name="payment_method" id="payment_method">
          <option value="mail">Contacto por email</option>
          <option value="stripe">Stripe (configurar)</option>
          <option value="paypal">PayPal (configurar)</option>
        </select>
    </label>
    <input type="hidden" name="cart" id="cart-input">
      <p><button class="btn btn-primary" type="submit" id="submit-btn">Enviar pedido</button></p>
      <div id="paypal-button-container" style="margin-top:12px;"></div>
  </form>
</div>

<script>
  // populate hidden input from localStorage
  (function(){
    const cart = localStorage.getItem('mh_cart') || '[]';
    document.getElementById('cart-input').value = cart;
      window._mh_cart = JSON.parse(cart);
  })();

  // PayPal integration
  (function(){
    const pm = document.getElementById('payment_method');
    const submitBtn = document.getElementById('submit-btn');
    const paypalContainer = document.getElementById('paypal-button-container');
    function updateUI(){
      if(pm.value === 'paypal'){
        submitBtn.style.display = 'none';
        renderPayPal();
      } else {
        submitBtn.style.display = '';
        paypalContainer.innerHTML = '';
      }
    }
    pm.addEventListener('change', updateUI);
    updateUI();

    function renderPayPal(){
      if(!window.paypal){
        const s = document.createElement('script');
        s.src = 'https://www.paypal.com/sdk/js?client-id=<?php echo htmlspecialchars(PAYPAL_CLIENT_ID); ?>&currency=USD';
        s.onload = renderPayPal;
        document.head.appendChild(s);
        return;
      }

      paypal.Buttons({
        createOrder: function(data, actions){
          // call server to create order
          return fetch('create_paypal_order.php', {
            method: 'POST', headers: {'Content-Type':'application/json'},
            body: JSON.stringify({ cart: window._mh_cart || [], buyer: { name: document.querySelector('[name=buyer_name]').value, email: document.querySelector('[name=buyer_email]').value, phone: document.querySelector('[name=buyer_phone]').value } })
          }).then(r=>r.json()).then(j=>{
            if(j.id) return j.id; throw new Error('Failed to create order');
          });
        },
        onApprove: function(data, actions){
          // capture on server and save order
          return fetch('capture_paypal_order.php', {
            method: 'POST', headers: {'Content-Type':'application/json'},
            body: JSON.stringify({ orderID: data.orderID, cart: window._mh_cart || [], buyer: { name: document.querySelector('[name=buyer_name]').value, email: document.querySelector('[name=buyer_email]').value, phone: document.querySelector('[name=buyer_phone]').value } })
          }).then(r=>r.json()).then(j=>{
            if(j.success){ window.location.href = 'checkout.php?order_id=' + encodeURIComponent(j.order_id); } else { alert('Error processing PayPal payment'); }
          });
        }
      }).render('#paypal-button-container');
    }
  })();
</script>

<?php require_once 'includes/footer.php'; ?>
