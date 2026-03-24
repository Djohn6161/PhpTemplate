<form class="theme-form login-form" hx-post="<?= $this->basePath ?>setup" hx-target="#logCard" hx-trigger="submit" hx-enctype="multipart/form-data">

    <input type="hidden" name="process" value="2">
    <h4>First System Setup: Step 2</h4>
    <h6>Please Fill in the Necessary Information for the Primary Admin of the Website.</h6>
    <div class="form-group">
        <label>First Name</label>
        <div class="input-group">
            <span class="input-group-text"><i class="icon-user"></i></span>
            <input class="form-control" type="text" name="first_name" required="" value="Biggs">
        </div>
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <div class="input-group">
            <span class="input-group-text"><i class="icon-user"></i></span>
            <input class="form-control" type="text" name="last_name" required="" value="Admin">
        </div>
    </div>

    <div class="form-group">
        <label>Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="icon-email"></i></span>
            <input class="form-control" type="text" name="email" required="" value="biggsAdmin@gmail.com">
        </div>
    </div>
    <div class="form-group">
        <label>Username</label>
        <div class="input-group">
            <span class="input-group-text"><i class="icon-user"></i></span>
            <input class="form-control" type="text" required="" name="username" value="admin">
        </div>
    </div>
    <div class="form-group">
        <label>Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="icon-lock"></i></span>
            <input class="form-control" type="password" name="password" required="" value="admin" autocomplete="true">
            <div class="show-hide"><span class=""></span></div>
        </div>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="icon-lock"></i></span>
            <input class="form-control" type="password" required="" name="Cpassword" value="admin" autocomplete="true">
            <div class="show-hide"><span class=""></span></div>

        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">Next <i class="icon-arrow-right"></i></button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".show-hide").show();
        $(".show-hide span").addClass("show");

        $(".show-hide span").click(function() {
            var input = $(this).parent().siblings('input');
            if ($(this).hasClass("show")) {
                input.attr("type", "text");
                $(this).removeClass("show");
                $(this).addClass("hide");
            } else {
                input.attr("type", "password");
                $(this).removeClass("hide");
                $(this).addClass("show");

            }
        });
    });
</script>