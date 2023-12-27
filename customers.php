<?php 

    include("header.php");

    include("config.php");
    $menu_items_query = "SELECT * FROM users_data";
    $menu_items = mysqli_query($conn, $menu_items_query);

?>

    <section id = "add-menu">
        <div class="menu">

            <div class = "title">
                <a href=""> 
                    <i class="uil uil-users-alt"></i>
                    <span>
                        Customers List
                    </span>
                </a>
            </div>

            <div class = "menu-table">
                <table cellspacing = "0">
                    <thead>
                        <tr>
                            <th>email</th>
                            <th>Name</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            if(mysqli_num_rows($menu_items) > 0){
                                while($data = mysqli_fetch_assoc($menu_items)){
                        ?>

                        <tr>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['username']; ?></td>
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

</body>
</html>