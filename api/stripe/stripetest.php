    <section id="cart_items">
                <div class="container">
                    <form action="" method="POST" class="pay-now form-group">
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="<?php echo $params['public_test_key']; ?>"
                            data-amount="<?php echo $totalserviceprice * 100; ?>"
                            data-name="Moovr"
                            data-locale="auto"
                            data-zip-code="true">
                        </script>
                    </form>
                </div>
            </section>
    <?php
   
session_start();
require 'Stripe.php';

$params = array(
    "testmode" => "on",
    "private_live_key" => "sk_live_xxxxxxxxxxxxxxxxxxxxx",
    "public_live_key" => "pk_live_xxxxxxxxxxxxxxxxxxxxx",
    "private_test_key" => "sk_test_Fj5Pe9dK9PpA6KYMZP2U1m94",
    "public_test_key" => "pk_test_K1Cb8LgM54tKkNjlGDzMrOAM"
);

if ($params['testmode'] == "on") {
    Stripe::setApiKey($params['private_test_key']);
    $pubkey = $params['public_test_key'];
} else {
    Stripe::setApiKey($params['private_live_key']);
    $pubkey = $params['public_live_key'];
}
               $customer = Stripe_Customer::create(array(
                    "source" => $_POST['stripeToken'],
                    "description" => "miti")
        );
               var_dump($customer);
        ?>