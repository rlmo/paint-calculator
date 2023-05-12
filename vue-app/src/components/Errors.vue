<template>
    <h3>
        Erros:
    </h3>
    <div>
        <li v-for="error in errorMessages">{{ error }}</li>
    </div>
</template>

<script lang="ts">
    export default {
        props: [
                "errorMessages",
        ],
    }
</script>

<style scoped>
h3 {
    padding: 30px 30px 5px 30px;
}

div {
    padding: 5px 30px 30px 30px;
    font-style: color red;
    font-weight: bold;
}
</style>