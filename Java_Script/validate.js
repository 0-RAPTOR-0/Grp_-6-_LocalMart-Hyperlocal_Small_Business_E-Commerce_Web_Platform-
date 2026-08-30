const registerForm = document.getElementById("registerForm");

if (registerForm) {

  registerForm.addEventListener("submit", function (event) {

    let isValid = true; 

 
    clearError("fullnameError");
    clearError("emailError");
    clearError("phoneError");
    clearError("areaError");
    clearError("passwordError");
    clearError("confirmPasswordError");
    clearMessage();


    const fullname = document.getElementById("fullname").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const area = document.getElementById("area").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

   
    if (fullname === "") {

      showError("fullnameError", "Full name is required.");

      isValid = false;

    } else if (fullname.length < 3) {

      showError("fullnameError", "Name must be at least 3 characters.");

      isValid = false;

    }

   
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {

      showError("emailError", "Email is required.");

      isValid = false;

    } else if (!emailPattern.test(email)) {

      showError("emailError", "Please enter a valid email address.");

      isValid = false;

    }

   
    const phonePattern = /^01[0-9]{9}$/;

    if (phone === "") {

      showError("phoneError", "Phone number is required.");

      isValid = false;

    } else if (!phonePattern.test(phone)) {

      showError("phoneError", "Phone must be 11 digits, e.g. 01712345678");

      isValid = false;

    }


    if (area === "") {

      showError("areaError", "Area / Neighbourhood is required.");

      isValid = false;

    }

  
    if (password === "") {

      showError("passwordError", "Password is required.");

      isValid = false;

    } else if (password.length < 8) {

      showError("passwordError", "Password must be at least 8 characters.");
      
      isValid = false;

    }


    if (confirmPassword === "") {

      showError("confirmPasswordError", "Please confirm your password.");

      isValid = false;

    } else if (password !== confirmPassword) {

      showError("confirmPasswordError", "Passwords do not match.");

      isValid = false;

    }


    if (!isValid) {

      event.preventDefault();

      showMessage("Please fix the errors above.", "error");

    }

 
  });
}


const loginForm = document.getElementById("loginForm");

if (loginForm) {

  loginForm.addEventListener("submit", function (event) {
    
    let isValid = true;

    clearError("emailError");
    clearError("passwordError");
    clearMessage();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {

      showError("emailError", "Email is required.");

      isValid = false;

    } else if (!emailPattern.test(email)) {

      showError("emailError", "Please enter a valid email address.");

      isValid = false;

    }

    if (password === "") {

      showError("passwordError", "Password is required.");

      isValid = false;

    }

    if (!isValid) {

      event.preventDefault();

      showMessage("Please fix the errors above.", "error");

    }

  });
}

const checkoutForm = document.getElementById("checkoutForm");

if (checkoutForm) {

  checkoutForm.addEventListener("submit", function (event) {

    let isValid = true;

    clearError("addressError");
    clearError("cityError");
    clearError("paymentError");
    clearMessage();

    const address = document.getElementById("address").value.trim();
    const city = document.getElementById("city").value;

    const paymentSelected = document.querySelector('input[name="payment"]:checked');

  
    if (address === "") {

      showError("addressError", "Delivery address is required.");

      isValid = false;

    }


    if (city === "") {

      showError("cityError", "Please select a city.");

      isValid = false;

    }

   
    if (!paymentSelected) {

      showError("paymentError", "Please choose a payment method.");

      isValid = false;

    }


    if (!isValid) {

      event.preventDefault();

      showMessage("Please fix the errors above.", "error");

    }

  });
}


const shopRegisterForm = document.getElementById("shopRegisterForm");

if (shopRegisterForm) {
  shopRegisterForm.addEventListener("submit", function (event) {

    let isValid = true;

    clearError("ownernameError");
    clearError("shopnameError");
    clearError("categoryError");
    clearError("emailError");
    clearError("phoneError");
    clearError("areaError");
    clearError("passwordError");
    clearError("confirmPasswordError");
    clearMessage();

    const ownername = document.getElementById("ownername").value.trim();
    const shopname = document.getElementById("shopname").value.trim();
    const category = document.getElementById("category").value;
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const area = document.getElementById("area").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^01[0-9]{9}$/;

    if (ownername === "") {

      showError("ownernameError", "Owner name is required.");

      isValid = false;

    } else if (ownername.length < 3) {

      showError("ownernameError", "Name must be at least 3 characters.");

      isValid = false;

    }


    if (shopname === "") {

      showError("shopnameError", "Shop name is required.");

      isValid = false;

    }


    if (category === "") {

      showError("categoryError", "Please select a category.");

      isValid = false;

    }


    if (email === "") {

      showError("emailError", "Email is required.");

      isValid = false;

    } else if (!emailPattern.test(email)) {

      showError("emailError", "Please enter a valid email address.");

      isValid = false;

    }


    if (phone === "") {

      showError("phoneError", "Phone number is required.");

      isValid = false;

    } else if (!phonePattern.test(phone)) {

      showError("phoneError", "Phone must be 11 digits, e.g. 01712345678");

      isValid = false;

    }


    if (area === "") {

      showError("areaError", "Area / Neighbourhood is required.");

      isValid = false;

    }


    if (password === "") {

      showError("passwordError", "Password is required.");

      isValid = false;

    } else if (password.length < 8) {

      showError("passwordError", "Password must be at least 8 characters.");

      isValid = false;

    }


    if (confirmPassword === "") {

      showError("confirmPasswordError", "Please confirm your password.");

      isValid = false;

    } else if (password !== confirmPassword) {

      showError("confirmPasswordError", "Passwords do not match.");

      isValid = false;

    }


    if (!isValid) {

      event.preventDefault();

      showMessage("Please fix the errors above.", "error");

    }

  });
}

const productForm = document.getElementById("productForm");

if (productForm) {
  productForm.addEventListener("submit", function (event) {

    let isValid = true;

    clearError("pnameError");
    clearError("pcategoryError");
    clearError("ppriceError");
    clearError("pstockError");
    clearMessage();

    const pname = document.getElementById("pname").value.trim();
    const pcategory = document.getElementById("pcategory").value;
    const pprice = document.getElementById("pprice").value;
    const pstock = document.getElementById("pstock").value;

    if (pname === "") {

      showError("pnameError", "Product name is required.");

      isValid = false;

    }

    if (pcategory === "") {

      showError("pcategoryError", "Please select a category.");

      isValid = false;

    }

    if (pprice === "") {

    showError("ppriceError", "Price is required.");

      isValid = false;

    } 

    else if (isNaN(pprice) || Number(pprice) <= 0) {

    showError("ppriceError", "Price must be a number greater than 0.");
    
    isValid = false;

    }

    if (pstock === "") {

      showError("pstockError", "Stock quantity is required.");

      isValid = false;

    } 
    
    else if (isNaN(pstock) || Number(pstock) < 0) {

      showError("pstockError", "Stock must be a number (0 or more).");

      isValid = false;

    }


    if (!isValid) {

      event.preventDefault();

      showMessage("Please fix the errors above.", "error");

    }

  });
}


function showError(elementId, message) {

  const errorElement = document.getElementById(elementId);

  if (errorElement) {

    errorElement.textContent = message;

  }

}

function showMessage(message, type) {

  const box = document.getElementById("formMessage");

  if (box) {

    box.textContent = message;
    box.className = type === "error" ? "form-message error" : "form-message success";
  
  }

}

function clearMessage() {

  const box = document.getElementById("formMessage");

  if (box) {

    box.textContent = "";
    box.className = "";

  }
  
}
