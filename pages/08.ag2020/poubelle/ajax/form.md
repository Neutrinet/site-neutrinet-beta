---
title: Ajax Test-Form
form:
    name: ajax-test-form
    action: '/ag2020/ajax'
    template: form-messages
    refresh_prevention: true

    fields:
        name:
            label: Your Name
            type: text

    buttons:
        submit:
            type: submit
            value: Submit

    process:
        message: 'Thank you for your submission!'

form:
    name: ajax-test-form2
    action: '/ag2020/ajax'
    template: form-messages
    refresh_prevention: true

    fields:
        name:
            label: Blabla
            type: text

    buttons:
        submit:
            type: submit
            value: Next

    process:
        message: 'Thank you for your submission!'
---

<div id="form-result"></div>

<script>
$(document).ready(function(){

    var form = $('#ajax-test-form');
    form.submit(function(e) {
        // prevent form submission
        e.preventDefault();

        // submit the form via Ajax
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            dataType: 'html',
            data: form.serialize(),
            success: function(result) {
                // Inject the result in the HTML
                $('#form-result').html(result);
            }
        });
    });
});
</script>