document.addEventListener("DOMContentLoaded", function() {
    let op_buttons = document.getElementsByClassName('op-user-button');

    Array.from(op_buttons).forEach(function(button) {
        button.addEventListener('click', function() {
            var confirmed = confirm('Are you sure you want to toggle the operator status of this user?');
            if (!confirmed) {
                return;
            }

            console.log(button.id);

            let formData = new FormData();
            formData.append('user-id', button.id);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/../actions/user-op-toggle.php', true);
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
            console.log("it worked");
        });
    });
});
