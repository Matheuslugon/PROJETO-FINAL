<?php 
    if($_SESSION && (array_key_exists('error', $_SESSION) || array_key_exists('success', $_SESSION))){
        $error = array_key_exists('error', $_SESSION) ? $_SESSION['error'] : null;
        $success = array_key_exists('success', $_SESSION) ? $_SESSION['success'] : null;
?>
        <div class="alert <?php echo $error ? 'error' : 'success'; ?>">
            <p><?php echo $error ? $error : $success ?></p>
        </div>
<?php
    }

    unset($_SESSION['success']);
    unset($_SESSION['error']);
?>
