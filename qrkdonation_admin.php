<?php 
    if($_POST['qrkdon_hidden'] == 'Y') {
//Form data sent
        $qrkdonationaddress = $_POST['qrkdon_donationaddress'];
        update_option('qrkdon_donationaddress', $qrkdonationaddress);
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
        $qrkdonationaddress = get_option('qrkdon_donationaddress');
    }
?>

<div class="wrap">
    <?php    echo "<h2>" . __( 'Quark Coin Donation Button Options', 'qrkdon_trdom' ) . "</h2>"; ?>
     
    <form name="qrkdon_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="qrkdon_hidden" value="Y">
        <?php    echo "<h4>" . __( 'Address Settings', 'qrkdon_trdom' ) . "</h4>"; ?>
        <p><?php _e("QuarkCoin Donation Address:" ); ?><input type="text" name="qrkdon_donationaddress" value="<?php echo $qrkdonationaddress; ?>" size="40"><?php _e(" ex: QdsGyDorBG7UxKryUiz1wwPdmmUv7ajcxk" ); ?></p>
     
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'qrkdon_trdom' ) ?>" />
        </p>
    </form>
</div>