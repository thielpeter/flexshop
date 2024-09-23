const ready = (callback) => {
	if (document.readyState !== "loading") callback();
	else document.addEventListener("DOMContentLoaded", callback);
};

var flexshop = {

	init: function()
	{
		this.initActions();
	},

	initActions: function() {
		document.querySelector('.flexshop-object-link') != null && document.querySelector('.flexshop-object-link').addEventListener("click", (e) => {
			fetch("index.php?rex-api-call=flexshop&func=add&id=" + e.target.dataset.id)
				.then(response => response.text())
				.then(data => {
					document.querySelector('.flexshop-cart-count').textContent = data;
				}).catch(error => {
				// Handle error
			});
		});

		document.querySelector('.flexshop-object-remove') != null && document.querySelector('.flexshop-object-remove').addEventListener("click", (e) => {
			fetch("index.php?rex-api-call=flexshop&func=remove&id=" + e.target.dataset.id)
				.then(response => response.text())
				.then(data => {
					document.querySelector('.flexshop-cart-count').textContent = data;
				}).catch(error => {
				// Handle error
			});
		});

		document.querySelectorAll('.flexshop-object-add') != null && document.querySelectorAll('.flexshop-object-add').forEach((button) => {
			button.addEventListener("click", (e) => {

				const parentContainer = button.parentElement;
				const input = parentContainer.querySelector('.flexshop-object-quantity');
				const quantityValue = input ? input.value : 1;

				fetch("index.php?rex-api-call=flexshop&func=add&id=" + e.target.dataset.id + "quantity=" + quantityValue)
					.then(response => response.text())
					.then(data => {
						flexshop.showNotification();
						flexshop.refreshCartLight();
					}).catch(error => {
					// Handle error
				});
			});
		});
	},

	refreshCartLight: function() {

		fetch("index.php?rex-api-call=flexshop&func=get_quantity")
			.then(response => response.text())
			.then(data => {
				document.querySelector('.flexshop-cart-count').textContent = data;
			}).catch(error => {
			// Handle error
		});
	},

	showNotification: function() {

		let el = document.querySelectorAll('.flexshop-add-success')[0];
		el.classList.add('is-active');

		setTimeout(function(){
			el.classList.remove('is-active');
		}, 5000)
	},
};

ready(() => {
	flexshop.init();
});


