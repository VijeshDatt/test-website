<?php
/*
* Contact Form Class
*/


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$admin_email = '#'; // Your Email
$message_min_length = 5; // Min Message Length


class Contact_Form{
  function __construct($details, $email_admin, $message_min_length){
    
    $this->name = stripslashes($details['name']);
    $this->email = trim($details['email']);
    $this->Subject = 'Contact from the GEM Office Products Webpage'; // Subject 
    $this->subject = stripslashes($details['subject']);
    $this->phone = stripslashes($details['phone']);
    $this->message = stripslashes($details['message']);

    $this->body .= "Name: ";
      $this->body .= $this->name;

    $this->body .= "\n";

    $this->body .= "Subject: ";
      $this->body .= $this->subject;

    $this->body .= "\n";

    $this->body .= "Email: ";
      $this->body .= $this->email;

    $this->body .= "\n";

    $this->body .= "Phone: ";
      $this->body .= $this->phone;

    $this->body .= "\n";

    $this->body .= "Message: ";
      $this->body .= $this->message;

    $this->body .= "\n";

  
    $this->email_admin = $email_admin;
    $this->message_min_length = $message_min_length;
    
    $this->response_status = 1;
    $this->response_html = '';
    $this->response_invname = 0;
    $this->response_invphone = 0;
    $this->response_blankemail = 0;
    $this->response_invemail = 0;
    $this->response_invsubject = 0;
    $this->response_invmessage = 0;
  }


  private function validateEmail(){
    $regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
  
    if($this->email == '') { 
      return false;
    } else {
      $string = preg_replace($regex, '', $this->email);
    }
  
    return empty($string) ? true : false;
  }


  private function validateFields(){
    // Check name
    if(!$this->name)
    {
      $this->response_invname = 1;
      $this->response_status = 0;
    }

    // Check subject
    if(!$this->subject)
    {
      $this->response_invsubject = 1;
      $this->response_status = 0;
    }

    // Check phone
    if(!$this->phone || strlen($this->phone) > 7)
    {
      $this->response_invphone = 1;
      $this->response_status = 0;
    }

    // Check email
    if(!$this->email)
    {
      $this->response_blankemail = 1;
      $this->response_status = 0;
    }
    
    // Check valid email
    if($this->email && !$this->validateEmail())
    {
      $this->response_invemail = 1;
      $this->response_status = 0;
    }
    
    // Check message length
    if(!$this->message || strlen($this->message) < $this->message_min_length)
    {
      $this->response_invmessage = 1;
      $this->response_status = 0;
    }
  }


  private function sendEmail(){
    $mail = mail($this->email_admin, $this->Subject, $this->body,
       "From: ".$this->name." <".$this->email.">\r\n"
      ."Reply-To: ".$this->email."\r\n"
    ."X-Mailer: PHP/" . phpversion());
  
    if($mail)
    {
      $this->response_status = 1;
    }
  }


  function sendRequest(){
    $this->validateFields();
    if($this->response_status)
    {
      $this->sendEmail();
    }

    $response = array();
    $response['status'] = $this->response_status; 
    $response['invname'] = $this->response_invname;
    $response['invsubject'] = $this->response_invsubject;
    $response['invphone'] = $this->response_invphone;
    $response['blankemail'] = $this->response_blankemail;
    $response['invemail'] = $this->response_invemail;
    $response['invmessage'] = $this->response_invmessage;
    
    echo json_encode($response);
  }
}


$contact_form = new Contact_Form($_POST, $admin_email, $message_min_length);
$contact_form->sendRequest();

?>