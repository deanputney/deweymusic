<html>
<head>
</head><script type="text/javascript" src="mootools-1.2.4-core-nc.js"></script>
<script type="text/javascript">
// in mootools, the 'onload' event is called 'domready' and it ensures
// the DOM has completed loading and elements can be modified safely.
window.addEvent("domready", function() {
    // now, add events for the form
    $("myform").addEvents({
        "submit": function(e) {
            // stop the event from propagation...
            e.preventDefault();

            new Request({
                url: this.get("action"),
                data: this,
                onComplete: function() {
                    $("feedback").set("html", this.response.text);
                }
            }).send();
        }
    });
}); // end domready
</script>


   	<script type="text/javascript">

// extend elements to support warnings within values
Element.implement({
    fieldWarning: function(warningText, warningDelay) {
        // very basic - changes the value of the input to warningText
        // restores to "" within warningDelay in ms

        this.set({
            value: warningText,
            styles: {
                backgroundColor: "#fcc"
            },
            events: {
                focus: function() {
                    this.set({
                        value:  "",
                        styles: {
                            backgroundColor: "#fff"
                        }
                    }).removeEvents();
                }
            }
        });

        (function() {
            this.fireEvent("focus").removeEvents();
        }).delay(warningDelay, this);
    }
});

var validEmailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

// define common functions and variables
var isValid = function(email) {
    // boolean function that checks email string against allowed strings in accordance to RFCs
    return email.test(validEmailRegex);
},  // end isValid
cleanData = function(elementsArray) {
    // cleans passed elements with property 'value' from spaces and XSS
    elementsArray.each(function(el) {
        el.set("value", el.get("value").clean().stripScripts());
    }); // end each
} // end cleanData

window.addEvent("domready", function() {
    // now, add events for the form
    $("myform").addEvents({
        "submit": function(e) {
            // stop the event's default action from propagation...
            e.preventDefault(); // can also do new Event(e).stop();

            // clean all form fields from excess spaces and cross side scripting attacks
            cleanData($("myform").getElements("input,textarea"));

            var noErrors = true;

            // first, loop required elements
            $$("input.required,textarea.required").each(function(el) {
                var testedValue = el.get("value");
                if (testedValue.length == 0 || testedValue == "Required field") {
                    noErrors = false;
                    el.fieldWarning("Required field", 2000);
                }
            });

            if (noErrors) { // test email
                var testedEmail = $("customer_email").get("value");
                if (!isValid(testedEmail)) {
                    $("customer_email").fieldWarning("INVALID: " + testedEmail, 2000);
                    noErrors = false;
                }
            }

            // if no errors in the form, compose the XHTTP request manually.
            if (noErrors)
            new Request({
                url: this.get("action"),
                data: this,
                onComplete: function() {
                    $("feedback").set("html", this.response.text);
                    // since the form itself is contained within this layer
                    // it will 'self destroy' with whatever HTML we print
                    // from the PHP/ASP.
                }
            }).send();
        }
    });

});
</script>
</head>


<div id="feedback" style="background: #eee; padding: 2px; border: 1px solid #333; float: left">
    <form action="mooForm.php?a=send" method="POST" id="myform">
    <label for="customer_name">Your name:</label><p>
    <input type="text" class="required bordered" value="" name="customer_name" id="customer_name"/><p>
    <label for="customer_email">Your email:</label><p>
    <input type="text" class="required bordered" value="" name="customer_email" id="customer_email"/><p>
    <label for="customer_comment">Your message:</label><br />
    <textarea class="required" style="width: 360px" name="customer_comment" id="customer_email"/></textarea><br /><br />
    <input type="submit" value="Send data" /></form>
</div>

</html>

