<?php
if (!isset($_SESSION)){
    session_start();
}
include "navbar.php";
include 'connection.php';
//-----------------------------
//
$target_dir = "images/uploads/";
$image_name = @$_FILES["fileUploadedForm"]["name"];
echo $image_name;
$image_name_withRandNumber = rand('0','100000') . "_" .@$_FILES["fileUploadedForm"]["name"];
$target_file = $target_dir . basename($image_name_withRandNumber);


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUploadedForm"]["tmp_name"]);

    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if (@$_FILES["fileUploadedForm"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo " ";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo " ";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileUploadedForm"]["tmp_name"], $target_file)) {
        echo "The file " . basename($image_name_withRandNumber) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


if ($uploadOk == 1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // receive all input values from the form
        $title         = @($_POST["title"]);
        $writer_name   = @($_POST["writer_name"]);
        $body          = @($_POST["body"]);
        $image         = $image_name_withRandNumber;
    }

    $sql = "INSERT INTO articles (title, writer_name, body, image) VALUES
 ('$title', '$writer_name', '$body', '$image')";
    $conn->exec($sql);

    header('location: add_post.php');
//    return false;
}
?>


<!--------------------------------------------------------------------->
<!---------------------------------Form-------------------------------->
<!--------------------------------------------------------------------->


<!-- Page Header -->
<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Add New Post</h1>
                    <span class="subheading">Have questions? I have answers.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
            <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
            <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
            <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
            <form method="POST" action="#"  enctype="multipart/form-data" name="sentMessage"  novalidate>
<!--                here exist Id, which show the msg error-->


                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Article Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Article Title" id="name" required data-validation-required-message="Please enter the title of the article.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Writer Name</label>
                        <input name="writer_name" type="text" class="form-control" placeholder="Writer name" id="phone" required data-validation-required-message="Please enter your phone number.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>The body of article</label>
                        <textarea name="body" rows="5" class="form-control" placeholder="The body of article" id="message" required data-validation-required-message="Please enter the body."></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                Select image to upload:
                <input type="file" name="fileUploadedForm">
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary" id="sendMessageButton">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>
<!-- Footer -->
<?php
include "footer.php";
?>

