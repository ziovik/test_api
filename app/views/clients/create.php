<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container center">
    <h1>
        Create new post
    </h1>

    <form action="<?php echo URLROOT; ?>/clients/create" method="POST">
        <div class="form-item">
            <input type="text" name="client_name" placeholder="Client Name...">

            <span class="invalidFeedback">
                <?php echo $data['clientError']; ?>
            </span>
        </div>
        <div class="form-item">
            <input type="text" name="email" placeholder="Client Email...">

            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
        </div>
        <div class="form-item">
            <input type="text" name="telephone" placeholder="Client telephone...">

            <span class="invalidFeedback">
                <?php echo $data['telephoneError']; ?>
            </span>
        </div>
        <div class="form-item">
            <input type="date" name="created_on" placeholder="Created On...">

            <span class="invalidFeedback">
                <?php echo $data['clientError']; ?>
            </span>
        </div>
        <div class="form-item">
            <textarea name="address" placeholder="Enter address..."></textarea>

            <span class="invalidFeedback">
                <?php echo $data['addressError']; ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>
