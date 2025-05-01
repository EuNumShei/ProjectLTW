document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById('item-update');

    if (button) {
        button.addEventListener('click', function() {
            var confirmed = confirm('Are you sure you want to save the changes?');
            if (!confirmed) {
                return;
            }

            var tables = document.querySelectorAll('.edit-phone table');
            var formData = new FormData();
            tables.forEach(function(table) {
                var rows = table.querySelectorAll('tr');
                rows.forEach(function(row) {
                    var tds = row.querySelectorAll('td');
                    if (tds && tds.length >= 2) {
                        var field = tds[0].querySelector('label').getAttribute('for');
                        var valueElement = tds[1].querySelector('select') || tds[1].querySelector('textarea') || tds[1].querySelector('input') || tds[1].querySelector('img');
                        if (valueElement) {
                            var value = valueElement.value;
                            if (field == "image-upload") {
                                return;
                            } else {
                                formData.append(field, value);
                            }
                        }
                    } 
                });
            });
            
            var urlParams = new URLSearchParams(window.location.search);
            var product_id = urlParams.get('id');
            formData.append("product_id", product_id);

            formData.append('operator_request', 'true');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/../actions/update-item-noimage.php', true);
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
    };
});