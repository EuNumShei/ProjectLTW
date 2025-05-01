document.addEventListener("DOMContentLoaded", function() {
    let buttons = document.getElementsByClassName('remove-item');
    if (buttons && buttons.length > 0) {
        Array.from(buttons).forEach(button => {
            button.addEventListener('click', function() {
                let confirmed = confirm('Are you sure you want to remove this item?');
                if (!confirmed) {
                    return;
                }

                let form = new FormData();
                form.append('phone_id', button.id);
                form.append('action', 'remove_product');

                let xhr = new XMLHttpRequest();
                xhr.open('POST', '/../actions/removing-items.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Changes saved successfully!');
                    } else {
                        console.error('Failed to save changes:', xhr.responseText);
                        alert('Failed to save changes!');
                    }
                };
                xhr.send(form);
            });
        });
    }
});