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
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            var data = JSON.parse(this.responseText);
            document.getElementById("cart_msg").innerHTML = data.message;
            updateCartCount(data.cart_count);
        }
    };
    xhttp.open("GET", "../control/cart_process.php?action=add&product_id=" + product_id, true);
    xhttp.send();
}

// ── Task 4: Remove item from cart (AJAX) ─────────────────────────
function removeFromCart(product_id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            var data = JSON.parse(this.responseText);
            document.getElementById("cart_msg").innerHTML = data.message;
            // remove the row from the cart table
            var row = document.getElementById("cart_row_" + product_id);
            if(row){ row.remove(); }
            updateCartCount(data.cart_count);
            document.getElementById("cart_total").innerHTML = "Total: $" + data.total;
        }
    };
    xhttp.open("GET", "../control/cart_process.php?action=remove&product_id=" + product_id, true);
    xhttp.send();
}

// ── Task 4: Update cart count badge ──────────────────────────────
function updateCartCount(count){
    var badge = document.getElementById("cart_count");
    if(badge){ badge.innerHTML = count; }
}

// ── Task 4: Delete review (AJAX) ─────────────────────────────────
function deleteReview(review_id){
    if(!confirm("Delete this review?")) return;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
            var data = JSON.parse(this.responseText);
            if(data.success){
                var box = document.getElementById("review_" + review_id);
                if(box){ box.remove(); }
            } else {
                alert(data.message);
            }
        }
    };
    xhttp.open("GET", "../control/review_process.php?action=delete&review_id=" + review_id, true);
    xhttp.send();
}

// ── Task 4: Validate checkout form ───────────────────────────────
function validateCheckout(){
    var payment = document.querySelector('input[name="payment_method"]:checked');
    var errEl = document.getElementById("checkout_error");
    if(!payment){
        errEl.innerHTML = "Please select a payment method.";
        return false;
    }
    errEl.innerHTML = "";
    return true;
}
