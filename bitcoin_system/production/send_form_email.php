<?php

include('includes/dbconnect.php');

if (isset($_POST['email'])) {

    function died($error) {
        // your error code can go here
        $response['status'] = 'error';
        $response['message'] = $error;
        echo json_encode($response);
        exit;
    }

    // validation expected data exists
    if (!isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['phone']) ||
            !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }


    $first_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['phone']; // not required
    $comments = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $first_name)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }


    if (strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    if (strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "First Name: " . clean_string($first_name) . "\n";
    $email_message .= "Email: " . clean_string($email_from) . "\n";
    $email_message .= "Telephone: " . clean_string($telephone) . "\n";
    $email_message .= "Comments: " . clean_string($comments) . "\n";

    $to = 'support@bitminepool.com';
    //$to = 'meettomangesh@gmail.com';
    $subject = "Bit Mine Pool Enquiry";
    //$message = $share['Token'];
// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: " . $email_from . " " . "\r\n" .
            "Reply-To: " . $email_from . " " . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

// More headers
    $headers .= 'From: <' . $email_from . '>' . "\r\n";
//$headers .= 'Cc: mail.register@bitminepool.com' . "\r\n";

    $status = mail($to, $subject, $email_message, $headers);
    $response = [];
    if ($status) {
        $response['status'] = 'success';
        $response['message'] = 'Thank you for contacting us. We will be in touch with you very soon.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Sorry we are unable to process your request.Please try again later.';
    }
    echo json_encode($response);
    exit;
    ?>




    <?php

}
?>

