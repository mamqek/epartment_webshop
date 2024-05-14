<template>
    <div
        v-if="loaded"
        id="cart-layout"
    >
        <h1 v-if="cart_items.length > 0">Thank you for your order</h1>
        <h1 v-else>Cart is empty</h1>
        <ItemInCart
            v-for="cart_item in cart_items"
            :key="cart_item.id"
            :cart_item="cart_item"
            @remove-item="removeFromCart"
        />
        <h2 v-if="cart_items.length > 0">Total: <span class="highlight">{{
            formatPrice(total) }}</span></h2>
    </div>
</template>

<script>
import { $axios } from '@/axios.js';
import ItemInCart from '@/components/ItemInCart.vue';

export default {

    name: "CartPage",
    data() {
        return {
            total: 0,
            cart_items: [],
            loaded: false
        }
    },

    created() {
        $axios.get(`carts`)
            .then(({ data }) => {
                console.log(data);
                this.cart_items = data.cart_items;
                this.total = data.total;
                this.loaded = true;
            })
    },

    components: {
        ItemInCart
    },

    methods: {
        removeFromCart(id) {
            $axios.delete(`carts/${id}`)
                .then(({ data }) => {
                    if (data) {
                        console.log(data);
                        this.cart_items = this.cart_items.map(cart_item => {
                            if (cart_item.id === id) {
                                cart_item.quantity = data.quantity;
                            }
                            return cart_item;
                        });
                    } else {
                        this.cart_items = this.cart_items.filter(cart_item => cart_item.id !== id);
                    }
                })
        },

        formatPrice(price) {
            if (!price) return '';
            return '€ ' + price.toLocaleString('nl-NL', { minimumFractionDigits: 2 });
        }
    }
}
</script>

<style scoped>
#cart-layout {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 50px;
}
</style>