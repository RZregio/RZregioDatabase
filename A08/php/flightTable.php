<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Flight Number</th>
                <th>Departure Airport Code</th>
                <th>Arrival Airport Code</th>
                <th>Departure Date & Time</th>
                <th>Arrival Date & Time</th>
                <th>Duration (Minutes)</th>
                <th>Airline</th>
                <th>Aircraft Type</th>
                <th>Passenger Count</th>
                <th>Ticket Price</th>
                <th>Credit Card Number</th>
                <th>Credit Card Type</th>
                <th>Pilot Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($flightResult)) { ?>
                <tr>
                    <td><?php echo $row['flightNumber']; ?></td>
                    <td><?php echo $row['departureAirportCode']; ?></td>
                    <td><?php echo $row['arrivalAirportCode']; ?></td>
                    <td><?php echo $row['departureDatetime']; ?></td>
                    <td><?php echo $row['arrivalDatetime']; ?></td>
                    <td><?php echo $row['flightDurationMinutes']; ?></td>
                    <td><?php echo $row['airlineName']; ?></td>
                    <td><?php echo $row['aircraftType']; ?></td>
                    <td><?php echo $row['passengerCount']; ?></td>
                    <td><?php echo $row['ticketPrice']; ?></td>
                    <td><?php echo $row['creditCardNumber']; ?></td>
                    <td><?php echo $row['creditCardType']; ?></td>
                    <td><?php echo $row['pilotName']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>