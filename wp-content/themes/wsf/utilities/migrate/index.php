<?php
    define( 'WP_USE_THEMES', false );
    require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/wp-load.php' );
    $role = false;
if (is_user_logged_in()) {
    if (current_user_can('administrator')) {
        //echo 'This will display for WordPress admins only.';
        $role = true;
    } else {
        echo 'You must be an administrator to view this page.';
    };
} else {
    echo 'You must be logged in to view this page.';
}
if ($role) :
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/migrate/assets/migrate.css" media="all">
</head>

<body class="cleanpage" style="font-family:Verdana,Geneva,Tahoma,sans-serif;">
    <div class="container" style="max-width:90%;margin:50px auto;">
        
        <form action="">
            <div class="col">
            <h3>Step 1. Select the transfer from environment.</h3>
                <label for="transfer_from">Transferring From:</label>
                <select name="transfer_from" id="transfer_from">
                    <option value="">Select Environment...</option>
                    <option value="production">Production</option>
                    <option value="staging">Staging</option>
                    <option value="development">Development</option>
                </select>
            </div>
            <div class="arrow">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000" class="w-6 h-6">
                <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>
            </div>
            <div class="col step-2">
            <h3>Step 2. Select the destination environment.</h3>
                <label for="transfer_to">Transferring To:</label>
                <select name="transfer_to" id="transfer_to">
                </select>
            </div>
        </form>
    </div>
    <div id="show_cli" class="container show-cli">
        <p style="font-weight:bold;font-size:18px;margin-bottom:20px;">EXAMPLE: wp search-replace --network 'http://old.example.com' 'http://new.example.com' --url=old.example.com</p>
        <div id="cli_wrapper" class="cli-wrapper"></div>
    </div>
    <script type="text/javascript" src="/migrate/assets/migrate.js"></script>
</body>
</html>
<?php endif; ?>