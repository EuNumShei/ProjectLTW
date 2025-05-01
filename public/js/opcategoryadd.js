document.addEventListener("DOMContentLoaded", function() {
    var buttons = document.getElementsByClassName('item_new_field_button');

    Array.from(buttons).forEach(function(button) {
        button.addEventListener('click', function() {
            var confirmed = confirm('Are you sure you want to save the changes?');
            if (!confirmed) {
                return;
            }

            var field = this.getAttribute('id');
            var value = document.getElementById('new_' + field).value;

            var urlParams = new URLSearchParams(window.location.search);
            var phone_id = urlParams.get('id');

            var formData = new FormData();
            formData.append(field, value);
            formData.append("product_id", phone_id);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/../actions/update-item-addnew.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Changes saved successfully!');
                    location.reload();
                } else {
                    console.error('Failed to save changes:', xhr.responseText);
                    alert('Failed to save changes!');
                }
            };
            xhr.send(formData);
        });
    });
});