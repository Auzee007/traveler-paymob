<div class="traveler-paymob-admin">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand d-flex align-items-center gap-2">
                <img src="<?= Traveler_Payhere_Payment::get_inst()->pluginUrl ?>assets/img/us.png" alt="Paymob">
                <span class="dashicons dashicons-admin-links" style="margin-right: 7px; transform: rotate(45deg)"></span>
                <img src="<?= Traveler_Payhere_Payment::get_inst()->pluginUrl ?>assets/img/logo-st.png" alt="Traveler">
            </div>
            <ul class="navbar-nav mx-auto"></ul>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="https://studio.pixeleator.com?utm_source=traveler_paymob_plugin&position=license_activation_admin" class="nav-link">
                        <span><small>Powered by: </small> <img src="<?= Traveler_Payhere_Payment::get_inst()->pluginUrl ?>assets/img/favicon.png" alt="Pixeleator Studio"> <strong>Pixeleator Studio</strong></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content">
        <div class="text-center">
            <h1 class="display-3 fw-bold mb-2">License Activation</h1>
            <p class="lead mb-5">To activate your license, please sign in to your <br> account on our system</p>
            <button class="btn btn-primary btn-rounded" onclick="document.getElementById('traveler-paymob-signin').submit()">Sign In</button>
        </div>
    </div>

    <form action="https://google.com" method="post" id="traveler-paymob-signin">
        <input type="hidden" name="action" value="activate_license_signin">
        <input type="hidden" name="domain" value="<?= site_url() ?>">
    </form>

    <?php  ?>
</div>
