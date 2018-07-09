<?php session_start();
include('includes/constant.php');
?>
 <?php
 function random_code($limit)
{
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
}
 
?>
<?php
include('includes/dbconnect.php');
		$myaccount = $_SESSION['Account'];
		if(isset($_GET['Account'])){
		$_SESSION['Account'] = $_GET['Account'];
		$myaccount = $_SESSION['Account'];
		$getmember = "SELECT Username FROM users WHERE Account = '$myaccount'";
		$querymember = mysqli_query($conn, $getmember);
		if (mysqli_num_rows($querymember) == 1) {
					$currentmember = mysqli_fetch_array($querymember);
					$membernumber = $currentmember['Username'];  		
					} 
			else {
					echo '<script>alert("wrong Link");window.location.assign("'.BASE_URL.'bitcoin_system/production/login");</script>';
				 }
			
		}
		
?>
<?php
if (isset($_POST['submit'])){
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
////////////////////////////////////////////////////Information Sent From Form//////////////////////////////////////////////
 $name = $_POST['name'];
 $Country = $_POST['Country'];
 $email = $_POST['email'];
 $Telephone = $_POST['Telephone'];
 $Gender = $_POST['Gender'];
 $Username = $_POST['Username'];
 $password= $_POST['password'];
 $Sponsor= $_POST['Sponsor'];
 $Token = $_POST['Token'];
 $Account = $_POST['Account'];
 $Status= $_POST['Status'];
 $Activation= $_POST['Activation'];
 ////////////////////////////////////////////////////form validation//////////////////////////////////////////////////////////
  if(empty($name)) {
    echo '<script>alert("Please fill in full name.");</script>';
	}
 elseif(empty($Country)) {
 	 echo '<script>alert("Please fill in Country.");</script>';
 	}
 elseif(empty($email)) {
 	 echo '<script>alert("Please fill in Email.");</script>';
 	}
 elseif(empty($Telephone)) {
 	 echo '<script>alert("Please fill in Telephone.");</script>';
 	}
 elseif(empty($Username)) {
 	 echo '<script>alert("Please fill in Username.");</script>';
 	}
 elseif(empty($password)) {
 	 echo '<script>alert("Please fill in Password.");</script>';
 	}
 elseif(empty($Sponsor)) {
 	 echo '<script>alert("Please confirm your registration link.");window.location.assign("sponsor.php");</script>';
 	}
 else {
 //Remove white spaces
 $name= stripslashes($name);
 $Country= stripslashes($Country);
 $email = stripslashes($email);
 $Telephone = stripslashes($Telephone);
 $Gender = stripslashes($Gender);
 $Username = stripslashes($Username);
 $password = stripslashes($password);
 $Sponsor = stripslashes($Sponsor);
 // To protect MySQL injection (more detail about MySQL injection)
 $name = mysqli_real_escape_string($conn, $_POST['name']);
 $Country = mysqli_real_escape_string($conn, $_POST['Country']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $Telephone = mysqli_real_escape_string($conn, $_POST['Telephone']);
 $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
 $Username = mysqli_real_escape_string($conn, $_POST['Username']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);
 $Sponsor= mysqli_real_escape_string($conn, $_POST['Sponsor']);
 //Check wether the username Telephone Email or Idnumber exists before registering
 $query = "SELECT Username FROM users WHERE Username='$Username'";
 $result = mysqli_query($conn, $query);
 $querya = "SELECT Username FROM users WHERE email='$email'";
 $resulta = mysqli_query($conn, $querya);
 $queryb = "SELECT Username FROM users WHERE Telephone='$Telephone'";
 $resultb = mysqli_query($conn, $queryb);
 $queryd = "SELECT Username FROM users WHERE Username='$Sponsor'";
 $resultd = mysqli_query($conn, $queryd);
 //Check wether Username exists
 		if (mysqli_num_rows($result) > 0) 
			 {
    		 echo '<script>alert("Username already Exists.");</script>';
 			 }
  //Check wether Email exists
		elseif(mysqli_num_rows($resulta) > 0) 
  			{
    		echo '<script>alert("Email already Exists.");</script>';
  			}
 //Check wether Telephone Number exists			
		elseif (mysqli_num_rows($resultb) > 0) 
			{
 			echo '<script>alert("Telephone Number already Exists.");</script>';
 			}
 //Check wether Idnumber exists	
		elseif (mysqli_num_rows($resultd) > 0) 
		{
 // Inserting data into users table in the database
		$sql="INSERT INTO users (Fullname, Country, Email, Telephone, Gender, Username, Password, Sponsor, Token, Account, Status, Activation, treestatus)							  																																																																								        VALUES('$name','$Country','$email','$Telephone','$Gender','$Username','$password','$Sponsor','$Token','$Account','$Status','$Activation','notree');INSERT INTO accountbalance (Balance, Username)
		VALUES('0','$Username');INSERT INTO binaryincome(userid, day_bal, current_bal, total_bal) 
		VALUES('$Username','0','0','0');INSERT INTO hubcoin (Balance, Username)
		VALUES('0','$Username');INSERT INTO team (Balance, Username)
		VALUES('0','$Username');INSERT INTO teamvolume (Balance, Username)
		VALUES('0','$Username');INSERT INTO rank (Rank, Rankid, Username, Sponsor)
		VALUES('Miner','1','$Username','$Sponsor');INSERT INTO mining (Balance, Username)
		VALUES('0','$Username');INSERT INTO commission (Balance, Username)
		VALUES('0','$Username');INSERT INTO starterpack (PurchaseDate, MiningDate, Username, Status, CompletionDate, TotalMinable,Withdrawal, Comment)
		VALUES('0', '0', '$Username', 'Inactive', '0', '547.50', '0', 'Not-Purchased');INSERT INTO minipack (PurchaseDate, MiningDate, Username, Status, CompletionDate, TotalMinable,Withdrawal, Comment)
		VALUES('0', '0', '$Username', 'Inactive', '0', '1095', '0', 'Not-Purchased');INSERT INTO mediumpack (PurchaseDate, MiningDate, Username, Status, CompletionDate, TotalMinable,Withdrawal, Comment)
		VALUES('0', '0', '$Username', 'Inactive', '0', '2190', '0', 'Not-Purchased');INSERT INTO grandpack (PurchaseDate, MiningDate, Username, Status, CompletionDate, TotalMinable,Withdrawal, Comment)
		VALUES('0', '0', '$Username', 'Inactive', '0', '4380', '0', 'Not-Purchased');INSERT INTO ultimatepack (PurchaseDate, MiningDate, Username, Status, CompletionDate, TotalMinable, Withdrawal, Comment)
		VALUES('0', '0', '$Username', 'Inactive', '0', '8760', '0', 'Not-Purchased');INSERT INTO register (EntryDate, Amount, Username)
		VALUES('0', '0', '$Username')";		
 		mysqli_multi_query($conn, $sql);
//Start email Session
	$_SESSION['Username']= $Username;
	$_SESSION['email']= $email;
	unset($_SESSION['Account']);
    header("location:emailverify");
	}
//if Sponsor does not exist
  else 
  	{
 	echo '<script>alert("wrong Link");window.location.assign("'.BASE_URL.'bitcoin_system/production/login");</script>';
	}

}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="build/css/intlTelInput.css">
  	<link rel="stylesheet" href="build/css/demo.css">
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
   
        <!-- top navigation -->
       

              

             

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <img src="images/logo.png" alt="Bitcoin-Mine-Hub" style="width: 95px;">
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
               
                    <form class="form-horizontal form-label-left" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

                      
                     
                      <span class="section">Member Registration: Step 1</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="Fullname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select class="form-control" name="Country">
									<option value="Aland-Islands">Åland Islands</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American-Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua-and-Barbuda">Antigua and Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia, Plurinational State of</option>
									<option value="Bonaire">Bonaire, Sint Eustatius and Saba</option>
									<option value="Bosnia">Bosnia and Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet-Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British-Indian-Ocean-Territory">British Indian Ocean Territory</option>
									<option value="Brunei-Darussalam">Brunei Darussalam</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina-Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape-Verde">Cape Verde</option>
									<option value="Cayman-Islands">Cayman Islands</option>
									<option value="Central-African-Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas-Island">Christmas Island</option>
									<option value="Cocos">Cocos (Keeling) Islands</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="CongoDRC">Congo, the Democratic Republic of the</option>
									<option value="Cook-Islands">Cook Islands</option>
									<option value="Costa-Rica">Costa Rica</option>
									<option value="Cote-divoire">Côte d'Ivoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Curacao">Curaçao</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech-Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican-Republic">Dominican Republic</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El-Salvador">El Salvador</option>
									<option value="Equatorial-Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland-Islands">Falkland Islands (Malvinas)</option>
									<option value="Faroe-Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French-Guiana">French Guiana</option>
									<option value="French-Polynesia">French Polynesia</option>
									<option value="French-Southern-Territories">French Southern Territories</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guernsey">Guernsey</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-Bissau">Guinea-Bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard-Island-and-McDonald-Islands">Heard Island and McDonald Islands</option>
									<option value="Holy-See-Vatican-City-State">Holy See (Vatican City State)</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong-Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran">Iran, Islamic Republic of</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle-of-Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jersey">Jersey</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea">Korea, Democratic People's Republic of</option>
									<option value="Korea">Korea, Republic of</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="LAO">Lao People's Democratic Republic</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libya">Libya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macao">Macao</option>
									<option value="Macedonia">Macedonia, the former Yugoslav Republic of</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall-Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia">Micronesia, Federated States of</option>
									<option value="Moldova">Moldova, Republic of</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montenegro">Montenegro</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="New-Caledonia">New Caledonia</option>
									<option value="New-Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk-Island">Norfolk Island</option>
									<option value="Northern-Mariana-Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Palestinian-Territory-Occupied">Palestinian Territory, Occupied</option>
									<option value="Panama">Panama</option>
									<option value="Papua-New-Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn">Pitcairn</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto-Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Reunion">Réunion</option>
									<option value="Romania">Romania</option>
									<option value="Russian-Federation">Russian Federation</option>
									<option value="Rwanda">Rwanda</option>
									<option value="Saint-Barthelemy">Saint Barthélemy</option>
									<option value="Saint-Helena">Saint Helena, Ascension and Tristan da Cunha</option>
									<option value="Saint-Kitts-and-Nevis">Saint Kitts and Nevis</option>
									<option value="Saint-Lucia">Saint Lucia</option>
									<option value="Saint-Martin">Saint Martin (French part)</option>
									<option value="Saint-Pierre">Saint Pierre and Miquelon</option>
									<option value="Saint-Vincent">Saint Vincent and the Grenadines</option>
									<option value="Samoa">Samoa</option>
									<option value="San-Marino">San Marino</option>
									<option value="Sao-Tome-and-Principe">Sao Tome and Principe</option>
									<option value="Saudi-Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Serbia">Serbia</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra-Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Sint-Maarten">Sint Maarten (Dutch part)</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon-Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South-Africa">South Africa</option>
									<option value="South-Georgia">South Georgia and the South Sandwich Islands</option>
									<option value="South-Sudan">South Sudan</option>
									<option value="Spain">Spain</option>
									<option value="Sri-Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard-and-Jan-Mayen">Svalbard and Jan Mayen</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syrian-Arab-Republic">Syrian Arab Republic</option>
									<option value="Taiwan">Taiwan, Province of China</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania, United Republic of</option>
									<option value="Thailand">Thailand</option>
									<option value="Timor-Leste">Timor-Leste</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad-and-Tobago">Trinidad and Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks-and-Caicos-Islands">Turks and Caicos Islands</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United-Arab-Emirates">United Arab Emirates</option>
									<option value="United-Kingdom">United Kingdom</option>
									<option value="United-States">United States</option>
									<option value="United-States-Minor-Outlying-Islands">United States Minor Outlying Islands</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Venezuela">Venezuela, Bolivarian Republic of</option>
									<option value="Viet-Nam">Viet Nam</option>
									<option value="Virgin-Islands">Virgin Islands, British</option>
									<option value="Virgin-Islands-US">Virgin Islands, U.S.</option>
									<option value="Wallis-and-Futuna">Wallis and Futuna</option>
									<option value="Western-Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
							
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Email <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select class="form-control" name="Gender">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                          </select>
                        </div>
                      </div>
					    
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="Username" type="text" name="Username" data-validate-length-range="5,20"  required="required" class="optional form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="phone" type="tel" name="Telephone">
						   <input type="hidden" name="Account" id="Account" value="<?php echo random_code(20); ?> ">
                           <input type="hidden" name="Token" id="Token" value="<?php echo mt_rand(0, 1000000); ?> "> 
                            <input type="hidden" name="Status" id="Status" value="Open">
							<input type="hidden" name="Sponsor" id="Sponsor" value="<?php echo $membernumber; ?> ">
                            <input type="hidden" name="Activation" id="Activation" value="0">
                        </div>
                      </div>
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button id="send" type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       
      </div>
  </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="build/js/intlTelInput.js"></script>
  <script>
    $("#phone").intlTelInput({
      utilsScript: "build/js/utils.js"
    });
  </script>
  </body>
</html>
