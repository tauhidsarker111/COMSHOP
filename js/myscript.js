<<<<<<< HEAD
// original functions kept
function myfunc(){
    document.getElementById("myp2").innerHTML = "<h1>Welcome to WT Project</h1>";
}
console.log("WT Project loaded.");

// ── Admin: search user by username (AJAX) ────────────────────────
function getUserData(){
    var username = document.getElementById("username").value.trim();
    var resultEl = document.getElementById("search_result");
    if(!username){ resultEl.style.display="none"; return; }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            try {
                var data = JSON.parse(this.responseText);
                resultEl.style.display = "block";
                resultEl.innerHTML =
                    "<strong>Username:</strong> " + data.username +
                    "&nbsp;&nbsp;<strong>Email:</strong> " + data.email +
                    "<br><img src='../uploads/" + data.file + "' alt='Profile' width='80' height='80' style='border-radius:50%;margin-top:8px;border:3px solid #667eea;'>";
            } catch(e){
                resultEl.style.display = "block";
                resultEl.innerHTML = "<span class='error'>User not found.</span>";
            }
        }
    };
    xhttp.open("GET", "../control/profile_process.php?username=" + encodeURIComponent(username), true);
    xhttp.send();
}

// ── Add to cart (AJAX) ───────────────────────────────────────────
function addToCart(product_id){
    var msgEl = document.getElementById("cart_msg");
=======
function myfunc()
{
    document.getElementById("myp2").innerHTML = "<h1>Welcome to WT Project</h1>";
}

console.log("Hello World");

function getUserData(){
    var username=document.getElementById("username").value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
          var data = JSON.parse(this.responseText);
            document.getElementById("result").innerHTML = "Username: " + data.username + 
            "<br>Email: " + data.email 
            + "<br>Profile Image: <img src='../uploads/" + data.file + "' alt='Profile Image' width='400' height='400'><br><hr>";
        }
    };
    xhttp.open("GET", "../control/profile_process.php?username=" + username, true);
    xhttp.send();
}

// ── Task 4: Add item to cart (AJAX) ──────────────────────────────
function addToCart(product_id, name, price){
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            var data = JSON.parse(this.responseText);
<<<<<<< HEAD
            // show toast
            msgEl.innerHTML = data.message;
            msgEl.style.display = "block";
            msgEl.style.background = data.cart_count > 0 ? "#27ae60" : "#e94560";
            setTimeout(function(){ msgEl.style.display="none"; }, 3000);
            // update all cart count badges
            var badges = document.querySelectorAll(".cart-count-badge");
            badges.forEach(function(b){ b.innerHTML = data.cart_count; });
=======
            document.getElementById("cart_msg").innerHTML = data.message;
            updateCartCount(data.cart_count);
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
        }
    };
    xhttp.open("GET", "../control/cart_process.php?action=add&product_id=" + product_id, true);
    xhttp.send();
}

<<<<<<< HEAD
// ── Remove from cart (AJAX) ──────────────────────────────────────
=======
// ── Task 4: Remove item from cart (AJAX) ─────────────────────────
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
function removeFromCart(product_id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            var data = JSON.parse(this.responseText);
<<<<<<< HEAD
            var row = document.getElementById("cart_row_" + product_id);
            if(row){ row.remove(); }
            var badges = document.querySelectorAll(".cart-count-badge");
            badges.forEach(function(b){ b.innerHTML = data.cart_count; });
            var totalEl = document.getElementById("cart_total");
            if(totalEl){ totalEl.innerHTML = "$" + data.total; }
            if(data.cart_count == 0){
                var tbody = document.getElementById("cart_tbody");
                if(tbody){ tbody.innerHTML = "<tr><td colspan='5' style='text-align:center;padding:30px;color:#888;'>Cart is empty.</td></tr>"; }
            }
=======
            document.getElementById("cart_msg").innerHTML = data.message;
            // remove the row from the cart table
            var row = document.getElementById("cart_row_" + product_id);
            if(row){ row.remove(); }
            updateCartCount(data.cart_count);
            document.getElementById("cart_total").innerHTML = "Total: $" + data.total;
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
        }
    };
    xhttp.open("GET", "../control/cart_process.php?action=remove&product_id=" + product_id, true);
    xhttp.send();
}

<<<<<<< HEAD
// ── Delete review (AJAX) ─────────────────────────────────────────
=======
// ── Task 4: Update cart count badge ──────────────────────────────
function updateCartCount(count){
    var badge = document.getElementById("cart_count");
    if(badge){ badge.innerHTML = count; }
}

// ── Task 4: Delete review (AJAX) ─────────────────────────────────
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
function deleteReview(review_id){
    if(!confirm("Delete this review?")) return;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            var data = JSON.parse(this.responseText);
            if(data.success){
                var box = document.getElementById("review_" + review_id);
<<<<<<< HEAD
                if(box){ box.style.opacity="0"; setTimeout(function(){ box.remove(); }, 300); }
=======
                if(box){ box.remove(); }
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
            } else {
                alert(data.message);
            }
        }
    };
    xhttp.open("GET", "../control/review_process.php?action=delete&review_id=" + review_id, true);
    xhttp.send();
}

<<<<<<< HEAD
// ── Checkout: validate payment method selected ───────────────────
=======
// ── Task 4: Validate checkout form ───────────────────────────────
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
function validateCheckout(){
    var payment = document.querySelector('input[name="payment_method"]:checked');
    var errEl = document.getElementById("checkout_error");
    if(!payment){
<<<<<<< HEAD
        errEl.innerHTML = "⚠ Please select a payment method.";
        errEl.style.display = "block";
        return false;
    }
=======
        errEl.innerHTML = "Please select a payment method.";
        return false;
    }
    errEl.innerHTML = "";
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
    return true;
}
