<?php 

    include("header.php");

    include("config.php");

    function select_menu_items($conn, $filter_category = null, $filter_value = null){
        $menu_items_query = "SELECT * FROM menu";

        if(is_array($filter_value)){
            
            $filter_value = implode("', '", $filter_value);
            // return print_r($filter_value);
            $menu_items_query .= " WHERE {$filter_category} IN ('{$filter_value}')";
        }
        return mysqli_query($conn, $menu_items_query);
    }

    $menu_items = select_menu_items($conn);

?>

    <section id = "add-menu">
        <div class="menu">

            <div class = "title">
                <a href=""> 
                    <i class="uil uil-plus-circle"></i>
                    <span>
                        Add Menu
                    </span>
                </a>

            </div>

            <div class = "menu-table">
                <table cellspacing = "0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            if(mysqli_num_rows($menu_items) > 0){
                                while($data = mysqli_fetch_assoc($menu_items)){
                        ?>

                        <tr>
                            <td>
                                <img src="./assets/images/<?php echo $data['image']; ?>" alt="">
                            </td>
                            <td>
                                <?php echo $data['name']; ?>
                            </td>
                            <td>
                                <?php echo $data['description']; ?>
                            </td>
                            <td>
                                <?php echo $data['category']; ?>
                            </td>
                            <td>
                                <?php echo $data['price']; ?>
                            </td>
                            <td>
                                <?php echo $data['quantity']; ?>
                            </td>
                            <td>
                                <button id = "editItem" data-edititem="<?php echo $data['id']; ?>">
                                    <i class="uil uil-edit"></i>
                                </button>
                                <button id = "deleteItem" data-deleteitem="<?php echo $data['id']; ?>">
                                    <i class="uil uil-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>



    <script>
        $(document).ready(function(){
            // for editing items information
            $(document).on("click","#editItem", function(){
                var id = $(this).data("edititem");
                alert(id);
            });
            
            
            
            // for deleting item from database
            $(document).on("click","#deleteItem", function(){
                var id = $(this).data("deleteitem");

                if(confirm("Are you sure? You want to delete item")){
                    $.ajax({
                        url : "deletemenuitem.php",
                        method : "POST",
                        data : { menuItem : id },
                        success : function(data){
                            if(data == 1){
                                alert("Item deleted from database");
                                location.reload();
                            }else{
                                alert("Item could not deleted.");
                            }

                        }
                    });
                }

            });
        });
    </script>
</body>
</html>