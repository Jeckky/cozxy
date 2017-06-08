/**
 * Created by npr on 5/19/2017 AD.
 */

function ForgetCozxy() {
    $forget = $('#address-email').val();
    if ($forget == '') {
        alert('Please provide an email address as well.');
    } else {
        var $this = $('#Forget');
        $this.button('loading');
        setTimeout(function () {
            $this.button('reset');
        }, 8000);
        $.ajax({
            type: "POST",
            url: $baseUrl + "site/forget-password",
            data: {'forget': $forget},
            success: function (data, status)
            {
                //alert(data);
                if (status == "success") {
                    if (data == 1) {
                        alert('Please check your email to confirm your registration.');
                        //$('.bs-forget-modal-lg').close();
                        $('.bs-forget-modal-lg').modal('hide');
                    } else {
                        alert('Please provide an email address as well.');
                    }

                } else {
                    alert('Please provide an email address as well.');
                }
            }
        });
    }

}
