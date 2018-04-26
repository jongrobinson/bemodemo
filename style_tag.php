    <style>

/* BEGIN: Universal contexts */
        * {
            border: 0;
            margin: 0;
            padding: 0;
            outline: 0;
            font-size: 100%;
            background: transparent;
        }
        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
            display: block;
        }

        body {
            font: normal 14px/22px Arial, Helvetica, Geneva, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
/* END: Universal contexts */


/* BEGIN: Header */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 3000;
            height:106px;
            background-color:rgba(255, 255, 255, .9);
        }

    /* BEGIN: Title */
        #titlelogo {
            display: inline-block;
            float: left;
            width: 25%;
            padding-left: 3%;
        }
    /* END: Title */

    /* BEGIN: Nav */
        nav {
            z-index: 10000;
            text-align: right;
            letter-spacing: 1px;
            padding-right: 3%;
            position: relative;
        }

        nav > ul {
            position: relative;
        }
        nav ul li {
            display: inline-block;
            position: relative;
            padding: 0 3%;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        nav ul li a { 
            font-size:17px; 
            font-weight:bold; 
            color:#000066; 
            padding:0; 
            padding-bottom: 30px;
            text-decoration: none;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
    /* END: Nav */
/* END: Header */


/* BEGIN: Banner */
/* NOTE: This cost 10POINTS on the PageSpeed Insights test */
        #banner img { 
            width:100%;
            height:auto;
        }
/* BEGIN: Banner */


/* BEGIN: Main */
        main { padding:3.5%; }
        main article  { margin-top:35px; }
        main article h1, 
        main article h2, 
        main article p {  
            -webkit-margin-before: 1em;
            -webkit-margin-after: 1em;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            font:16px Arial, Verdana, Helvetica, sans-serif;      
            display: block;
            white-space: pre-wrap;  
            line-height: 1.3em; 
        }
        main h1 { 
            font-size:17px; 
            font-weight:bold; 
            color:#000066; 
            padding:0 35px; 
        }
        main article h2 { font-weight:bold; }
        /*main article p  {}*/
        main article ul { list-style-type:none; }
        main article ol {list-style-position: inside;}
/* END: Main */


/* BEGIN: Footer */
        footer {
            padding: 2% 5% 2% 5%;
            background-color: #000066;
            font:13px Arial, Verdana, Helvetica, sans-serif; 
        }

    /* BEGIN: footer text */
        #footer {
            display: inline-block;
            font-size: 13px;
            color:#fff;
        }
        #footer a {
            color: #FF6600;
        }
        #footer div a#rw_email_contact, 
        #footer div a#privacy_plan {
            text-decoration:underline; 
        }
        #spam-protection { display: none; }
    /* END: footer text */

    /* BEGIN: Social Media */
        @font-face {
            font-family: 'socialicoregular';
            src: url('./fonts/socialico-webfont.eot');
            src: url('./fonts/socialico-webfont.eot?#iefix') format('embedded-opentype'),
                 url('./fonts/socialico-webfont.woff') format('woff'),
                 url('./fonts/socialico-webfont.ttf') format('truetype'),
                 url('./fonts/socialico-webfont.svg#socialicoregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'socialico_plusregular';
            src: url('./fonts/socialico_plus-webfont.eot');
            src: url('./fonts/socialico_plus-webfont.eot?#iefix') format('embedded-opentype'),
                url('./fonts/socialico_plus-webfont.woff') format('woff'),
                url('./fonts/socialico_plus-webfont.ttf') format('truetype'),
                url('./fonts/socialico_plus-webfont.svg#socialico_plusregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        #socialicons {
            text-align: center;
            float: right;
            display: inline-block;
        }
        #socialicons1 {
            text-align: center;
            float: right;
            display: inline-block;
            padding-bottom: 10px;
        }
        a.social, a.social1 {
            color: #FFFFFF!important;
            text-decoration:none;
        }
        a.social {
            font-family: 'SocialicoRegular';
            font-size: 28px;
            margin: 0 10px 0px 10px;
            position: relative;
            display: inline-block;
            -webkit-transition: all 450ms;
            -moz-transition: all 450ms;
            -ms-transition: all 450ms;
            -o-transition: all 450ms;
            transition: all 450ms;
        }        
        a.social:hover {
            color: #999;
        }
    /* END: Social Media */
/* END: Footer */



/* BEGIN: Contact Form */
    /* BEGIN: Message Text */
        .message-text {
            text-align:left;
            font:13px Arial, Verdana, Helvetica, sans-serif;
            font-size:13px; 
            color: #373737;
            line-height:30px;
        }
        .message-text h2 { font-size:17px; font-weight:bold; }
        .message-text p {  }
        .message-text span { font-weight:bold; display:inline; text-decoration:underline;}
    /* END: Message Text */


    /* BEGIN: Form Wrapper & Contexts */
        #form-wrap {
            text-align: center!important;
        }
        form {
            display: block;
            font:13px Arial, Verdana, Helvetica, sans-serif; 
        }
        form div {
            padding-top: 5px;
            padding-bottom: 50px;
        }
        form div label {
            color: #373737;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
        }
    /* END: Form Wrapper & Contexts */

    /* BEGIN: Form Fields */
        .form-input-field {
            color: #333333;
        }
        .form-input-field {
            background: #CCCCCC;
        }
        .form-input-field {
            width: 70%;
            width: 85%;
            margin-top: 7px;
            padding: 9px;
            outline: none;
            border: none;
        }
    /* END: Form Fields */

    /* BEGIN: Form Buttons */
        .form-input-button {
            background: #999999;
        }
        .form-input-button {
            padding: 7px 28px 7px 28px;
            margin: 10px 10px 0 0;
            text-transform: uppercase;
            font-size: 0.75em;
            border: none;
            cursor: pointer;
            -webkit-appearance: none;
            -webkit-transition: all 450ms;
            -moz-transition: all 450ms;
            -ms-transition: all 450ms;
            -o-transition: all 450ms;
            transition: all 450ms;
        }
    /* END: Form Buttons */
/* END: Contact Form */

    </style>