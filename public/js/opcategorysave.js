document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById('category-save');

    if (button) {
        button.addEventListener('click', function() {
            var confirmed = confirm('Are you sure you want to save the changes?');
            if (!confirmed) {
                return;
            }

            var tables = document.querySelectorAll('.operator-categories table');
            var data = {};
            tables.forEach(function(table) {
                var field = table.querySelector('th').textContent.toLowerCase();
                data[field] = [];
                var tds = table.querySelectorAll('td');
                tds.forEach(function(td) {
                    data[field].push(td.textContent);
                });
            });

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/../actions/update-categories.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Changes saved successfully!');
                } else {
                    console.error('Failed to save changes:', xhr.responseText);
                    alert('Failed to save changes!');
                }
             };
            xhr.send(JSON.stringify(data));
        });
    };
});