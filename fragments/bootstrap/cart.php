<section class="h-100 gradient-custom">
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0"><?php echo $this->i18n('cart') ?> - 2 <?php echo $this->i18n('items') ?></h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($this->getVar('objects') as $object) : ?>
                            <?php
                            $fragment = new rex_fragment();
                            $fragment->setVar('picture', $object['picture']);
                            $fragment->setVar('label', $object['label']);
                            $fragment->setVar('description', $object['description']);
                            $fragment->setVar('price', $object['price']);
                            $fragment->setVar('id', $object['id']);
                            $fragment->setVar('count', $object['count']);
                            $fragment->setVar('button_text', $object['button_text']);
                            echo $fragment->parse('/bootstrap/cart_object.php');
                            ?>
                            <hr class="my-4"/>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong><?php echo $this->i18n('expected_delivery') ?></strong></p>
                        <p class="mb-0">12.10.2020 - 14.10.2020</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body">
                        <p><strong><?php echo $this->i18n('we_accept') ?></strong></p>
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                             alt="Visa"/>
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                             alt="American Express"/>
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                             alt="Mastercard"/>
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
                             alt="PayPal acceptance mark"/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0"><?php echo $this->getVar('sum_text') ?></h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                <?php echo $this->i18n('products') ?>
                                <span><?php echo $this->getVar('sum') ?> €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <?php echo $this->i18n('shipping') ?>
                                <span>Gratis</span>
                            </li>
                            <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong><?php echo $this->i18n('total') ?></strong>
                                    <strong>
                                        <p class="mb-0">(<?php echo $this->i18n('including_vat') ?>)</p>
                                    </strong>
                                </div>
                                <span><strong><?php echo $this->getVar('sum') ?> €</strong></span>
                            </li>
                        </ul>

                        <a href="<?php echo rex_flexshop_cart::getCheckoutUrl() ?>"
                           class="btn btn-primary btn-lg btn-block">
                            <?php echo $this->i18n('cta_checkout') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>