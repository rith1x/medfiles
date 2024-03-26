<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
   $pres=$_POST['pres'];
   
 
      $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$bp','$bs','$weight','$temp','$pres')");
    if ($query) {
    echo '<script>alert("Medicle history has been added.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Manage Patients</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Doctor | Manage Patients</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Doctor</span>
</li>
<li class="active">
<span>Manage Patients</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
 Patient Details</td></tr>

    <tr>
    <th scope>Patient Name</th>
    <td><?php  echo $row['PatientName'];?></td>
    <th scope>Patient Email</th>
    <td><?php  echo $row['PatientEmail'];?></td>
  </tr>
  <tr>
    <th scope>Patient Mobile Number</th>
    <td><?php  echo $row['PatientContno'];?></td>
    <th>Patient Address</th>
    <td><?php  echo $row['PatientAdd'];?></td>
  </tr>
    <tr>
    <th>Patient Gender</th>
    <td><?php  echo $row['PatientGender'];?></td>
    <th>Patient Age</th>
    <td><?php  echo $row['PatientAge'];?></td>
  </tr>
  <tr>
    
    <th>Patient Medical History(if any)</th>
    <td><?php  echo $row['PatientMedhis'];?></td>
     <th>Patient Reg Date</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
 
<?php }?>
</table>
<?php  

$ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="8" >Medical History</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Blood Pressure</th>
<th>Weight</th>
<th>Blood Sugar</th>
<th>Body Temprature</th>
<th>Medical Prescription</th>
<th>Visit Date</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['BloodPressure'];?></td>
 <td><?php  echo $row['Weight'];?></td>
 <td><?php  echo $row['BloodSugar'];?></td> 
  <td><?php  echo $row['Temperature'];?></td>
  <td><?php  echo $row['MedicalPres'];?></td>
  <td><?php  echo $row['CreationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>

<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Add Medical History</button></p>  

<?php  ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

      <tr>
    <th>Blood Pressure :</th>
    <td>
    <input name="bp" placeholder="Blood Pressure" class="form-control wd-450" required="true"></td>
  </tr>                          
     <tr>
    <th>Blood Sugar :</th>
    <td>
    <input name="bs" placeholder="Blood Sugar" class="form-control wd-450" required="true"></td>
  </tr> 
  <tr>
    <th>Weight :</th>
    <td>
    <input name="weight" placeholder="Weight" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Documents Upload:</th>
    <td>
    <div class="imgside">
    <input 
    name="temp" 
    placeholder="Upload any medical Documents" 
    class="form-control wd-450" 
    id="fileUrl" 
    required="true" 
    readonly>
                            <label for="">Observation Images: </label>
                            <div class="domer">
                                <p class="hixx" id="iupdng">
                                    Continue by Uploading multiple images.
                                </p>
                                <div class="progress rounded-pill" style="display: none;" id="iprog">
                                    <div role="progressbar" aria-valuenow="55" aria-valuemin="0" id="iinval"
                                        aria-valuemax="100" class="progress-bar rounded-pill"></div>
                                </div>
                                <div class="fileview">

                                    <input type="file" id="imgFile" required accept="image/*" multiple
                                        onchange="showiButton()" />
                                    <button class="nones" id="iupx" type="submit" onclick="uploadImage()">Proceed <i
                                            class="fa fa-circle-arrow-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                           
                        </div>
  </td>
  </tr>
               
     <tr>
    <th>Prescription :</th>
    <td>
    <textarea name="pres" placeholder="Medical Prescription" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>  
   
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->

		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>




<script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
        <script>
            function closePrompy() {
                const prompy = document.getElementById("observation");
                prompy.style.transform = "translateY(-200dvh)"

            }
            function showButton() {
                var fileInput = document.getElementById('videoFile');
                var submitButton = document.getElementById('upx');
                if (fileInput.files.length > 0) {
                    submitButton.style.display = 'block';
                } else {
                    submitButton.style.display = 'none';
                }
            }
            function showiButton() {
                var fileInput = document.getElementById('imgFile');
                var submitButton = document.getElementById('iupx');
                if (fileInput.files.length > 0) {
                    submitButton.style.display = 'block';
                } else {
                    submitButton.style.display = 'none';
                }
            }
            const fbcon = {
  apiKey: "AIzaSyDC6jqL3M_dx_WorwKyzevSgPNilNxTBSw",
  authDomain: "medfiles-x.firebaseapp.com",
  projectId: "medfiles-x",
  storageBucket: "medfiles-x.appspot.com",
  messagingSenderId: "177668849041",
  appId: "1:177668849041:web:20ab11f449920c80272e30"
};
            const print = (dat) => { console.log(dat); }
            firebase.initializeApp(fbcon);
            function uploadVideo() {
                document.getElementById('upx').innerHTML = `Uploading! <i class="fa-solid fa-cloud-arrow-up"></i>`;
                document.getElementById('updng').textContent = "Uploading, Please Wait!";
                document.getElementById('upx').setAttribute("disabled", "disabled");
                document.getElementById('videoFile').style.display = "none";
                document.getElementById('upx').style.display = "none";

                document.getElementById('prog').style.display = "block";
                const inval = document.getElementById('inval');


                var user = document.getElementById("obsuid").value;
                var storage = firebase.storage();
                var file = document.getElementById("videoFile").files[0];
                var storageRef = storage.ref();
                var thisref = storageRef.child(user).child(`report`).child("video").put(file);

                thisref.on(
                    "state_changed",
                    function (snapshot) {
                        print(snapshot);
                        let bValue = snapshot.b;
                        let sMb = bValue / 1048576;
                        sMb = sMb.toFixed(2);

                        let hValue = snapshot.h;
                        let fMb = hValue / 1048576;
                        fMb = fMb.toFixed(2);
                        let percent = (bValue / hValue) * 100;
                        percent = parseInt(percent);
                        document.getElementById('updng').textContent = `Uploading your Video, (${sMb}MB / ${fMb}MB)`;
                        print(`${percent}%`);
                        if (sMb == fMb) {
                            document.getElementById('updng').textContent = `Video Uploaded Successfully!`;

                        }
                        inval.innerText = `${percent}%`;
                        inval.style.width = `${percent}%`;


                    },
                    function (error) { },

                    function () {
                        var downloadURL = thisref.snapshot.downloadURL;
                        console.log("got url");
                        document.getElementById("subUrl").value = downloadURL;
                        document.getElementById("subUrl2").value = downloadURL;

                        print(downloadURL);

                    }
                );
            }
            let imgUrls = [];
            function uploadImage() {
                document.getElementById('iupx').innerHTML = `Uploading! <i class="fa-solid fa-cloud-arrow-up"></i>`;
                document.getElementById('iupdng').textContent = "Uploading, Please Wait!";
                document.getElementById('iupx').setAttribute("disabled", "disabled");
                document.getElementById('imgFile').style.display = "none";
                document.getElementById('iupx').style.display = "none";
                document.getElementById('iprog').style.display = "block";
                const inval = document.getElementById('iinval');
                var user = "W4GOycnsmzOJ0C6ercXzOmbcMkZ2";
                var storage = firebase.storage();
                var file = document.getElementById("imgFile").files;
                var files = Array.from(file);
                var storageRef = storage.ref();
                const uploadPromises = files.map((img, index) => {
                    return new Promise((resolve, reject) => {
                        var thisref = storageRef.child(user).child(`report`).child("images").child(`img${index}`).put(img);
                        thisref.on(
                            "state_changed",
                            function (snapshot) {
                                let bValue = snapshot.bytesTransferred;
                                let sMb = bValue / 1048576;
                                sMb = sMb.toFixed(2);

                                let hValue = snapshot.totalBytes;
                                let fMb = hValue / 1048576;
                                fMb = fMb.toFixed(2);
                                let percent = (bValue / hValue) * 100;
                                percent = parseInt(percent);
                                document.getElementById('iupdng').textContent = `Uploading your image ${index}, (${sMb}MB / ${fMb}MB)`;
                                inval.innerText = `${percent}%`;
                                inval.style.width = `${percent}%`;
                            },
                            function (error) {
                                reject(error);
                            },
                            function () {
                                // Upload completed successfully, now we can get the download URL
                                var downloadURL = thisref.snapshot.downloadURL;
                                console.log("got url");
                                imgUrls[index] = downloadURL;
                                resolve();
                            }
                        );
                    });
                });

                // Wait for all upload promises to resolve
                Promise.all(uploadPromises)
                    .then(() => {
                        // Once all uploads are complete, join the imgUrls array and set the value
                        var finalUrl = imgUrls.join(",");
                        console.log(finalUrl);
                        document.getElementById("fileUrl").value = finalUrl;

                    })
                    .catch(error => {
                        console.error('Error uploading images:', error);
                        // Handle error here
                    });
            }










            function submitForm() {

                var form = document.getElementById("vidform");
                form.submit();
            }





        </script>




		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
<?php }  ?>
