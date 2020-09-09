<?php include "includes/admin_header.php" ?>
    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">

                        <?php
                        
                        if(isset($_POST["submit"])) {

                        $cat_title = $_POST["cat_title"];

                        if($cat_title == "" || empty($cat_title)) {

                        echo "This field should not be empty!";
                        }
                        else{

                        $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
                        $create_category = mysqli_query($connection, $query);

                        header("Location: categories.php");
                        }
                        }

                        if(isset($_POST["edit"])) {

                        $cat_title_new = $_POST["cat_title_new"];
                        $edit_id_set = $_GET["edit"];

                        $query_update = "UPDATE `categories` SET `cat_title`= '$cat_title_new' WHERE cat_id = '$edit_id_set'";
                        $update_category = mysqli_query($connection, $query_update);

                        header("Location: categories.php");

                        }
                        ?>




                        <form action="" method="POST">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input class="form-control" type="text" name="cat_title">

                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add category">

                        </div>
                        </form>

                        <?php
                        
                        if(isset($_GET["edit"])) {

                        $edit_id = $_GET["edit"];

                        $query  = "SELECT cat_title FROM categories WHERE cat_id = '$edit_id'";
                        $edit_show = mysqli_query($connection, $query);


                        while ($row = mysqli_fetch_assoc($edit_show)) {

                            $edit_show_title = $row["cat_title"];

                        }
                        
                        ?>

                        <form action="" method="POST">
                        <div class="form-group">
                            <label for="cat_title">Edit category</label>
                            <?php echo "<input class='form-control' type='text' name='cat_title_new' value='$edit_show_title'>"; ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit" value="Update">
                        </div>
                        </form>

                        <?php
                        }
                        
                        ?>




                        </div><!-- add/edit category form -->

                        <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Id</th>
                                <th>Category title</th>
                            </thead>
                            <tbody>
                            <?php //listázza a kategoriákat

                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_categories)) {
                            
                            $cat_id = $row["cat_id"];
                            $cat_title = $row["cat_title"];
                            
                            echo "<tr>";
                            echo "<td>{$cat_id}</td>";
                            echo "<td>{$cat_title}</td>";
                            echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
                            echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
                            echo "</tr>";

                            }
                            ?>


                            <?php
                            
                            if (isset($_GET["delete"])) {

                            $get_cat_id = $_GET["delete"];

                            $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
                            $delete_cat = mysqli_query($connection, $query);
                            header("Location: categories.php");


                            }
                            
                            
                            
                            ?>
                            
                            </tbody>
                        </table>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>