<?php // @todo: needs hard refactoring! ?>
<?php // @todo: what if no Brand is active? ?>

<h2>Subscription plan for '<?php print $brand_name; ?>'</h2>

<p>We currently offer a single, simple subscription plan: get access to all features offered by
  Pandion Packager for only 95$ a month. No strings attached.</p>

<span class="subscription-button"><?php print $paypal->button('Subscribe', $button); ?></span>

<p>How does it work?</p>
<p>Click the big Subscribe button above. You'll need a PayPal account. After you've
  registered your payment plan. Monthly recurrent withdrawals will be made automatically. You'll get a warning a few days in advance
  to remind you of a pending withdrawal. If you want to cancel your subscription, click the unsubscribe button below.</p>