<?php
    // product-list.php

    // Include necessary class files
    require_once 'validate.php';

    // Connect to the database
    $host = 'localhost';
    $username = 'chiefJurist';
    $password = '#Chibueze2003';
    $database = 'scandiweb';

    $db = new DatabaseConnection($host, $username, $password, $database);
    $db->connect();

    // Set the database connection for the Product class
    Product::setDatabaseConnection($db);

    // Create a Book instance
    $book = new Book();
    $book->setSKU('The Great Gatsby');
    $book->setName('F. Scott Fitzgerald');
    $book->setPrice('978-3-16-148410-0');
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
                <!--
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
                -->
            </section>

            <footer>Anthony's Scandiweb Assignment</footer>
       </form>
    </body>
</html>