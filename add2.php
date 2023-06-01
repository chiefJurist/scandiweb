<?php

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

    //If the form is submitted
    if (isset($_POST["submit"])) {
        // Create a Book instance
        $book = new Book();
        $book->setName($_POST['sku']);
        $book->setName($_POST['name']);
        $book->setPrice($_POST['price']);

        // Save the book to the database
        $book->save();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>scandiweb test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function test() {
                //The Select Element
                var selectElement = document.getElementById("productType");
                var selectedValue = selectElement.value;

                //The dynamically injected form
                var dvd = document.getElementById("DVD");
                var furniture = document.getElementById("Furniture");
                var book = document.getElementById("Book");

                (selectedValue == "DVD")? dvdControl(): (selectedValue == "Book")? bookControl(): furnitureControl();

            }

            //DVD CONTROL FUNCTION
            function dvdControl(){
                //The Select Element
                var selectElement = document.getElementById("productType");
                var selectedValue = selectElement.value;

                //The dynamically injected form
                var dvd = document.getElementById("DVD");
                var furniture = document.getElementById("Furniture");
                var book = document.getElementById("Book");


                //The input values of the dynamically injected form
                var size =document.getElementById("size");
                var weight =document.getElementById("weight");
                var height =document.getElementById("height");
                var width =document.getElementById("width");
                var length =document.getElementById("length");

                dvd.classList.remove("hide");
                furniture.classList.add("hide");
                book.classList.add("hide");
                weight.value = "";
                height.value = "";
                width.value = "";
                length.value = "";
            }

            //BOOK CONTROL FUNCTION
            function bookControl() {
                //The Select Element
                var selectElement = document.getElementById("productType");
                var selectedValue = selectElement.value;

                //The dynamically injected form
                var dvd = document.getElementById("DVD");
                var furniture = document.getElementById("Furniture");
                var book = document.getElementById("Book");


                //The input values of the dynamically injected form
                var size =document.getElementById("size");
                var weight =document.getElementById("weight");
                var height =document.getElementById("height");
                var width =document.getElementById("width");
                var length =document.getElementById("length");

                book.classList.remove("hide");
                furniture.classList.add("hide");
                dvd.classList.add("hide");
                size.value = "";
                height.value = "";
                width.value = "";
                length.value = "";
            }

            //FURNITURE CONTROL FUNCTION
            function furnitureControl() {
                //The Select Element
                var selectElement = document.getElementById("productType");
                var selectedValue = selectElement.value;

                //The dynamically injected form
                var dvd = document.getElementById("DVD");
                var furniture = document.getElementById("Furniture");
                var book = document.getElementById("Book");


                //The input values of the dynamically injected form
                var size =document.getElementById("size");
                var weight =document.getElementById("weight");
                var height =document.getElementById("height");
                var width =document.getElementById("width");
                var length =document.getElementById("length");

                furniture.classList.remove("hide");
                dvd.classList.add("hide");
                book.classList.add("hide");
                size.value = "";
                weight.value ="";
            }
        </script>
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
                padding: 4%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            #page-title{
                font-size: 2rem;
                flex-basis: 70%;
            }
            #save-product>.button, #cancel-product>.button{
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
            #body{
                padding: 50px;
                background-color: white;
                padding: 5%;
                border-radius: 5px;
                width: 80%;
                margin: 5% 10%;
                margin-bottom: 20%;
            }
            #sku-div, #name-div, #price-div{
                width: 100%;
                border: 1px solid #444;
                border-radius: 5px;
                padding: 15px 10px 5px;
                margin-top: 15px;
                font-size: large;
            }
            #sku, #name, #price{
                border: none;
                outline: none;
                font-size: large;
                width: 90%;
            }
            #productType{
                margin-top: 10%;
                padding: 5px;
                background-color: rgb(242, 242, 242);
                border-radius: 5px;
                width: 200px;
                border: 1px solid #444;
                overflow: hidden;
                cursor: pointer;
            }
            #DVD, #Furniture, #Book{
                border: 1px solid #444;
                margin: 3%;
                border-radius: 5px;
                padding: 20px 10px;
            }
            #Furniture>p, #Book>p{
                border-bottom: 1px solid #444;
                padding-top: 15px;
            }
            #DVD>p{
                border-bottom: 1px solid #444;
            }

            /*Footer*/
            footer{
                background-color: grey;
                padding: 4%;
                text-align: center;
                width: 100%;
                height: 9%;
                position: fixed;
                top: 91%;
            }

            /*FOR HIDIND UNCLICKED*/
            .hide{
                display: none;
            }

            /*FOR THE ERRORS*/
            .errors{
                text-align: center;
                font-family: Arial, Helvetica, sans-serif;
                color: red;
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
        <form action="add.php" method="post" id="product_form">
            <header>
                <div id="page-title">PRODUCT ADD</div>
                <div id="save-product">
                    <input type="submit" value="Save" name="save" class="button">
                </div>
                <div id="cancel-product">
                    <input type="submit" value="Cancel" name="cancel" class="button">
                </div>
            </header>


            <div id="body">
                <div id="sku-div">SKU: <input type="text" id="sku" name="sku" placeholder="Enter SKU"></div>

                <div id="name-div">Name: <input type="text" id="name" name="name" placeholder="Enter Name of product"></div>

                <div id="price-div">Price($): <input type="number" id="price" name="price" placeholder="Enter Product price"></div>

                <select name="productType" id="productType" onchange="test()">
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>

                <div id="type-form">
                    <div id="DVD">
                        <p>Size(MB): <input type="text" id="size" name="size"></p>
                        <P>Product Description</P>
                    </div>
                    <div id="Furniture" class="hide">
                        <p>Height(CM): <input type="text" id="height" name="height"></p>
                        <p>Width(CM): <input type="text" id="width" name="width"></p>
                        <p>Length(CM): <input type="text" id="length" name="length"></p>
                    </div>
                    <div id="Book" class="hide">
                        <p>Weight(KG): <input type="text" id="weight" name="weight"></p>
                        <P>Product Description</P>
                    </div>
                </div>
            </div>
            
            <footer>Anthony's Scandiweb Assignment</footer>
        </form>
    </body>
</html>