<?php
// echo Page::title(["title"=>"Manage Division"]);
// echo Page::body_open();
// echo Page::context_open();
// $page = isset($_GET["page"]) ?$_GET["page"]:1;
// echo Division::html_table($page,10);
// echo Page::context_close();
// echo Page::body_close();
?>

<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Area</th>
            <th scope="col">Population</th>
            <th scope="col">Capital City</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="data-table">
        <!-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
        </tr> -->
    </tbody>

</table>

<script>
    $(document).ready(function() {

        $.ajax({
            url: '<?= $base_url ?>/api/division',
            type: 'get',
            data: {},
            success: function(response) {
                // console.log(response);
                let data = JSON.parse(response);
                data = data.divisions;
                let html = "";
                data.forEach(element => {
                    // console.log(element);
                    html += `
                    <tr>
                        <th scope="row">${element.id}</th>
                        <td>${element.name}</td>
                        <td>${element.AreaKm2}</td>
                        <td>${element.Population}</td>
                        <td>${element.CapitalCity}</td>
                        <td>
                        <button class="btn btn-primary edit" data-id="${element.id}">Edit</button>
                        <button class="btn btn-danger delete" data-id="${element.id}">Delete</button>
                        </td>
                    </tr>
                    `;
                });
                $("#data-table").html(html);
            },
            error: function(error) {
                console.log(error);
            }


        });
       
        // $(".edit").on("click", function() {    //when its not working then use below system
        //     alert("hello");
        // })
        $("body").on("click", ".edit", function() {
            // alert("hello");
            let id = $(this).data("id");
            // console.log(id);
            window.location.href = "<?= $base_url ?>division/edit/" + id;
        });

        $("body").on("click", ".delete", function() {
            let id = $(this).data("id");
            // console.log(id);
            if (confirm("Are you sure you want to delete this division?")) {
                $.ajax({
                    url: "<?= $base_url ?>api/division/delete",
                    type: "post",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        let data = JSON.parse(res);
                        if (data.success) {
                            // alert("Division deleted successfully!");
                            // window.location.href = "<?= $base_url ?>division";
                            location.reload();
                        }
                        else {
                            alert("An error occurred while deleting the division." + data.message);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        alert("An error occurred while deleting the division.");
                    }
                });
            }
           
            
            
        });
    });
</script>


<!-- From Chat GPT -->
<!-- <script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost/Project_PHP/Rasket_Hotel_Management/admin/api/division',
            type: 'get',
            success: function(response) {
                console.log(response);
                let data = typeof response === 'string' ? JSON.parse(response) : response;
                if (data.divisions) {
                    let html = "";
                    data.divisions.forEach(element => {
                        html += `
                            <tr>
                                <th scope="row">${element.id}</th>
                                <td>${element.name}</td>
                                <td>${element.AreaKm2}</td>
                                <td>${element.Population}</td>
                                <td>${element.CapitalCity}</td>
                                <td><button class="btn btn-primary" onclick="Division.edit(${element.id})">Edit</button></td>
                            </tr>
                        `;
                    });
                    $("#data-table").html(html);
                } else {
                    console.error("divisions key not found in response");
                }
            },
            error: function(error) {
                console.log(error);
                alert("Failed to fetch data. Please try again.");
            }
        });
    });
    
</script> -->