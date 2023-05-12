<template>
    <div>
        <h3>PAREDE {{ wallNumber }}</h3>
        <div>
            <label for="width">Largura (em metros): </label>
            <input v-model="wall.width" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            <label for="height">Altura (em metros): </label>
            <input v-model="wall.height" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            <label for="door">Número de portas: </label>
            <input v-model="wall.doors" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            <label for="window">Número de janelas: </label>
            <input v-model="wall.windows" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    props: ["wallNumber"],
    data() {
        return {
            wall: {
                width: 0,
                height: 0,
                doors: 0,
                windows: 0,
            }
        }
    },
}
</script>

<style scoped>
div {
  align-items: center;
}

input[type='number'] {
    width: 80px;
}

label{
    display: inline-block;
    width: 200px;
}
</style>