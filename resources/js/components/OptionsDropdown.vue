<template>
    <div>
    <div class="select-wrapper">
        <label
            v-if="!modelValue"
            class="select-label"
        >{{ name }}</label>

        <select
            class="select-options"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :name
        >
            <option
                v-for="item in items"
                :value="item"
            >{{ item }}</option>
        </select>
        <i class="fas fa-chevron-down"></i>
    </div>
</div>
</template>

<script>
export default {
    props: ['modelValue', 'items', 'name'],
}


</script>


<style scoped>
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
</style>