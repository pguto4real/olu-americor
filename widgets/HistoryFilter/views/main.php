<form method="GET" action="">
    <hr />
    <label>
        Select User:
        <select name="user_id" id="user_id">
            <option value="">--Select User--</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Select Customer:
        <select name="customer_id" id="customer_id">
            <option value="">--Select Customer--</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer->id; ?>"><?= $customer->name; ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Select Event:
        <select name="event" id="event">
            <option value="">--Select Event--</option>
            <?php foreach ($events as $event): ?>
                <option value="<?= $event['event']; ?>"><?= $event['event']; ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="button" id="filter-button" class="btn btn-sm btn-success">Filter</button>
    <hr />
</form>