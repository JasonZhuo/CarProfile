require([
    'jquery',
    "Razoyo_CarProfile/js/select2",
    'Magento_Ui/js/modal/alert' // Magento's built-in alert modal
], function ($, alert) {
    // Initialize Select2 on the select element
    $('#car').select2();

    $('#save-car-profile').click(function () {
        var form = $('#car-profile-form');
        var formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Update the car-info section with the new car info from the response
                    $('#car-info-container').html(response.carInfoHtml);

                    // Display success message
                    $('#car-profile-message').html('<div class="message success">' + response.message + '</div>');
                } else {
                    // Display error message
                    alert({
                        content: response.message
                    });
                }
            },
            error: function () {
                alert({
                    content: 'An error occurred while saving the car profile.'
                });
            }
        });

        // Optionally, clear the message after some time
        setTimeout(function () {
            $('#car-profile-message').html('');
        }, 10000); // Clear message after 10 seconds

        return false; // Prevent the form from submitting the default way
    });
});