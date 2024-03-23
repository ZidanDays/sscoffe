checkoutButton.addEventListener('click', async function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const data = new URLSearchParams(formData);
    const objData = Object.formEntries(data);

    try{
        const response = await fetch ('php/placeOrder.php', {
            method : 'POST',
            body : data,
        });
        const token = await response.text();
        // console.log(token);
        window.snap.pay(token);
    }catch (err) {
        console.log(err.message)
    }
});