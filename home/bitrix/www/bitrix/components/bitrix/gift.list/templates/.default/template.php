<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\UI\Extension::load("ui.vue3");
?>
<link rel="stylesheet" href="/bitrix/fonts/fonts.css" />
<link rel="stylesheet" href="<?= CUtil::GetAdditionalFileURL($templateFolder . "/style.css"); ?>" />
<div id="app"></div>
<script type="text/javascript">
    BX.Vue3.BitrixVue.createApp({
        data() {
            return {
                bannerData: <?= json_encode($arResult['BANNER']) ?>,
                isPopupOpen: false,
            }
        },
        methods: {
            openPopup() {
                this.isPopupOpen = true;
            },
            closePopup() {
                this.isPopupOpen = false;
            },
        },
        mounted() {
            setTimeout(() => {
                this.openPopup();
            }, 3000);
        },
        template: `
        <transition name="popup" appear>
            <div class="banner-overlay" v-if="isPopupOpen">
                <div class="banner-container" @click.self="closePopup()">
                    <div class="banner-popup">
                        <div class="banner-popup__close" @click.self="closePopup()">
                            <span class="banner-popup__close-line"></span>
                            <span class="banner-popup__close-line"></span>
                        </div>
                        <span class="banner-popup__label">new beauty box</span>
                        <picture class="banner-popup__img">
                            <source media="(min-width:768px)" :srcset="bannerData.DESKTOP_BANNER_SRC">
                            <img :src="bannerData.MOBILE_BANNER_SRC" alt="">
                        </picture>
                        <div class="banner-popup__info">
                            <h4 class="banner-popup__title">{{bannerData.TITLE}}</h4>
                            <p class="banner-popup__description">{{bannerData.DESCRIPTION}}</p>
                            <div class="banner-popup__product">
                                <span class="banner-popup__gift-price">{{bannerData.GIFT_PRICE}} ₽</span>
                                <span class="banner-popup__price">{{bannerData.PRICE}} ₽</span>
                                <span class="banner-popup__volume">{{bannerData.PRODUCT_VOLUME}}</span>
                            </div>
                            <div class="banner-popup__payment">
                                <a class="banner-popup__payment-link" href="#">Оплатить при получении</a>
                                <a class="banner-popup__payment-link" href="#">Оплатить сейчас</a>
                                <div class="banner-popup__payment-icons">
                                    <span class="visa"></span>
                                    <span class="master-card"></span>
                                    <span class="apple-pay"></span>
                                    <span class="google-pay"></span>
                                    <span class="mir"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
		`
    }).mount('#app');
</script>
