<template>
    <div
        v-if="loaded"
        id="item-layout"
    >
        <img
            :src="item.image"
            alt="Item"
        />
        <div id="text-column">
            <h1>{{ item.name }}</h1>
            <h4 class="faded">Sku: {{ sku.number }}</h4>
            <p>{{ item.description }}</p>
            <div id="prices">
                <div id="from">
                    <h5>From</h5>
                    <div>
                        <p class="faded"> {{ formatPrice(sku.price_from + (extra_option ? item.extra_option : 0)) }} </p>
                    </div>
                </div>
                <div id="your-price">
                    <h5>Your price</h5>
                    <div>
                        <p class="highlight"> {{ formatPrice(sku.price_your + (extra_option ? item.extra_option : 0)) }} </p>
                    </div>
                </div>
            </div>
            <div id="options">
                <OptionsDropdown
                    v-model="selectedColor"
                    :items="uniqueColor"
                    name="Color"
                />
                <OptionsDropdown
                    v-model="selectedSize"
                    :items="uniqueSize"
                    name="Size"
                />
                <OptionsDropdown
                    v-model="selectedPaddles"
                    :items="uniquePaddles"
                    name="Size"
                />
            </div>
            <div id="extra-option">
                <input
                    type="checkbox"
                    id="checkbox"
                    v-model="extra_option"
                >
                <h4>Extra option + {{ item.extra_option }}</h4>
            </div>
            <button
                id="add-to-cart"
                :disabled="!sku"
                @click="addToCart"
                :title="!sku ? 'Choose options first' : 'Add to cart'"
            > <i class="fas fa-shopping-cart"></i> Order now</button>


        </div>
    </div>
</template>


<script>
import { $axios } from '@/axios.js';
import OptionsDropdown from '@/components/OptionsDropdown.vue';

export default {
    name: "ItemPage",

    data() {
        return {
            item: {},
            selectedColor: '',
            selectedSize: '',
            selectedPaddles: '',
            loaded: false,
            extra_option: false,
        }
    },

    created() {
        const itemId = this.$route.params.id;
        $axios.get(`items/${itemId}`)
            .then(({ data }) => {
                console.log(data);
                this.item = data;
                this.loaded = true;
            })
    },

    computed: {

        uniqueColor() {
            if (!this.loaded) return [];
            return [...new Set(this.item.skus.map(sku => sku.color))];
        },
        uniqueSize() {
            if (!this.loaded) return [];
            return [...new Set(this.item.skus.map(sku => sku.size))];
        },
        uniquePaddles() {
            if (!this.loaded) return [];
            return [...new Set(this.item.skus.map(sku => sku.paddles))];
        },
        sku() {
            if (!this.loaded) return [];
            let color = this.selectedColor;
            let size = this.selectedSize;
            let paddles = this.selectedPaddles;
            // check if color, size or paddles are not selected, if so set them to the first option
            if (!color) {
                color = this.uniqueColor[0];
            }
            if (!size) {
                size = this.uniqueSize[0];
            }
            if (!paddles) {
                paddles = this.uniquePaddles[0];
            }
            return this.item.skus.find(sku => sku.color === color && sku.size === size && sku.paddles === paddles);
        }
    },

    components: {
        OptionsDropdown
    },

    methods: {
        addToCart() {
            $axios.post(`/carts`, { sku_id: this.sku.id, extra_option: this.extra_option })
                .then(({ data }) => {
                    console.log(data);
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
#item-layout {
    display: flex;
    align-items: flex-start;
    background-color: #363636;
    gap: 111px;


    img {
        width: 511px;
        height: 437px;
    }

    #text-column {
        display: flex;
        flex-direction: column;
        gap: 24px;


        #prices {
            display: flex;
            text-transform: uppercase;
            gap: 51px;
            height: 46px;

            #from,
            #your-price {
                display: flex;
                justify-content: space-between;
                flex-direction: column;
            }

            #from {
                p {
                    text-decoration: line-through;
                }
            }

        }

        #options {
            display: flex;
            flex-direction: column;
            gap: 16px;

            .select-wrapper {
                position: relative;
                display: inline-block;

                .select-label {
                    position: absolute;
                    left: 20px;
                    /* Adjust this value to position the label */
                    top: 12px;
                    /* Adjust this value to position the label */
                    pointer-events: none;
                    color: #000000;
                    /* Change this to the color you want */
                }

                .select-options {
                    width: 400px;
                    background-color: #727272;
                    color: #000000;
                    border: 1px solid #000000;
                    border-radius: 4px;
                    padding: 0 20px 0 16px;

                    appearance: none;
                    /* Remove default select dropdown arrow */
                    -webkit-appearance: none;
                    /* For Safari */
                    -moz-appearance: none;
                    /* For Firefox */
                }

                .fa-chevron-down {
                    color: #000000;
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    pointer-events: none;
                    /* Ignore clicks on the icon */
                    transform: translateY(-50%);
                    /* Center the icon vertically */
                }
            }
        }

        #extra-option {
            display: flex;
            gap: 16px;
            align-items: center;

            #checkbox {
                width: 18px;
                height: 18px;
            }
        }

        #add-to-cart {
            width: 288px;
            margin-top: 22px;
            background-color: #FFA800;
            color: #000000;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 700;
        }

        #add-to-cart:disabled {
            background-color: #724d04;
            cursor: not-allowed;
        }

    }

}
</style>