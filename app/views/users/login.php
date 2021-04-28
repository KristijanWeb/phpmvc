
<div class="text-center pt-5">
    <h2>Login</h2>
</div>

<div class="loginUserForm p-5">
    <form action="<?php echo URLROOT; ?>/users/login" method ="POST">
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

        <button id="submit" type="submit" value="submit" class="btn btn-primary">Login</button>

        <div class="pt-3">
            <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/users/register">Create an account!</a></p>
        </div>
    </form>
</div>