<?php
	// ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $merchant = $_GET['merchant'];
    
    // Read the JSON file 
    $json = file_get_contents('environments.json');
    
    // Decode the JSON file
    $json_data = json_decode($json, true);

    if(!isset($json_data[$merchant]) || empty($json_data[$merchant])) {
        die("Invalid merchant");
    }

	$merchant_key = $json_data[$merchant]["key"];
	$salt = $json_data[$merchant]["salt"];
	$url = $json_data[$merchant]["url"];
    
    $txnid = $milliseconds = floor(microtime(true) * 1000);
    
    if(!isset($_GET["surl"]) || empty($_GET["surl"])) {
        die("Invalid success url");
    }

    if(!isset($_GET["furl"]) || empty($_GET["furl"])) {
        die("Invalid failure url");
    }

    if(!isset($_GET["amount"]) || empty($_GET["amount"])) {
        die("Invalid amount");
    }

    if(!isset($_GET["email"]) || empty($_GET["email"])) {
        die("Invalid email address");
    }

    if(!isset($_GET["product_info"]) || empty($_GET["product_info"])) {
        die("Invalid product_info");
    }

    $surl = $_GET["surl"];
    $furl = $_GET["furl"];
    $product_info = $_GET['product_info'];
    $amount = $_GET['amount'];
    $email = $_GET['email'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $phone = $_GET['phone'];
    $country = $_GET['country'];
    $panNumber = $_GET['udf1'];
    $address = $_GET['address'];
    $udf1 = $panNumber;
    $udf2 = $panNumber;
    $udf3 = '';
    $udf4 = $address;
    $udf5 = '';
    $product_info = $product_info . ". PanNumber - " . $panNumber;
    
    $sha_key = "$merchant_key|$txnid|$amount|$product_info|$firstname|$email||$udf2||$udf4|||||||$salt";

    $hash = hash('sha512', $sha_key);
    $service_provider = "payu_paisa";
?>

<style>
form {
	visibility: hidden;
    display: none;
}
</style>
<body>
    <form id="payment-form" action='<?php echo $url; ?>' method='post'>
        <input type="hidden" name="key" value="<?php echo $merchant_key; ?>" />
        <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
        <input type="hidden" name="productinfo" value="<?php echo $product_info; ?>" />
        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
        <input type="hidden" name="email" value="<?php echo $email; ?>" />
        <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
        <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
        <input type="hidden" name="surl" value="<?php echo $surl; ?>" />
        <input type="hidden" name="furl" value="<?php echo $furl; ?>" />
        <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
        <input type="hidden" name="country" value="<?php echo $country; ?>" />
        <input type="hidden" name="udf2" value="<?php echo $udf2; ?>"/>
        <input type="hidden" name="udf4" value="<?php echo $udf4; ?>"/>
        <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
        <input type="hidden" name="service_provider" value="<?php echo $service_provider; ?>" />
        <input type="submit" value="submit"> 
    </form>

    <script>
        document.getElementById("payment-form").submit();
    </script>
    </body>
</html>

<!-- Sample url: {website-scheme}://{website-host}/payu-gateway/?merchant={merchant-key}&amount={amount}&firstname={first-name}&lastname={last-name}&email={email}&phone={phone}&country={country}&address={address}&product_info={product-info}&udf1={udf1}&surl={success-url}&furl={failure-url} -->
<!-- Sample url: https://mohanji.org/payu-gateway/?merchant=mf&amount=100&firstname=Dejan&lastname=Bogatinovski&email=bogatinovski.dejan@gmail.com&phone=+38972232802&country=India&address=Kochi&product_info=WebsiteDonation&udf1=PanNumber&surl=https://mohanji.org/donation-successful&furl=https://mohanji.org/donation-failed/ -->