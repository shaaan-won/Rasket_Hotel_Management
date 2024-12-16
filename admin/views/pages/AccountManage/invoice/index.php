<?php
echo Page::title(["title" => "Manage Invoice"]);
echo Page::body_open();
echo Page::context_open();
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
echo Invoice::html_table($page, 10);
echo Page::context_close();
echo Page::body_close();


?>

<!-- <style>
    /* Modal Container */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        z-index: 1000;
        /* Ensures it's above other elements */
    }

    /* Modal Content Box */
    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        /* Set width as needed */
        height: 500px;
        /* Set height as needed */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Close Button */
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
    }

    /* Button Styles */
    #openModal  {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }

    #openModal:hover {
        background-color: #0056b3;
    }
</style> -->

<!-- Trigger Button -->
<!-- <button id="openModal" class="btn btn-primary">Open External Page</button> -->

<!-- Modal Structure -->
<!-- <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span> -->
        <!-- Iframe to Load External Page -->
        <!-- <iframe id="iframeContent" src="" frameborder="0" width="100%" height="400px"></iframe>
    </div>
</div> -->

<!-- <script>
    $(document).ready(function() {
        // Open the modal and load the external page in the iframe
        $('.open-modal').on('click', function() {
            // let currentUrl = window.location.href;
            let externalPageUrl = "<?php //echo $base_url; ?>/invoice/show?id=1";
            // let externalPageUrl = "currentUrl + '/invoice/show?id=1'";

            $('#iframeContent').attr('src', externalPageUrl); // Set the iframe source
            $('#myModal').fadeIn(); // Show the modal
        });

        // Close the modal
        $('.close').on('click', function() {
            $('#myModal').fadeOut();
            $('#iframeContent').attr('src', ''); // Clear the iframe content when closing
        });

        // Close the modal when clicking outside the modal content
        $(window).on('click', function(e) {
            if ($(e.target).is('#myModal')) {
                $('#myModal').fadeOut();
                $('#iframeContent').attr('src', ''); // Clear the iframe content
            }
        });
    });
</script> -->