document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("toggleSidebar");
    const content = document.querySelector(".main-content");

    toggleButton.addEventListener("click", function () {
        sidebar.classList.toggle("hide");
        content.classList.toggle("shift");
    });
});
