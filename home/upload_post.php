<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
*/ --><?php
        require_once('../include/connect.php');
        include_once("../include/functions.php");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['id'];

        if (empty($_FILES['file']['name'])) {
            $err = " <h3 id=error>Please ,choose photo to upload .</h3>";
            include_once("upload.php");
        } else

            // if (isset($_SESSION['id']) and isset($_SESSION['username'])) 
            if (isset($_POST['upload'])) {
                $file = $_FILES['file'];
                // print_r($file);
                // stripcslashes protect from scripts
                $fname = stripcslashes($_FILES['file']['name']);
                $fsize = stripcslashes($_FILES['file']['size']);
                $ferror = (int)$_FILES['file']['error'];
                $ftype = stripcslashes($_FILES['file']['type']);
                $ftmp_name = $_FILES['file']['tmp_name'];


                $fname_split = explode('.', $fname); //array return str.split('.')
                $fext = strtolower(end($fname_split)); // end take last item
                $allowed = array('jpg', 'jpge', 'png', 'mp2', 'svg', 'gif');

                first:
                if (in_array($fext, $allowed)) {
                    second:
                    if ($ferror === 0) {  //true upload //if (!$ferror) {
                        third:
                        if ($fsize < 5000000) {
                            $new_name = $_SESSION['username'] . date('y-M-d H-i-s.') . $fext;
                            // echo $new_name;
                            $target = '../Icon/' . $new_name;
                            $time = date('Y-m-d H:i:s');
                            $sql = "UPDATE `users` SET `avatar` = '$new_name', `updated_at` = '$time' WHERE `users`.`id` = '$id'";
                            mysqli_query($conn, $sql);
                            mysqli_close($conn);
                            move_uploaded_file($ftmp_name, $target);
                            header("location:home.php");
                        } else {
                            $err = " <h3 id=error>Sorry, your file is too large.</h3>";
                            include_once("upload.php");
                        } //end third
                    } else {
                        $err = " <h3 id=error>Sorry, your file was not uploaded.</h3>";
                        include_once("upload.php");
                    } //end second

                } else {
                    $err = " <h3 id=error>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h3>";
                    include_once("upload.php");
                } //end first
            } else
                include_once("upload.php");
