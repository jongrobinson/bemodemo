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
    $data = array( ':page_name'=>'index.php' );
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
        <h1>Ultimate Guide to CDA Structured Interview: Tips &amp; Proven Strategies to Help You Prepare &amp; Ace Your CDA Interview</h1>
        <article>
            <h2>Overview:</h2>
            <ul>
                <li>The purpose of the dental school interview</li>
                <li>History and rationale of the CDA interview</li>
                <li>Types of Questions </li>
                <li>The Seven Competencies</li>
                <li>Structure of the CDA interview</li>
                <li>How to prepare for your CDA Interview</li>
                <li>Sample CDA interview questions</li>
                <li>BeMo CDA-structured interview prep program</li>
                <li><a href="#">Contact us</a></li>
            </ul>
        </article>
        <article>
            <h2>What is the purpose of the dental school interview? </h2>
            <p>Regardless of the format of dental school interview (e.g. CDA structured interview, MMI, or Panel interview), the purpose of the interview is rather straightforward and remains constant across the board: to assess the personality and Non-Cognitive Skills (NCSs) of the candidate.</p>
            <p>What are NCSs? By these we mean the following: Communication skills, interpersonal skills, ethical and moral decision making capacity, maturity, professionalism, sense of social responsibility, service to community, leadership, initiative, scholarship, ability to collaborate with others, conflict resolution skills, etc.</p>
            <p>Research has shown that, although academic performance (i.e. GPA and DAT scores) is a great indicator of didactic abilities in the first and second years of dental school, it provides, however, a very poor predictive value when it comes to future clinical performance. In fact, research shows that, an effective interview process is the best indicator of future clinical performance in the upper years, as it gives insight into the characteristics of the candidate and whether or not there will be a likelihood of future behavioural problems (an issue that dental schools constantly encounter and struggle to overcome). For example, it has been shown that those candidates who are "conscientious" and "open to new experiences" perform more effectively in the third and fourth years of dental school studies, where the education takes place in a clinical setting for the most part.</p>
            <p>Thus, dental schools, much like other professional schools, have over the past decade spent a lot of resources to devise the most effective interview process that will give them insight into the NCSs of their future candidates. And of course, for Canadian dental schools the answer has been the Canadian Dental Association's structured interview or CDA structured interviews.</p>
        </article>
        <article>
            <h2>History, rationale, and the structure of the CDA interview </h2>
            <p>Recall from our discussion above that we said an effective interview process is the most reliable way to select candidates who perform well clinically. Well in an attempt to test this theory, in 2004, Smithers et al. conducted a study, which produced results that were so shocking, that it unequivocally reinforced the Canadian Dental Association's earlier decision to commission a "new structured interview based on state-of-the-art contemporary interview techniques" (i.e. CDA structured interview) </p>
            <p>What were these shocking results you may ask? The evidence gathered by Smithers et al. (2004) simply reinforced earlier suspicions about the ineffectiveness of traditional interview processes. They showed that, "a typical [traditional] admissions interview was in fact worse than neutral in that it was negatively associated with students' performance in the first year of dental training, did not predict academic performance, and may have led to poor selection decisions." Thus, it should come as no surprise that the traditional panel interview has been replaced by most dental school with the CDA structured interview, which is a more reliable and valid future predictor of clinical performance.</p>
            <p>The CDA interview was not only re-structured in its format of delivery, but it was also restructured in terms of the type of questions that would be ask, and how they would be rated or scored by the interviewers. Let us first talk about the type of questions that you may encounter on your CDA structured interview. </p>
        </article>
        <article>
            <h2>Types of Questions </h2>
            <p>The types of questions that you may be asked during your dental school interview can be divided into two categories: (1) Situational Interview (SI) questions and (2) Patterned Behaviour Descriptive Interview (PBDI) questions. SI questions are those in which the candidates is placed in a hypothetical situations (i.e. vignette) and is asked what they would react in that given situation. For example,</p>
            <p>"You are babysitting your sister’s young child, who is nervous and upset about his mother being away. You are trying to calm him down and offer him some ice cream. As you are dishing out the ice cream, the child bites down hard on your hand. How would you react?" </p>
            <p>Conversely, PBDI type questions, ask the candidates "about past behaviour with the assumption that past behaviour is the best predictor of future behaviour." An example of a PBDI type questions is:</p>
            <p>Many of us have had to deal with juggling busy schedules. Think of a time in the past when an important but unscheduled situation arose that required your attention, but you had a number of prior commitments on your agenda. What did you do? What was the outcome? </p>
            <p>Notice how SI questions are typically future-oriented, as opposed to PBDI questions, which are past-oriented. The specific and actual SI and PBDI questions are devised according to seven competencies, that the CDA has found to be reliable and valid indicators of future performance. In other words, every question that is asked during a dental school interview, regardless of being a SI or PBDI question, will address one or more than one of the seven competencies.</p>
        </article>
        <article>
            <h2>The Seven Competencies</h2>
            <ol>
                <li>Communication: does the applicant have excellent communication skills?</li>
                <li>Conscientiousness: is the applicant thorough, careful to do tasks well?</li>
                <li>Integrity : is the applicant honest with themselves and others?</li>
                <li>Judgment and analysis: does the applicant have the capability to make sound judgments? Do they gather all the facts before making a decision?</li>
                <li>Self-control : Does the applicant remain calm and in control in difficult situations?</li>
                <li>Sensitivity to others : Does the applicant show empathy towards others? Do they take the feelings of others into consideration?</li>
                <li>Tact and diplomacy : Does the applicant show sensitivity in dealing with difficult issues? Does the applicant possess the necessary skills to deal with others without causing negative feelings?</li>
            </ol>
            <p>Notice in the above examples that the SI sample question is addressing the competencies of self-control, sensitivity to others, communication, while the PBDI question addresses the competencies of conscientiousness, Integrity, and judgement and analysis. In all of the questions that will be asked of you during your interview, the competency of communication is a constant that is continuously tested and retested. In order to be successful, however, you will have to be able to know which other competencies also apply to the question so that you can formulate an appropriate response, which touches on the key factors essential for the interviewers. </p>
        </article>
        <article>
            <h2>Structure of the CDA interview </h2>
            <p>The CDA structured interview is comprised of seven questions, one for each of the seven competencies described above. Each question, which can either be a SI or a PBDI type, is scored on a 5-point scale for a total and a maximum of 35 points by two interviewers who are either a pair of dentists, or senior dental students. The interview usually takes about 20-30 minutes to be completed. </p>
            <p>Click here to learn how to prepare for your CDA interview</p>
            <p>Click here to practice with our sample CDA interview questions</p>
            <p>Click here to learn more about our money-back guarantee CDA interview preparation programs. </p>
        </article>
        <article>
            <h2>Reference:</h2>
            <p>Poole A., Catano, VM., and Cunningham, DP. Predicting performance in Canadian dental schools: the new CDA structured interview, a new personality assessment, and the DAT. Journal of Dental Education. 2007; 71: 664 - 676.</p>
        </article>
    </main>
<?php require 'footer.php';?>
</body>
</html>