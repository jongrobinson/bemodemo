<?php


  session_start();
//session_destroy();
  date_default_timezone_set('America/Los_Angeles');

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



  // Is this the first pass?
  $first_pass=0;
  if(empty($_POST)){
    $_SESSION["logged_in"] = 0;
    $first_pass=1;
  }

  // Has a login attempt has been made?
  $login_attempt_made = 0;
  if($_POST["admin_login_button"]==="Login!"){
    $login_attempt_made = 1;
  }

  // Has a page selection been made form the select dropdown?
  $page_selection_made = 0;
  if($_POST["admin_page_id_select"]!=="") {
    $page_selection_made = 1;
  }

  // Has a login attempt has been made?
  $update_attempt_made = 0;
  if($_POST["admin_update_button"]==="Update!"){
    $update_attempt_made = 1;
  }




  // A login attempt has been made
  if($login_attempt_made){

    unset($db_host_site);
    unset($db_name_sit);
    unset($db_username_site);
    unset($db_password_site);
    
    // BEGIN: Authinticate Login Attempt 
    // check for username and password
    if( !empty($_POST['admin_username']) && !empty($_POST['admin_password']) ){
      
      // get username and password  
      $admin_username = trim(strip_tags($_POST['admin_username']));
      $admin_password = trim(strip_tags($_POST['admin_password'])); 
      //$admin_password = md5(trim(strip_tags($_POST['admin_password']))); 

      $login_check = 0;
      try {
        $data = array( ':admin_username'=>$admin_username, ':admin_password'=>$admin_password );
        $sql = "SELECT * FROM admin_users WHERE admin_user_name=:admin_username AND password=:admin_password";
        $sth = $dbh->prepare( $sql );
        $sth->execute( $data );
        $row = $sth->fetch();
        if( $row>0 ){
          $login_check = 1;
          $admin_user_id = $row["admin_user_id"];
          $admin_user_name = stripSlashes($row["admin_user_name"]);
          $active = stripSlashes($row["active"]);
        }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }   
      
      // If there is a match,...
      if($login_check===1){ 
        
        // If the user account is "active" and returns a '1', redirect to "login" the users.       
        if ($active == '1') {
            $action = "show_admin";
            $display_message=""; //nothing to display really, we're off!
            $_SESSION["logged_in"] = 1;
            $_SESSION["selected_admin_page_id"] = 1; // set a landing page
            // note that this is a huge assumption made in the interest of focusing on other things.
            // Assuming an id exisits in a database is NOT production ready.
        }
        // If the user is deactivated, report that to them via message
        // must always be somewhat cryptic unfortunately, lest a hacker gain info
        else {
            $action = "diplay_message";
            $display_message="Access is denied.";
        }
      }
      // If login check failed, report ti the user via message.
      // must always be somewhat cryptic unfortunately, lest a hacker gain info
      else {
            $action = "diplay_message";
            $display_message="Login attempt failed. Please try again.";  

            // a more sufisticated process might continue code here, 
            // checking for repeated login attempsts
            // and deactivate an account if it's getting bombed.
      }
    }
    // if the username and password have not been entered
    // then alert the user and reshow the login
    else{
            $action = "diplay_message";
            $display_message="Username and/or password missing.";
    }
    // END: Authinticate Login Attempt 

  }
  // entry
  else if ($first_pass){
            $action = "diplay_message";
            $display_message="Please enter username & password";
  }
  // updating
  else if(!$first_pass){
            $display_message="Please make edits and click Update.";
  }







