<?php 

// EDIT THE FOLLOWING LINE BELOW AS REQUIRED

$send_email_to = "admin@egrappler.com";

function send_email($fname,$lname,$email,$email_subject,$email_message)
{
  global $send_email_to;  

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers .= "From: ".$email. "\r\n";
  $message = "<strong>Email = </strong>".$email."<br>";
  $message .= "<strong>First Name = </strong>".$fname."<br>";
  $message .= "<strong>Last Name = </strong>".$lname."<br>";
  $message .= "<strong>Message = </strong>".$email_message."<br>";
  @mail($send_email_to, $email_subject, $message,$headers);
  return true;
}

function validate($fname,$lname,$email,$message,$subject)
{
  $return_array = array();
  $return_array['success'] = '1';
  $return_array['fname_msg'] = '';
  $return_array['lname_msg'] = '';
  $return_array['email_msg'] = '';
  $return_array['message_msg'] = '';
  $return_array['subject'] = '';

 if($email == '')
  {
    $return_array['success'] = '0';
    $return_array['email_msg'] = 'email is required';
  }
  else
  {
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
      $return_array['success'] = '0';
      $return_array['email_msg'] = 'enter valid email.';  
    }
  }

  if($fname == '')
  {
    $return_array['success'] = '0';
    $return_array['fname_msg'] = 'First Name is required';
  }
  else
  {
     $string_exp = "/^[A-Za-z .'-]+$/";
    if (!preg_match($string_exp, $fname)) {
      $return_array['success'] = '0';
     $return_array['fname_msg'] = 'enter valid First Name.';
    }
  }
  
  if($lname == '')
  {
    $return_array['success'] = '0';
    $return_array['lname_msg'] = 'Last Name is required';
  }
  else
  {
    $string_exp = "/^[A-Za-z .'-]+$/";
     if (!preg_match($string_exp, $fname)) {
       $return_array['success'] = '0';
     $return_array['lname_msg'] = 'enter valid Last Name.';
    }
  }

  if($subject == '')
  {
    $return_array['success'] = '0';
    $return_array['subject_msg'] = 'Subject is required';
  }
  
  if($message == '')
  {
    $return_array['success'] = '0';
    $return_array['message_msg'] = 'Message is required';
  }
  else
  {
    if (strlen($message) < 2) {
      $return_array['success'] = '0';
      $return_array['message_msg'] = 'Enter valid Message.';
    }
  }
  return $return_array;
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];

$return_array = validate($fname,$lname,$email,$message,$subject);
if($return_array['success'] == '1')
{
  send_email($fname,$lname,$email,$subject,$message);
}

header('Content-type: text/json');
echo json_encode($return_array);
die();

?>
