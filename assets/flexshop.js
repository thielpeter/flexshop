const ready = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
};

ready(() => {
    document.querySelector('.flexshop-object-link').addEventListener("click", (e) => {
        fetch("index.php?rex-api-call=flexshop&id=" + e.target.dataset.id)
            .then(response => response.text())
            .then(data => {
                document.querySelector('.flexshop-cart-count').textContent = data;
            }).catch(error => {
            // Handle error
        });
    });
});

