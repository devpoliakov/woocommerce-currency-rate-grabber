<?php

function currency_rate_options_page(){
	?>
<div class="wrap testusBlank-for-orders">
<h1><?php echo __("Grabber configuration") ?></h1>
<?php

$currency_source = json_decode(get_option('wc_exchange_rate'));

echo "<p><strong>your currency</strong>: " . $currency_source->name. " </p>";
echo "<p><strong>your USD/QAR rate</strong>: " . round($currency_source->inverseRate, 2) ."</p>";
echo "<p><strong>your QAR/USD rate</strong>: " . round(1 / $currency_source->inverseRate, 2) ."</p>";
echo "<p><strong>last request</strong>: " . $currency_source->date. " </p>";


?>

</div>
	<?php

}