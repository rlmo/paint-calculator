<template>
    <div id="room" class="float-container">
        <div class="float-child">
            <h3>PAREDE 1</h3>
            <div>
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall1.width" ref="width" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall1.height" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall1.doors" type="number" step="1" min="0" default="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall1.windows" type="number" step="1" min="0" default="0" size="5" required><br>
            </div>
        </div>
        <div class="float-child">
            <h3>PAREDE 2</h3>
            <div>
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall2.width" ref="width" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall2.height" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall2.doors" type="number" step="1" min="0" default="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall2.windows" type="number" step="1" min="0" default="0" size="5" required><br>
            </div>
        </div>
        <div class="float-child">
            <h3>PAREDE 3</h3>
            <div>
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall3.width" ref="width" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall3.height" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall3.doors" type="number" step="1" min="0" default="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall3.windows" type="number" step="1" min="0" default="0" size="5" required><br>
            </div>
        </div>
        <div class="float-child">
            <h3>PAREDE 4</h3>
            <div>
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall4.width" ref="width" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall4.height" type="number" step="0.5" min="0" default="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall4.doors" type="number" step="1" min="0" default="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall4.windows" type="number" step="1" min="0" default="0" size="5" required><br>
            </div>
        </div>
        <button @click="submit">Calcular</button>
    </div>
    <div>
        Dados: {{ walls }}
    </div><br>
    <div>
        Response: {{ response }}
    </div>
</template>

<!--<template>
    <div id="room" class="float-container">
        <Wall class="float-child" ref="wall1" wallNumber="1"/>
        <Wall class="float-child" ref="wall2" wallNumber="2"/>
        <Wall class="float-child" ref="wall3" wallNumber="3"/>
        <Wall class="float-child" ref="wall4" wallNumber="4"/>
        <button @click="submit">Calcular</button>
    </div>
</template>-->

<script lang="ts">
import Wall from "./Wall.vue"
import axios from "axios"

const ENDPOINT = import.meta.env.VITE_API_ENDPOINT

export default {
    data() {
        return {
            walls: {
                wall1: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0
                },
                wall2: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0
                },
                wall3: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0
                },
                wall4: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0
                },
            },
            response: {}
        }
    },
    methods: {
        submit() {
            console.log(JSON.stringify(this.walls))
            axios
                .post(ENDPOINT + "/paintTest", this.walls)
                .then(response => this.response = response.data)
        }
    },
    components: {
        Wall
    }
}
</script>

<style scoped>
.float-container {
    border: 3px solid #fff;
    padding: 10px;
    width: 100%;
}

.float-child {
    width: 25%;
    float: left;
    padding: 10px;
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