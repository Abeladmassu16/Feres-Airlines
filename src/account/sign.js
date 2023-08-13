document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("myInput");
    const confirmPasswordInput = document.getElementById("myInput1");
    const passwordFeedback = document.getElementById("password-feedback");
  
    confirmPasswordInput.addEventListener("input", function () {
      if (confirmPasswordInput.value === "") {
        passwordFeedback.textContent = "";
      } else if (passwordInput.value === confirmPasswordInput.value) {
        passwordFeedback.textContent = "Passwords match!";
        passwordFeedback.style.color = "rgb(10, 50, 10)";
      } else {
        passwordFeedback.textContent = "Passwords do not match!";
        passwordFeedback.style.color = "red";
      }
    });
  });
  