?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex" />
<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>

  body {
      background: #ccc;
      color: #777;
      font-family: arial, sans-serif;
  }

  nav {
    display:block;
    width:100%; 
  }
  nav div {
    margin:15px;
    text-align: right;
  }

  h2,h3 {
      font-size: 15px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 10px;
  }
  h2 {color:#00ff00;}
  h3 {color:#ccc;}

  a {
      color: #FF6600;
      text-decoration: none;
  }

  main {width:100%; height:100%;}

  .panel {
      position: absolute;
      margin: auto;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: rgba(0,0,102,0.8);
      padding: 20px 30px;
      border-radius: 5px;
      box-shadow: 0px 1px 0px rgba(0,0,0,0.3),inset 0px 1px 0px rgba(255,255,255,0.07);
  }

  #login {
      width: 250px;
      height: 250px;
  }

  #main {
      width: 350px;
      height: 650px;
  }

  form span {
    color:#fff;
    font-size: 12px;
  }

  label { 
    color:#00ff00;
    display:block;
    margin-top:35px; 
  }

  input[type="file"] {
    color:#fff;
    margin-top:10px;
  }

  input[type="text"], 
  input[type="password"] {
      display:block;
      width: 250px;
      padding: 10px 0px;
      margin-top:10px;
      background: transparent;
      border: 0;
/*      border-bottom: 1px solid rgba(255,255,255,0.9);*/
      border: 1px solid rgba(255,255,255,0.3);
      outline: none;
      color: #fff;
  }

  textarea {
      display:block;
      padding: 2px;
      margin-top:10px;
      background: transparent;
      border: 0;
      border: 1px solid rgba(255,255,255,0.3);
      outline: none;
      color: #fff;
  }

  button[type="submit"] {
    background: #FF6600;
    margin-top:35px;
    border: 0;
    width: 250px;
    height: 40px;
    border-radius: 3px;
    color: #fcfcfc;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
  }
  button[type="submit"]:hover {
    background: #ff3300;
  }


  ::-webkit-input-placeholder {
    color: #fff;
    padding-left:5px;
  }

  [placeholder]:focus::-webkit-input-placeholder {
    transition: all 0.2s linear;
    transform: translate(10px, 0);
    opacity: 0;
  }

