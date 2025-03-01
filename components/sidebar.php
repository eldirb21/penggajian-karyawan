<div id="sidebar" class="sidebar show">
    <ul class="list-group">
        <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="list-group-item"><a href="karyawan.php">Karyawan</a></li>
        <li class="list-group-item"><a href="users.php">Users</a></li>
        <li class="list-group-item"><a href="gaji.php">Gaji</a></li>
    </ul>
</div>

<style>
    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        /* Default terbuka */
        background-color:rgb(72, 169, 76);
        padding-top: 60px;
        transition: left 0.3s ease-in-out;
        z-index: 1000;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        padding: 15px;
        display: block;
    }

    .sidebar a:hover {
        background-color: #495057;
    }

    .sidebar .list-group-item {
        background: none;
        border: none;
    }

    /* Tombol Toggle */
    #toggleSidebar {
        position: fixed;
        top: 15px;
        left: 260px;
        width: 40px;
        height: 40px;
        border-radius: 5px;
        z-index: 1100;
    }

    /* Jika sidebar disembunyikan */
    .sidebar.hide {
        left: -250px;
    }

    .main-content {
        transition: margin-left 0.3s ease-in-out;
        margin-left: 250px;
    }

    .main-content.shift {
        margin-left: 0;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleSidebar");
        const content = document.querySelector(".main-content");

        toggleButton.addEventListener("click", function () {
            sidebar.classList.toggle("hide");
            content.classList.toggle("shift");

            if (sidebar.classList.contains("hide")) {
                toggleButton.style.left = "10px";
            } else {
                toggleButton.style.left = "260px";
            }
        });
    });
</script>