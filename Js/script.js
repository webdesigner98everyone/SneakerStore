document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector(".menu-toggle");
    const navigation = document.querySelector(".navegacion");
  
    menuToggle.addEventListener("click", function() {
      const ariaExpanded = this.getAttribute("aria-expanded") === "true";
      this.setAttribute("aria-expanded", !ariaExpanded);
      navigation.classList.toggle("active");
    });
  });