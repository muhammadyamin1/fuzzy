<?php
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}
?>
<div class="user-info">
    <div class="image">
        <img src="images/admin.jpg  " width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo htmlspecialchars($_SESSION['nama']); ?></div>
        <div class="email"><?php echo htmlspecialchars($_SESSION['role']); ?></div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="editUser.php?id=<?php echo $userId ?>"><i class="material-icons">person</i>Kelola Profil</a></li>
                <li><a href="logout.php"><i class="material-icons">input</i>Logout</a></li>
            </ul>
        </div>
    </div>
</div>