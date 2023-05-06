<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/admin.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.ico" />
    <title>Admin</title>
</head>

<body>
    <header>
        <div id="header">
            <div class="brand-name">
                <a href="../index.php">
                    <span>Arte</span>
                    <span>crafts</span>
                </a>
            </div>
        </div>
    </header>
    <div class="overlay"></div>
    <section>
        <div class="container">
            <p>Product Items</p>
            <table class="item-table">
                <tr>
                    <th>Item ID</th>
                    <th colspan="2">Item</th>
                </tr>
            </table>
            <div class="addBtn">
                <button>Add Item</button>
            </div>

            <div class="form">
                <form action="" id="form">
                    <div class="preview">
                        <img id="preview" src="#" alt="item-image">
                    </div>
                    <br>
                    <label for="img">Select image:</label>
                    <input type="file" id="img-upload" name="image" accept="image/*" onchange="loadFile(event)">
                    <br>
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>
                    <br>
                    <p>Item kind:</p>
                    <input type="radio" id="paper" name="kind" value="1" required>
                    <label for="paper">Paper</label>
                    <input type="radio" id="notebook" name="kind" value="2">
                    <label for="notebook">Notebook</label>
                    <input type="radio" id="case" name="kind" value="3">
                    <label for="case">Case and Pouch</label>
                    <input type="radio" id="pen" name="kind" value="4">
                    <label for="pen">Pen</label>
                    <br>
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" required>
                    <br>
                    <label for="price">Stock:</label>
                    <input type="number" name="stock" id="stock" required>
                    <br>
                    <label for="description">Short description:</label><br>
                    <textarea name="description" id="description" cols="30" rows="4" maxlength="300"></textarea>
                    <br>
                    <input type="submit" value="Done" id="done">
                    <input type="button" value="Cancel" id="cancel">

                </form>
            </div>
            <div class="sticky"><button><a href="../index.php"><i class="fa fa-home"></i></a></button></div>
            <div class="view-modal">
                <button class="exit-view"><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></button>
                <img class="view-img" src="" alt="">
                <p class='view-name'></p>
                <p class='view-kind'></p>
                <p class='view-stock'>Stock: <span></span></p>
                <p class='view-price'>Price: ₱<span></span>.00</p>
                <p class='view-description'></p>
            </div>

            <div class="delete-confirmation-dialog">
                <p>Are you sure to delete the item?</p>

                <button class="actionBtn delete">Delete</button>
                <button class="actionBtn cancel">Cancel</button>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../global/js/animation.js"></script>
    <script>
        $(document).ready(function () {
            $(".form").hide() // hide the form when page is loaded or ready
            $('.delete-confirmation-dialog').hide()
            $('.view-modal').hide()


            $.ajax({
                method: "GET",
                url: '../server/item/get_all_item.php',
                success: function (response) {
                    let result = JSON.parse(response)
                    if (result.data) {
                        result.data.map((item) => {
                            setElements(item)
                        })
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        })

        function setElements(item) {
            let itemID = item["itemID"];
            let name = item["name"];
            let price = item["price"];
            let image = item["img"];
            let stock = item["stock"];
            let kind = item["kind"];
            let description = item["description"];
            let src = `../assets/images/${image}`
            $("table").append(

                $(`<tr id="item">
                    <td>${itemID}</td>
                    <td id=${itemID} colspan="2" class="data">
                        <p style="display: none;" id="item-id">${itemID}</p>
                        <p id="item-name">
                        ${name}
                        </p>
                        <p style="display: none;" id="item-kind">${kind}</p>
                        <p style="display: none;" id="item-price">${price}</p>
                        <p style="display: none;" id="item-stock">${stock}</p>
                        <p style="display: none;" id="item-description">${description}</p>
                        <p style="display: none;" id="item-img">${image}</p>
                        <div style="display:flex;">
                            <button class="viewBtn"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></button>
                            <button class="editBtn"><i class="fa fa-pencil-square fa-lg"
                                    aria-hidden="true"></i></button>
                            <button class="deleteBtn"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                        </div>
                    </td>
                </tr>`));
        }

        var loadFile = function (event) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);

            console.log((event.target.files[0]));

            preview.onload = function () {
                URL.revokeObjectURL(preview.src) // free memory
            }
        };


        $('form').submit(function (e) {
            e.preventDefault()

            const action = $('.form').data('action') //get the set data attribute
            formData = new FormData(this)
            switch (action) {
                case "add":
                    $.ajax({
                        method: "POST",
                        url: "../server/item/add.php",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);

                            location.reload()

                        },
                        error: function (xhr, status, error) {
                            console.error(xhr, status, error);
                        }
                    })
                    break;
                case "edit":
                    const ID = $('.form').data('ID')
                    formData.append('itemID', ID)
                    $.ajax({
                        method: "POST",
                        url: "../server/item/update.php",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            location.reload()

                        },
                        error: function (xhr, status, error) {
                            console.error(xhr, status, error);
                        }
                    })
                    break;
                default:
                    break;
            }
        })

        function clearInput() {
            $(':input').not(':button, :submit, :reset, :hidden').removeAttr('checked').removeAttr('selected').not(
                ':checkbox, :radio, select').val('')
        }

        $("#cancel").click(function () {
            clearInput()
            $(".form").hide()
        })

        $(".addBtn").click(function () {
            $("#preview").attr("src", "") //clear existing image src
            $('.form').data('action', 'add');
            clearInput()
            $(".form").slideDown("slow");
        })

        $(document).on('click', '.deleteBtn', function () {
            console.log("asd");
            $('.overlay').css("display", "block")
            $('.delete-confirmation-dialog').slideDown("fast")
            const ID = $($(this).parents("td")).attr("id");
            $('.delete-confirmation-dialog').data('ID', ID);
        })

        $(document).on('click', '.viewBtn', function () {
            $('.view-modal').slideDown("fast")
            $('.overlay').css("display", "block")

            const ID = parseInt($(this).parents('.data').find("#item-id").text())
            const name = $(this).parents('.data').find("#item-name").text().trim()
            let kind = parseInt($(this).parents('.data').find("#item-kind").text())
            const price = parseFloat($(this).parents('.data').find("#item-price").text())
            const stock = parseInt($(this).parents('.data').find("#item-stock").text())
            const description = $(this).parents('.data').find("#item-description").text().trim()
            const img = $(this).parents('.data').find("#item-img").text()

            switch (kind) {
                case 1:
                    kind = "Paper"
                    break;
                case 2:
                    kind = "Notebook"
                    break;
                case 3:
                    kind = "Case"
                    break;
                case 4:
                    kind = "Pen"
                    break;

                default:
                    break;
            }

            $(".view-img").attr("src", `../assets/images/${img}`)
            $('.view-name').text(name)
            $('.view-kind').text(kind)
            $('.view-stock span').text(stock)
            $('.view-price span').text(price)
            $('.view-description').text(description)


        })

        $(".exit-view").click(function () {
            $('.overlay').css("display", "none")
            $('.view-modal').hide()
        })

        $(document).on('click', '.editBtn', function () {

            //gets all existing values and put it into inputs
            const ID = parseInt($(this).parents('.data').find("#item-id").text())
            const name = $(this).parents('.data').find("#item-name").text().trim()
            const kind = parseInt($(this).parents('.data').find("#item-kind").text())
            const price = parseFloat($(this).parents('.data').find("#item-price").text())
            const stock = parseInt($(this).parents('.data').find("#item-stock").text())
            const description = $(this).parents('.data').find("#item-description").text().trim()
            const img = $(this).parents('.data').find("#item-img").text()

            $("#preview").attr("src", `../assets/images/${img}`)
            $('#name').val(name)
            $("input[name=kind][value=" + kind + "]").prop('checked', true)
            $('#price').val(price)
            $('#stock').val(stock)
            $('#description').val(description)

            $('.form').data('action', 'edit'); //set the data atrtibute
            $('.form').data('ID', ID);

            $(".form").slideDown("slow");
        })


        $(".deleteBtn").click(function () {

        })

        $(".delete-confirmation-dialog .delete").click(function () {
            const ID = $('.delete-confirmation-dialog').data('ID')
            const data = {
                "itemID": ID
            }
            $.ajax({
                method: "POST",
                url: "../server/item/delete.php",
                data: data,
                success: function (response) {
                    $('.overlay').css("display", "none")
                    $('.delete-confirmation-dialog').hide()
                    location.reload()

                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            })
        })
        $(".delete-confirmation-dialog .cancel").click(function () {
            $('.overlay').css("display", "none")
            $('.delete-confirmation-dialog').hide()
        })
    </script>


</body>

</html>