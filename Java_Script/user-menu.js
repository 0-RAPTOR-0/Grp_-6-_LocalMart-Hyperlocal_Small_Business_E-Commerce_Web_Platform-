function toggleUserDropdown() {

  document.getElementById("userDropdown").classList.toggle("show");

}

window.addEventListener("click", function (event) {

  if (event.target.matches(".user-menu-trigger")) {
  return;
}

const dropdown = document.getElementById("userDropdown");

  if (dropdown && dropdown.classList.contains("show")) {

    if (!event.target.closest(".user-dropdown")) {

      dropdown.classList.remove("show");

    }

  }
  
});
