<?php

// Put contacting email here
$php_main_email = "contact@hichamblilid.de";

// Fetching Values from AJAX request
$php_name = $_POST['ajax_name'];
$php_email = $_POST['ajax_email'];
$php_message = $_POST['ajax_message'];
$php_subject = $_POST['ajax_subject'];

// Sanitizing email
$php_email = filter_var($php_email, FILTER_SANITIZE_EMAIL);

// After sanitization, validation is performed
if (filter_var($php_email, FILTER_VALIDATE_EMAIL)) {
    $subject = "Message from contact form";

    // Set the headers for the email
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:' . $php_email . "\r\n"; // Sender's Email
    $headers .= 'Cc:' . $php_email . "\r\n"; // Carbon copy to Sender

    // Template for email
    $email_template = '<div style="padding:50px;">Hello ' . $php_name . ',<br/>' 
        . 'Thank you for contacting us.<br/><br/>'
        . '<strong style="color:#f00a77;">Name:</strong> ' . $php_name . '<br/>'
        . '<strong style="color:#f00a77;">Email:</strong> ' . $php_email . '<br/>'
        . '<strong style="color:#f00a77;">Subject:</strong> ' . $php_subject . '<br/>'
        . '<strong style="color:#f00a77;">Message:</strong> ' . $php_message . '<br/><br/>'
        . 'This is a Contact Confirmation mail.<br/>'
        . 'We will contact you as soon as possible.</div>';

    // Send the email using PHP's mail function
    $send_message = wordwrap($email_template, 70);
    mail($php_main_email, $subject, $send_message, $headers);

    // Return success message
    echo "";
} else {
    echo "<span class='contact_error'>* Invalid email *</span>";
}
?>
