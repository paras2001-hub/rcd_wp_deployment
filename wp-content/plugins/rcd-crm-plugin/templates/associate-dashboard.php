<div class="associate-dashboard">
    <h1>Associate Dashboard</h1>
    <p>Welcome, <?php echo wp_get_current_user()->display_name; ?>!</p>

    <h2>Your Referral Link</h2>
    <?php rcd_crm_display_referral_link(get_current_user_id()); ?>

    <h2>Your Leads</h2>
    <form method="post">
        <input type="text" name="lead_name" placeholder="Lead Name" required>
        <textarea name="lead_details" placeholder="Lead Details" required></textarea>
        <select name="lead_status" required>
            <option value="new">New</option>
            <option value="in_progress">In Progress</option>
            <option value="closed">Closed</option>
        </select>
        <button type="submit" name="rcd_crm_add_lead">Add Lead</button>
    </form>

    <?php rcd_crm_display_leads(get_current_user_id()); ?>

    <h2>KYC Document Upload</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="kyc_file" required>
        <button type="submit" name="rcd_crm_upload_kyc">Upload KYC Document</button>
    </form>

    <?php rcd_crm_display_kyc_status(get_current_user_id()); ?>

    <h2>Your Commissions</h2>
    <?php rcd_crm_display_commission(get_current_user_id()); ?>

    <h2>Your Referral Stats</h2>
    <?php rcd_crm_display_referral_stats(get_current_user_id()); ?>
</div>

<h2>KYC Document Upload</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="kyc_file" required>
    <button type="submit" name="rcd_crm_upload_kyc">Upload KYC Document</button>
</form>

<?php rcd_crm_display_kyc_status(get_current_user_id()); ?>
