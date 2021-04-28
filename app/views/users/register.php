
<div class="text-center pt-5">
    <h2>Registration</h2>
</div>

<div class="registerUserForm p-5">
    <form method="POST" action="<?php echo URLROOT; ?>/users/register">
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Name *" name="name">
            <?php if($data['nameError']){ ?>
                <span class="invalidFeedback">
                    <?php echo $data['nameError']; ?>
                </span>
            <?php } ?>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Email *" name="email">
            <?php if($data['emailError']){ ?>
                <span class="invalidFeedback">
                    <?php echo $data['emailError']; ?>
                </span>
            <?php } ?>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Username *" name="username">
            <?php if($data['usernameError']){ ?>
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                </span>
            <?php } ?>
        </div>

        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password *" name="password">
            <?php if($data['passwordError']){ ?>
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>
            <?php } ?>
        </div>

        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password confirmation *" name="passwordConfirmation">
            <?php if($data['passwordConfirmationError']){ ?>
                <span class="invalidFeedback">
                    <?php echo $data['passwordConfirmationError']; ?>
                </span>
            <?php } ?>
        </div>

        <div class="mb-3">
            <button id="submit" type="submit" class="btn btn-primary" value="submit">Register</button>
        </div>

        <p class="options">You have an account? <a href="<?php echo URLROOT; ?>/users/login">Login!</a></p>
    </form>
</div>