</style>
</head>
<body>
<?php if( $_SESSION["logged_in"]!==1 ){ // SHOW login screen ?>
    <main>
        <div id='login' class="panel">
          <h2>BeMo AdminLogin</h2>
          <?php
            if( !empty($display_message) ){
              echo "          <h3>".$display_message."</h3>";
            }
          ?>
          <form id="admin_login_form" name="admin_login_form" action="http://chakra5.com/projects/bma/initial_functional_test/admin.php" method="post">
            <input id='admin_username' name='admin_username' placeholder='Username' type='text'/>
            <input id='admin_password' name='admin_password' placeholder='Password' type='password' class="password" />
            <button id="admin_login_button" name="admin_login_button" type="submit" form="admin_login_form" value="Login!">Login!</button>
          </form>
        </div>
    </main>
    <script  src="http://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="  crossorigin="anonymous"></script>
    <script>
        //show password while typing
        $(document).ready(function(){
            $("#password").focus(function(){
                this.type = "text";
            }).blur(function(){
                this.type = "password";
            })   
        });
        //Placeholder fixed for Internet Explorer
        $(function() {
            var input = document.createElement("input");
            if(('placeholder' in input)==false) { 
                $('[placeholder]').focus(function() {
                    var i = $(this);
                    if(i.val() == i.attr('placeholder')) {
                        i.val('').removeClass('placeholder');
                        if(i.hasClass('password')) {
                            i.removeClass('password');
                            this.type='password';
                        }           
                    }
                }).blur(function() {
                    var i = $(this);    
                    if(i.val() == '' || i.val() == i.attr('placeholder')) {
                        if(this.type=='password') {
                            i.addClass('password');
                            this.type='text';
                        }
                        i.addClass('placeholder').val(i.attr('placeholder'));
                    }
                }).blur().parents('form').submit(function() {
                    $(this).find('[placeholder]').each(function() {
                        var i = $(this);
                        if(i.val() == i.attr('placeholder'))
                            i.val('');
                    })
                });
            }
        });
    </script>
<?php } ?>
<?php if( $_SESSION["logged_in"]===1 ){ // SHOW edit screen(s)


  // Make updates
  if($update_attempt_made){

//echo "<pre>_FILES:";print_r( $_FILES );echo "</pre>";

    if($_FILES['admin_main_image']['name']!=""){
      echo "<br>HERE";
      // Set all the image naming and pathing based on the users input.
      $image_dir = '/home/chakra52/public_html/projects/bma/initial_functional_test/images/';
      $imagename = $_FILES['admin_main_image']['name'];
      $temp_name = $_FILES['admin_main_image']['tmp_name'];
      $imagetype = $_FILES['admin_main_image']['type'];
      $imagesize = $_FILES['admin_main_image']['size'];

      //store image path for access
      $imagepath = $image_dir . $imagename; 
      //combine also for access
      //echo "<br>imageresults:".$imageresult = move_uploaded_file($temp_name, $imagepath);  
    }
    else {
      //echo "<br>THERE";
      $imagename = trim($_POST["admin_main_image_cur"]);
      //echo "<br>imagename:".$imagename;
    }


    $admin_page_noindex = 0;
    if(isset($_POST['admin_page_noindex']) && $_POST['admin_page_noindex'] == '1'){
        $admin_page_noindex = 1;
    }

    

    //echo "<br>update_attempt_made";
  
      // Build a query string to update admin_users table     
      try {
      
        $data = array(
            'admin_page_noindex' => $admin_page_noindex,
            'admin_page_main_img' => $imagename,
            'admin_page_meta_title' => trim($_POST["admin_meta_title"]),
            'admin_page_meta_description' => trim($_POST["admin_meta_description"]),
            'admin_page_id' => trim($_POST["admin_page_id"])
            // 'display_contact_email' => trim($_POST["display_contact_email"])==='on'? 1: 0;
        );
//echo "<pre>data:";print_r( $data );echo "</pre>";
        $sql = "
            UPDATE 
                admin_pages 
            SET     
                 admin_page_noindex=:admin_page_noindex,
                 admin_page_main_img=:admin_page_main_img,
                 admin_page_meta_title=:admin_page_meta_title,
                 admin_page_meta_description=:admin_page_meta_description
            WHERE
                admin_page_id=:admin_page_id";
        $sth = $dbh->prepare( $sql );
        $sth->execute( $data );


        $display_message="Inofrmation Updated.";

              
      }
      catch(PDOException $e){
          echo $e->getMessage();
      }
  }



    // Get pages for the select dropdown
    try {
      $sql = "SELECT * FROM admin_pages ORDER BY admin_page_id ASC"; // WHERE active=1
      $sth = $dbh->prepare( $sql );
      $sth->execute();
      $page_rows = $sth->fetchAll();
  //echo "<pre>page_rows:"; print_r($page_rows); echo "</pre>";
      $cur_page_details_arr_set=0;
      foreach($page_rows as $index=>$page_row){
        if(!empty($_POST["admin_page_id_select"])){
          if($page_row["admin_page_id"]==$_POST["admin_page_id_select"]){
              $cur_page_details_arr["sel_admin_page_id"]                = stripSlashes($page_row["admin_page_id"]);
              $cur_page_details_arr["sel_admin_page_noindex"]           = stripSlashes($page_row["admin_page_noindex"]);
              $cur_page_details_arr["sel_admin_page_main_img"]          = stripSlashes($page_row["admin_page_main_img"]);
              $cur_page_details_arr["sel_admin_page_title"]             = stripSlashes($page_row["admin_page_title"]);
              $cur_page_details_arr["sel_page_name"]                    = stripSlashes($page_row["page_name"]);
              $cur_page_details_arr["sel_admin_page_meta_title"]        = stripSlashes($page_row["admin_page_meta_title"]);
              $cur_page_details_arr["sel_admin_page_meta_description"]  = stripSlashes($page_row["admin_page_meta_description"]);
              $cur_page_details_arr_set=1;
              $selected_str=' selected';
          }
          else{
              $selected_str="";
          }
        }
        $admin_page_options .= '<option value="'.$page_row["admin_page_id"].'"'.$selected_str.'>'.$page_row["admin_page_title"].'</option>';
      }
      // set a default if nothing is selected.
      if(!$cur_page_details_arr_set){
              $page_row = $page_rows[0]; // get the first item as a default
              $cur_page_details_arr["sel_admin_page_id"]                = stripSlashes($page_row["admin_page_id"]);
              $cur_page_details_arr["sel_admin_page_noindex"]           = stripSlashes($page_row["admin_page_noindex"]);
              $cur_page_details_arr["sel_admin_page_main_img"]          = stripSlashes($page_row["admin_page_main_img"]);
              $cur_page_details_arr["sel_admin_page_title"]             = stripSlashes($page_row["admin_page_title"]);
              $cur_page_details_arr["sel_page_name"]                    = stripSlashes($page_row["page_name"]);
              $cur_page_details_arr["sel_admin_page_meta_title"]        = stripSlashes($page_row["admin_page_meta_title"]);
              $cur_page_details_arr["sel_admin_page_meta_description"]  = stripSlashes($page_row["admin_page_meta_description"]);
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }

  //echo "<br>cur_page_details_arr_set: ".$cur_page_details_arr_set;
  //echo "<pre>cur_page_details_arr:"; print_r($cur_page_details_arr); echo "</pre>";

  //echo "<pre>_SESSION:"; print_r($_SESSION); echo "</pre>";

?>
    <main>
        <div id='main' class="panel">
        <nav><div><a href="./admin.php?logout=1">logout</a></div></nav>
          <form id="admin_pick_page_form" name="admin_update_form" action="http://chakra5.com/projects/bma/initial_functional_test/admin.php?<?php echo htmlspecialchars(SID); ?>" method="post">
            <span>Pick a Page:</span> <select name="admin_page_id_select" onchange="this.form.submit()"><?php echo $admin_page_options; ?></select>
          </form>
          <h2>Page: <?php echo ucfirst($cur_page_details_arr["sel_admin_page_title"])." (".$cur_page_details_arr["sel_page_name"].")"; ?></h2>
          <?php
            if( !empty($display_message) ){
              echo "          <h3>".$display_message."</h3>";
            }
          ?>
          <form id="admin_update_form" name="admin_update_form" action="http://chakra5.com/projects/bma/initial_functional_test/admin.php?<?php echo htmlspecialchars(SID); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="admin_page_id" name="admin_page_id" value="<?php echo $cur_page_details_arr["sel_admin_page_id"] ; ?>" />
            <label for="admin_main_image">main image : <?php echo$cur_page_details_arr["sel_admin_page_main_img"]; ?></label>
            <input id="admin_main_image" name="admin_main_image" type="file" accept=".jpg, .jpeg, .png, .gif">
            <input type="hidden" id="admin_main_image_cur" name="admin_main_image_cur" value="<?php echo $cur_page_details_arr["sel_admin_page_main_img"] ; ?>" />

            <label for="admin_page_noindex">no-index</label>
            <input id="admin_page_noindex" name="admin_page_noindex" type="checkbox" <?php if($cur_page_details_arr["sel_admin_page_noindex"]){echo "checked";} ?> value='1'> <span>block search indexing</span>
            <label for="admin_meta_title">meta title</label>
            <input id='admin_meta_title' name='admin_meta_title' type='text' value="<?php echo $cur_page_details_arr["sel_admin_page_meta_title"]; ?>" />
            <label for="admin_meta_description">meta description</label>
            <textarea id='admin_meta_description' name='admin_meta_description' rows="3" cols="50"><?php echo $cur_page_details_arr["sel_admin_page_meta_description"]; ?></textarea>
            <button id="admin_update_button" name="admin_update_button" type="submit" form="admin_update_form" value="Update!">Update!</button>
          </form>
        </div>
    </main>
<?php } ?>
</body>
</html>