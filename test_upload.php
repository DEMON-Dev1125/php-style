<!DOCTYPE HTML>
<html>

<head>
    <title>Test upload</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>


<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Upload</h1>
        </div>


        <?php
        if (!empty($_FILES["image"]["name"])) {

            // functions
            include 'includes/functions.php';

            try {

                // new 'image' field
                $image = !empty($_FILES["image"]["name"])
                    ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"])
                    : "";
                $image = htmlspecialchars(strip_tags($image));


                // now, if image is not empty, try to upload the image
                if ($image) {
                    Image_Upload($image);
                }
            }

            // show error
            catch (Exception $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>


        <!-- html form here where the product information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <table class='table table-hover table-responsive table-bordered'>
                <!-- <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr> -->
                <tr>
                    <td>Photo</td>
                    <td><input type="file" name="image" value="image" id="image"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                    </td>
                </tr>
            </table>
        </form>



    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>