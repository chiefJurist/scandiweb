<?php
    //Include the connection to database    
    include("config.php");

    //Write query for all products
    $sql = "SELECT * FROM products ORDER BY created_at";

    //Make query and get results
    $result = mysqli_query($conn, $sql);

    //Fetch the resulting rows as am array
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);


    // IF THE DELETE BUTTON IS PRESSED
    if (isset($_POST["delete"])) {
        $idsToDelete = $_POST["delete-checkbox"]; // Assuming this is an array of IDs

        if (!empty($idsToDelete)) {
            $ids = implode(",", array_fill(0, count($idsToDelete), "?"));
            $sql2 = "DELETE FROM products WHERE id IN ($ids)";

            $stmt = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt, str_repeat('i', count($idsToDelete)), ...$idsToDelete);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Success
                header("Location: index.php");
                exit();
            }
        }
    }


    //IF THE ADD BUTTON IS CLICKED
    if (isset($_POST["add"])) {
        header("Location: add.php");
        exit();
    }

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>scandiweb test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /*GENERAL*/
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }
            body{
                font-family: Arial, Helvetica, sans-serif;
                background-color: rgb(255, 248, 255);
            }

            /*Header*/
            header{
                background-color: grey;
                padding: 2%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            #page-title{
                font-size: 2rem;
                flex-basis: 70%;
            }
            #add-product{
                flex-basis: 10%;
            }
            #mass-delete{
                flex-basis: 10%;
            }
            #add-product>button, #mass-delete>button, #save-product>button, #cancel-product>button{
                border: none;
                outline: none;
                border-radius: 5px;
                background-color: #444;
                color: white;
                padding: 10px;
                font-weight: bold;
                width: 80px;

            }

            /*Body Section*/
            #product-section{
                margin-top: 2rem;
                padding: 0% 5%;
                padding-top: 5%;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-row-gap: 3rem;
                grid-column-gap: 2rem;
                text-align: center;
                margin-bottom: 20%;
            }
            .product-div{
                background-color: white;
                border: 1px solid black;
                border-radius: 5px;
                padding: 15px 0px;
            }

            /*Footer*/
            footer{
                background-color: grey;
                padding: 1.5%;
                text-align: center;
                position: fixed;
                top: 91%;
                width: 100%;
                height: 9%;
            }



            /*FOR PHONES*/
            @media (max-width: 600px) {
                #page-title{
                    font-size: 1rem;
                    flex-basis: 50%;
                }
                #add-product, #mass-delete, #cancel-product, #save-product{
                    flex-basis: 23%;
                }
                #product-section{
                    grid-template-columns: repeat(1, 1fr);
                }
            }
        </style>
    </head>
    <body>
       <form action="index.php" method="post">
             <!--FOR THE HEADER SECTION-->
            <header>
                <div id="page-title">YOUR PRODUCT LIST</div>
                <div id="add-product"><button name="add">ADD</button></div>
                <div id="mass-delete"><button name="delete">MASS DELETE</button></div>
            </header>


            <!--FOR THE BODY SECTION-->
            <section id="product-section">
                <!--Individual products-->
                <?php foreach ($products as $product){?>
                    <div class="product-div">
                        <div class="check-div">
                            <input type="checkbox" class="delete-checkbox" name="delete-checkbox[]" value="<?php echo $product['id']; ?>">
                        </div>
                        <p class="sku"><?php echo htmlspecialchars(strtoupper($product["sku"])) ?></p>
                        <p class="product-name"><?php echo htmlspecialchars($product["name"]) ?></p>
                        <p class="product-price">$<?php echo htmlspecialchars(number_format($product["price"], 2)) ?></p>
                        <p class="product-size"><?php echo htmlspecialchars($product["size"]) ?></p>
                        <p class="product-size"><?php echo htmlspecialchars($product["weight"]) ?></p>
                        <p class="product-size"><?php echo htmlspecialchars($product["dimension"]) ?></p>
                    </div>
                <?php } ?>
            </section>

            <footer>Anthony's Scandiweb Assignment</footer>
       </form>
    </body>
</html>