if (document.getElementById('edit-profile')) {
    document.getElementById('edit-profile').addEventListener('click', function() {
        window.location.href = '../pages/profile.php?edit=true';
    });


    document.getElementById('change-username').addEventListener('click', function() {
        window.location.href = '../pages/profile.php?edit=true&username=true';
    });

    document.getElementById('change-email').addEventListener('click', function() {
        window.location.href = '../pages/profile.php?edit=true&username=true';
    });

    document.getElementById('change-password').addEventListener('click', function() {
        window.location.href = '../pages/profile.php?edit=true&username=true';
    });

}

document.querySelectorAll('.print-screen').forEach(function(screen) {
    let button = screen.querySelector('.print-button');
    button.addEventListener('click', function() {
        let sale = this.dataset.sale;

        let [phone, price] = sale.split('/');

        let buyer = this.dataset.buyer;
        let seller = this.dataset.seller;

        let data = new URLSearchParams();
        data.append('phone', phone);
        data.append('price', price);
        data.append('buyer', buyer);
        data.append('seller', seller);

        fetch('/../actions/generate_receipt.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: data,
        })
        .then(response => {
            console.log(response);
            return response.text();
        })
        .then(receipt => {
            let printWindow = window.open('', '_blank');

            let css = `.profile {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                height: 100vh; 
                margin-top: -100px;
            }
            
            .profile-title {
                margin-bottom: 20px;
                font-size: 30px;
                font-weight: bold;
                font-weight: bold;
                text-align: center;
                margin-bottom: 40px;
            }
            
            .profile-content, .profile-changes, .username-changes, .email-changes, .password-changes {
                border: 1px solid #000000;
                padding: 20px;
                border-radius: 10px;
                width: 80%;
                max-width: 800px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            
            }
            
            .profile-changes{
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .profile-content h2{
                padding: 10px;
            }
            
            .profile-info p{
                margin-bottom: 10px;
            }
            
            .profile-orders ul, .profile-breakdowns ul {
                list-style-position: inside;
            }
            
            .profile-orders ul li, .profile-breakdowns ul li{
                margin-bottom: 10px;
            }
            
            .edit-profile{
                margin-top: 10px;
                margin-left: 10px;
                background-color: #333;
                color: #fff;
                border: none;
                padding: 10px 10px;
                cursor: pointer;
                border-radius: 5px;
            }
            
            #change-username, #change-email, #change-password{
                margin-top: 10px;
                margin-left: 10px;
                margin-bottom: 10px;
                background-color: #fff;
                color: #333;
                border: 1px solid #333;
                padding: 10px 10px;
                cursor: pointer;
                border-radius: 5px;
                width: 100%;
                box-sizing: border-box; 
                text-align: center;
            }
            
            .product_name{
                text-decoration: none;
                color: rgb(0, 83, 138);
            }`;
            printWindow.document.write('<style>' + css + '</style>');
            printWindow.document.write(receipt);
            printWindow.document.close();
            printWindow.print();
        });
    });
});
