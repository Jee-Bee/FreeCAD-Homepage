<script>
    function process (select) {
        form = select.parentElement.parentElement;
        method = select.value;
        if (method == "sepa") {
            form.querySelector(".sepainfo").classList.remove("hidden");
            form.querySelector(".submit").classList.add("hidden");
        } else {
            form.querySelector(".sepainfo").classList.add("hidden");
            form.querySelector(".submit").classList.remove("hidden");
        }
    }

    function send (button) {
        form = button.parentElement.parentElement;
        method = form.method.value;
        amount = form.amount.value;
        if (amount == "") {
            amount = "5";
        }
        type = form.getAttribute('id');
        if (method == "github") {
            if (type == "sponsor") {
                window.location = "https://github.com/sponsors/FreeCAD?frequency=recurring&amount="+amount;
            } else {
                window.location = "https://github.com/sponsors/FreeCAD?frequency=one-time&amount="+amount;
            }
        } else if (method == "opencollective") {
            if (type == "sponsor") {
                if (Number(amount) > 99) {
                    window.location = "https://opencollective.com/freecad/contribute/sponsor-38077/checkout?amount="+amount;
                } else {
                    window.location = "https://opencollective.com/freecad/contribute/backer-38077/checkout?amount="+amount;
                }
            } else {
                window.location = "https://opencollective.com/freecad/donate?amount="+amount;
            }
        } else if (method == "paypal") {
            window.location = "https://www.paypal.com/donate/?hosted_button_id=M3Z8BGW6DB69Q";
        } else if (method == "stripe") {
            window.location = "https://buy.stripe.com/fZe0263vA809dpu5kk";
        }
    }
</script>

<form id="<?php echo $formid; ?>" class="donation">
    <fieldset>
      <label for="amount"><?php echo _('Amount'); ?>:</label>
      <input name="amount" type="text" placeholder="5.00" autofocus />
      <select id="currency" name="currency">
             <option value="usd" selected>USD</option>
             <!--<option value="eur">EUR</option>-->
      </select>
      <br/>
      <label for="method"><?php echo _('Donation method'); ?>:</label>
      <select id="method" name="method" onClick="process(this)">
             <option value="null" selected><?php echo _('Please choose'); ?>...</option>
             <option value="sepa" title="<?php echo _('Direct SEPA bank transfer using your own bank apps'); ?>"><?php echo _('SEPA bank transfer'); ?></option>
             <!-- apparently stripe doens't let you specify a custom amount... -->
             <!-- <option value="stripe" title="<?php echo _('SEPA bank transfer or credit card via Stripe'); ?>"><?php echo _('Stripe transfer'); ?></option> -->
             <option value="paypal" title="<?php echo _('Paypal allows to donate using your Paypal account, or a credit card') ?>"><?php echo _('Paypal'); ?></option>
             <option value="github" title="<?php echo _('Github allows you to sponsor your favorite projects using your github account, and a credit card') ?>"><?php echo _('Github'); ?></option>
             <option value="opencollective" title="<?php echo _('OpenCollective acts as a fiscal host for open-source projects. You can donate with a credit card or bank account') ?>"><?php echo _('OpenCollective'); ?></option>
      </select>
      <br/>
      <div class="sepainfo hidden">
          <b><?php echo _('SEPA Information'); ?></b><br/>
          <?php echo _('Please set up your SEPA bank transfer to'); ?>:<br/>
          The FreeCAD project association<br/>
          IBAN: <b>BE04 0019 2896 4531</b><br/>
          BIC/SWIFT code: GEBABEBBXXX<br/>
          <?php echo _('Bank agency'); ?>: BNP Paribas Fortis<br/>
          <?php echo _('Address'); ?>: Rue de la Station 64, 1360 Perwez, Belgium<br/>
      </div>
      <?php echo _('Please inform your forum name or twitter handle as a note
      in your transfer, or <a href=mailto:fpa@freecad.org>reach to us</a>,
      so we can give you proper credits! More information about the donation
      options on the
      <a href=https://wiki.freecad.org/donate>donations</a> page.'); ?>
      <br/>
      <b>Note</b>: Paypal is currently disabled because the Paypal platform arbitrarily
      suspended our account (30 june 2022). We are working on it as fast as possible. 
      Please choose another payment platform instead for the time being, or come 
      back here in a few days. Thanks!!
      <input type="Button" value="Submit" class="submit" onCLick="send(this)" />
    </fieldset>
</form>
