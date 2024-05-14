<template>
    
    <div class="item-container">
        <h2 class="item-quantity">{{ cart_item.quantity }}X</h2>
        <img :src="item.image" alt="item image">
        <div class="item-text">
            <div class="item-info">
                <h4>{{ item.name }}</h4>
                <h4 class="faded">Sku: {{ sku.number }}</h4>
            </div>
            <div class="item-price">
                <p class="highlight">{{ formatPrice(item_price) }} <span v-if="cart_item.extra_option" class="faded">(with extra option)</span> </p>
            </div>
        </div>
        <button class="delete-item" @click="$emit('remove-item', cart_item.id);">
            <i class="fas fa-trash"></i>
        </button>
    </div>

</template>


<script>
export default {
    name: "ItemInCart",

    data() {
        return {
        }
    },

    computed: {
        sku() {
            return this.cart_item.sku;
        },
        item() {
            return this.cart_item.sku.item;
        }, 
        item_price() {
            return this.sku.price_your + (this.cart_item.extra_option ? this.item.extra_option : 0)
        }

    },

    props: {
        cart_item: {
            type: Object,
            required: true
        }
    },

    methods: {
        formatPrice(price) {
            if (!price) return '';
            return '€ ' + price.toLocaleString('nl-NL', { minimumFractionDigits: 2 });
        }
    }

}
</script>


<style scoped>
.item-container {
    display: flex;
    margin-top: 20px;
    align-items: center;
    gap: 54px;

    .item-quantity {
        width: 50px;
        text-align: right;
        margin-right: 5px;
    }

    img {
        width: 122px;
        height: 104px;
    }

    .item-text {
        display: flex;
        flex-direction: column;
        gap: 16px;

        .item-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

    }

    .delete-item {
        background-color: transparent;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }


}
</style>