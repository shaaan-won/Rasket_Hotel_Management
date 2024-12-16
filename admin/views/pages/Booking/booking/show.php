<?php
// echo Page::title(["title"=>"Show Booking"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"booking", "text"=>"Manage Booking"]);
// echo Page::context_open();
// echo Booking::html_row_details($id);
// echo Page::context_close();
// echo Page::body_close();
?>



<div class="container my-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Invoice</h1>
            <p class="text-muted">Thank you for booking with us!</p>
        </div>
    </div>

    <!-- Booking Information -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Booking Details</h5>
            <p><strong>Booking ID:</strong> <?php echo $booking->id ?></p>
            <p><strong>Booking Date:</strong> <?php echo date("F d, Y", strtotime($booking->created_at)) ?></p>
            <p><strong>Customer Name:</strong> <?php echo CustomerDetail::find($booking->id)->name ?></p>
            <p><strong>Remark:</strong> <?php echo $booking->remark ?></p>
        </div>

        <div class="col-md-6 text-end">
            <h5>Payment Details</h5>
            <p><strong>Order Total:</strong><?php echo $booking->order_total ?> </p>
            <p><strong>Paid Total:</strong> <?php echo $booking->paid_total ?></p>
            <p><strong>Status:</strong> Paid </p>
        </div>
    </div>

    <!-- Booking Details Table -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h5>Booking Items</h5>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Room ID</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row -->
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>101</td>
                        <td>2024-12-20</td>
                        <td>2024-12-25</td>
                        <td>$250.00</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>102</td>
                        <td>2024-12-20</td>
                        <td>2024-12-23</td>
                        <td>$250.00</td>
                    </tr> -->
                    <?php
                    $items = BookingDetail::bookingdetail($booking->id);
                    // print_r($items);

                    foreach ($items as $key => $value) {
                        $key++;
                        echo "
                            <tr>
                                <th scope='row'> $key </th>
                                <td>{$value['id']}</td>
                                <td>{$value['from_date']}</td>
                                <td>{$value['to_date']}</td>
                                <td>{$value['price']}</td>

                            </tr>
                        " ;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <p class="text-muted">&copy; 2024 Your Hotel Name. All rights reserved.</p>
        </div>
    </div>
</div>