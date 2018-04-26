<?php

require '../../../../connection/bemo_connection.php';

  Class SafePDO extends PDO {
    public static function exception_handler($exception) {
      // Output the exception details
      die('Uncaught exception: '. $exception->getMessage());
    }
    public function __construct($dsn, $username='', $password='', $driver_options=array()) {
      // Temporarily change the PHP exception handler while we . . .
      set_exception_handler(array(__CLASS__, 'exception_handler'));
      // . . . create a PDO object
      parent::__construct($dsn, $username, $password, $driver_options);
      // Change the exception handler back to whatever it was before
      restore_exception_handler();
    }
  }

  // Connect to the database with defined constants
  $dbh = new SafePDO( "mysql:host=$db_host_site;dbname=$db_name_site", $db_username_site, $db_password_site );

  try {
    $data = array( ':page_name'=>'contact-us.php' );
    $sql = "SELECT * FROM admin_pages WHERE page_name=:page_name ";
    $sth = $dbh->prepare( $sql );
    $sth->execute( $data );
    $row = $sth->fetch();
    if( $row>0 ){
      //$page_id = $row["admin_page_id"];
      //$page_title = stripSlashes($row["admin_page_title"]);
      //$page_name = stripSlashes($row["page_name"]);
      $admin_page_main_img = stripSlashes($row["admin_page_main_img"]);
      $admin_page_noindex = stripSlashes($row["admin_page_noindex"]);
      $page_meta_title = stripSlashes($row["admin_page_meta_title"]);
      $page_meta_description = stripSlashes($row["admin_page_meta_description"]);
      //$active = stripSlashes($row["active"]);
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }




// Catch and send contact email
if($_POST["submitButton"]==="Submit"){

$to = "info@bemoacademicconsulting.com";
$subject = "BeMo Academic Consulting Inc. 'Contact Us' form";

// Build the message
$msg1 = "From Submission from BeMo Academic Consulting Inc. 'Contact Us' form\r\r\n\n";
$msg2 = "Name:".$_POST["form"]["from_name"]."\r\n";
$msg3 = "Message:".$_POST["form"]["message"]."\r\n";
// wrap longer messages
$message = wordwrap($msg1.$msg2.$msg3,70);

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From:".$_POST["form"]["from_name"]." <".$_POST["form"]["from_email"].">" . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

}



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $page_meta_description; ?>">
    <meta name="keywords" content="">
<?php if ($admin_page_noindex){ ?>
    <meta name="robots" content="noindex" />
<?php } ?>
<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php require 'style_tag.php';?>
</head>
<body>
<?php require 'header.php';?>
    <div id="banner"><img id="featureImg" src="./images/<?php echo $admin_page_main_img; ?>" alt="CDA Interview Guide"></div>
    <main>
<?php /*
echo "<pre>";
print_r($_POST["form"]);
echo "</pre>"; */
?>
        <div class="message-text">
            <h2>BeMo Academic Consulting Inc.</h2>
            <p><span>Toll Free</span>: 1-855-900-BeMo (2366)</p>
            <p><span>Email</span>: info@bemoacademicconsulting.com</p>
        </div>
        <div id="form-wrap">
            <form action="./contact-us.php" method="post" enctype="multipart/form-data">
                 <div>
                    <label for="form[from_name]">Name:</label> *<br />
                    <input class="form-input-field" type="text" value="" name="form[from_name]" size="40"/><br /><br />
                    <label for="form[from_email]">Email Address:</label> *<br />
                    <input class="form-input-field" type="email" value="" name="form[from_email]" size="40"/><br /><br />
                    <label for="form[message]">How can we help you?</label> *<br />
                    <textarea class="form-input-field" name="form[message]" rows="8" cols="38"></textarea><br /><br />
                    <div id="spam-protection">
                        <label>Spam Protection: Please don't fill this in:</label>
                        <textarea name="comment" rows="1" cols="1"></textarea>
                    </div>
                    <input type="hidden" name="form_token" value="16412077755ade898a49fc0" />
                    <input class="form-input-button" type="reset" name="resetButton" value="Reset" />
                    <input class="form-input-button" type="submit" name="submitButton" value="Submit" />
                </div>
            </form>
        </div>
    </main>
<?php require 'footer.php';?>
</body>
</html>