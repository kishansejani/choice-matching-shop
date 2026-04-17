<?php
session_start();
include_once 'header.php';
?>

<!-- Title Page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg'); background-attachment: fixed;">
    <h2 class="ltext-105 cl0 txt-center" style="color: #fff !important; text-shadow: 0 5px 15px rgba(0,0,0,0.2); font-weight: 800; font-size: 50px;">
        My Wishlist
    </h2>
</section>

<!-- Wishlist Grid -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div id="wishlist-container" class="row isotope-grid" style="min-height: 400px;">
            <!-- Items will be loaded here via JS -->
            <div class="col-12 text-center p-t-100 p-b-100" id="empty-wishlist" style="display:none;">
                <i class="zmdi zmdi-favorite-outline" style="font-size: 100px; color: var(--accent-color); margin-bottom: 25px; display: block; opacity: 0.6;"></i>
                <h4 class="mtext-105 p-b-30" style="color: var(--primary-color); font-weight: 800; font-size: 26px;">Your dream list is currently empty</h4>
                <a href="product.php" class="flex-c-m stext-101 cl0 size-116 bg1 bor14 hov-btn1 p-lr-15 trans-04" style="max-width: 240px; margin: 0 auto; background-color: var(--primary-color) !important; border-radius: 30px;">
                    Explore Collections
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        renderWishlist();
    });

    function getWishlist() {
        return JSON.parse(localStorage.getItem('wishlist')) || [];
    }

    function removeFromWishlist(id) {
        let wishlist = getWishlist();
        wishlist = wishlist.filter(item => item.id != id);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        renderWishlist();
    }

    function renderWishlist() {
        const wishlist = getWishlist();
        const container = document.getElementById('wishlist-container');
        const emptyMsg = document.getElementById('empty-wishlist');
        
        // Clear container except for the empty message
        const existingItems = container.querySelectorAll('.wishlist-item');
        existingItems.forEach(item => item.remove());

        if (wishlist.length === 0) {
            emptyMsg.style.display = 'block';
            return;
        }

        emptyMsg.style.display = 'none';

        wishlist.forEach(product => {
            const itemHtml = `
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item wishlist-item">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="${product.image}" alt="IMG-PRODUCT">
                            <a href="javascript:void(0)" onclick="removeFromWishlist('${product.id}')" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" style="bottom: 10px;">
                                Remove
                            </a>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a href="product-detail.php?detail_id=${product.id}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    ${product.name}
                                </a>
                                <span class="stext-105 cl3">
                                    Rs. ${product.price}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', itemHtml);
        });
    }
</script>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
