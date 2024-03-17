<form method="GET" action="">
    <hr />
    <label>
        Select User:
        <select name="user_id" id="user_id">
            <option value="">--Select User--</option>
            <?php
            foreach ($users as $user) {
            ?>
                <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
            <?php
            }
            ?>
        </select>
    </label>

    <label>
        Select Customer:
        <select name="customer_id" id="customer_id">
            <option value="">--Select Customer--</option>
            <?php
            foreach ($customers as $customer) {
            ?>
                <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
            <?php
            }
            ?>
        </select>
    </label>

    <label>
        Select Event:
        <select name="event" id="event">
            <option value="">--Select Event--</option>
            <?php
            foreach ($events as $event) {
            ?>
                <option value="<?php echo $event['event']; ?>"><?php echo $event['event']; ?></option>
            <?php
            }
            ?>
        </select>
    </label>

    <button type="button" id="filter-button" class="btn btn-sm btn-success">Filter</button>
    <hr />

</form>