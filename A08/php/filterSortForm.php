<form method="GET" class="mb-4">
    <div class="row g-3">
        <div class="col-md-4">
            <label for="airline" class="form-label">Filter by Airline</label>
            <select name="airline" id="airline" class="form-select">
                <option value="">All Airlines</option>
                <?php while ($airlineRow = mysqli_fetch_assoc($airlines)) { ?>
                    <option value="<?php echo $airlineRow['airlineName']; ?>" <?php echo (isset($_GET['airline']) && $_GET['airline'] == $airlineRow['airlineName']) ? 'selected' : ''; ?>>
                        <?php echo $airlineRow['airlineName']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="aircraft" class="form-label">Filter by Aircraft</label>
            <select name="aircraft" id="aircraft" class="form-select">
                <option value="">All Aircraft</option>
                <?php while ($aircraftRow = mysqli_fetch_assoc($aircrafts)) { ?>
                    <option value="<?php echo $aircraftRow['aircraftType']; ?>" <?php echo (isset($_GET['aircraft']) && $_GET['aircraft'] == $aircraftRow['aircraftType']) ? 'selected' : ''; ?>>
                        <?php echo $aircraftRow['aircraftType']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="departure" class="form-label">Filter by Departure Airport Code</label>
            <select name="departure" id="departure" class="form-select">
                <option value="">All Departures</option>
                <?php while ($departureRow = mysqli_fetch_assoc($departures)) { ?>
                    <option value="<?php echo $departureRow['departureAirportCode']; ?>" <?php echo (isset($_GET['departure']) && $_GET['departure'] == $departureRow['departureAirportCode']) ? 'selected' : ''; ?>>
                        <?php echo $departureRow['departureAirportCode']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="arrival" class="form-label">Filter by Arrival Airport Code</label>
            <select name="arrival" id="arrival" class="form-select">
                <option value="">All Arrivals</option>
                <?php while ($arrivalRow = mysqli_fetch_assoc($arrivals)) { ?>
                    <option value="<?php echo $arrivalRow['arrivalAirportCode']; ?>" <?php echo (isset($_GET['arrival']) && $_GET['arrival'] == $arrivalRow['arrivalAirportCode']) ? 'selected' : ''; ?>>
                        <?php echo $arrivalRow['arrivalAirportCode']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="creditcard" class="form-label">Filter by Credit Card Type</label>
            <select name="creditcard" id="creditcard" class="form-select">
                <option value="">All Credit Cards</option>
                <?php while ($creditcardRow = mysqli_fetch_assoc($creditcards)) { ?>
                    <option value="<?php echo $creditcardRow['creditCardType']; ?>" <?php echo (isset($_GET['creditcard']) && $_GET['creditcard'] == $creditcardRow['creditCardType']) ? 'selected' : ''; ?>>
                        <?php echo $creditcardRow['creditCardType']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="sort" class="form-label">Sort By</label>
            <select name="sort" id="sort" class="form-select">
                <option value="">Default</option>
                <option value="flightNumber" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'flightNumber') ? 'selected' : ''; ?>>Flight Number</option>
                <option value="departureDatetime" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'departureDatetime') ? 'selected' : ''; ?>>Departure Date & Time</option>
                <option value="arrivalDatetime" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'arrivalDatetime') ? 'selected' : ''; ?>>Arrival Date & Time</option>
                <option value="flightDurationMinutes" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'flightDurationMinutes') ? 'selected' : ''; ?>>Flight Duration</option>
                <option value="passengerCount" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'passengerCount') ? 'selected' : ''; ?>>Passenger Count</option>
                <option value="ticketPrice" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ticketPrice') ? 'selected' : ''; ?>>Ticket Price</option>
                <option value="creditCardNumber" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'creditCardNumber') ? 'selected' : ''; ?>>Credit Card Number</option>
                <option value="pilotName" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'pilotName') ? 'selected' : ''; ?>>Pilot Name</option>
            </select>
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Apply</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </div>
</form>