<?php 
    $roleID = $_SESSION['role_id'];
?>
<ul>
    <li><a href="./index.php"><i class="lni lni-home"></i><span>Dashboard</span></a></li>
    <?php if($roleID == 2){ ?>
        <li><a href="./index.php?export=true"><i class="lni lni-text-format"></i><span>Exportar relatório</span></a></li>
    <?php } ?>
    <li><a href="./index.php?logout=true"><i class="lni lni-text-format"></i><span>Logout</span></a></li>
</ul>