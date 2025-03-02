<script>
    $(document).ready(function () {
        var cookieKey = `bag`;
        var bag = getBagFromCookies();
        var rate = {{ $rate }};

        updateBagUI();

        $(".product-item").on("click", function () {
            var name = $(this).data("name");
            var price = parseFloat($(this).data("price"));
            var description = $(this).data("description");
            var image = $(this).data("image");

            $("#productModalLabel").text(name);
            $("#productModalPrice").text(`$${price.toFixed(2)}`);
            $("#productModalPriceLBP").text(`${(price * rate).toLocaleString()}LBP`);
            $("#productModalDescription").text(description);
            $("#productModalImage").attr("src", image);
            $("#productModalQuantity").val(1);

            var productModal = new bootstrap.Modal(document.getElementById('productModal'));
            productModal.show();
        });

        $("#addToBagBtn").on("click", function () {
            var name = $("#productModalLabel").text();
            var price = parseFloat($("#productModalPrice").text().replace('$', ''));
            var quantity = parseInt($("#productModalQuantity").val());
            var image = $("#productModalImage").attr("src");

            var existingItem = bag.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                bag.push({ name, price, quantity, image });
            }

            saveBagToCookies();
            updateBagUI();

            $('#productModal').fadeOut();
            $('.modal-backdrop').fadeOut();
            $('.modal-open').css({'overflow': 'visible'});

            setTimeout(animateBagIcon, 500);
        });

        function updateBagUI() {
            var bagContainer = $("#bagItems");
            var bagTotal = 0;
            var totalCount = 0;
            bagContainer.empty();

            if (bag.length === 0) {
                bagContainer.append('<p class="text-center text-muted">Your bag is empty.</p>');
            } else {
                bag.forEach((item, index) => {
                    var itemTotal = item.price * item.quantity;
                    bagTotal += itemTotal;
                    totalCount += item.quantity;

                    bagContainer.append(`
                        <div class="bag-item d-flex align-items-center justify-content-between p-2 border-bottom">
                            <img src="${item.image}" alt="${item.name}" class="rounded" width="50">
                            <div class="item-info">
                                <h6 class="mb-0">${item.name}</h6>
                                <small>$${item.price.toFixed(2)}</small>
                            </div>
                            <div class="item-controls d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-primary decrease-qty" data-index="${index}">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-primary increase-qty" data-index="${index}">+</button>
                                <button class="btn btn-sm btn-outline-danger remove-item ms-2" data-index="${index}">&times;</button>
                            </div>
                        </div>
                    `);
                });
            }

            $("#bagTotal").text(`$${bagTotal.toFixed(2)}`);
            $("#bagTotalLBP").text(`${(bagTotal * rate).toLocaleString()}LBP`);
            $("#bagCount").text(totalCount).toggle(totalCount > 0);
        }

        function animateBagIcon() {
            var bagIcon = $("#bagBtn i");

            bagIcon.addClass("animate-bag");
            setTimeout(() => {
                bagIcon.removeClass("animate-bag");
            }, 500);
        }

        $(document).on("click", ".increase-qty", function () {
            var index = $(this).data("index");
            bag[index].quantity += 1;
            saveBagToCookies();
            updateBagUI();
        });

        $(document).on("click", ".decrease-qty", function () {
            var index = $(this).data("index");
            if (bag[index].quantity > 1) {
                bag[index].quantity -= 1;
            } else {
                bag.splice(index, 1);
            }
            saveBagToCookies();
            updateBagUI();
        });

        $(document).on("click", ".remove-item", function () {
            var index = $(this).data("index");
            bag.splice(index, 1);
            saveBagToCookies();
            updateBagUI();
        });

        function saveBagToCookies() {
            const expires = new Date();
            expires.setDate(expires.getDate() + 7);
            document.cookie = `${cookieKey}=${JSON.stringify(bag)}; `
                + `path=/; `
                + `expires=${expires.toUTCString()}; `
                + `samesite=lax`;
        }

        function getBagFromCookies() {
            try {
                const match = document.cookie.match(new RegExp(`(?:^| )${cookieKey}=([^;]+)`));
                return match ? JSON.parse(decodeURIComponent(match[1])) : [];
            } catch (e) {
                console.error('Error parsing bag data:', e);
                return [];
            }
        }
    });
</script>