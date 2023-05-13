<template>
    <div id="room" class="float-container">
        <div class="float-child">
            <h2>PAREDE 1</h2>
            <div class="wall-data">
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall1.width" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall1.height" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall1.doors" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall1.windows" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            </div>
        </div>
        <div class="float-child">
            <h2>PAREDE 2</h2>
            <div class="wall-data">
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall2.width" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall2.height" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall2.doors" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall2.windows" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            </div>
        </div>
        <div class="float-child">
            <h2>PAREDE 3</h2>
            <div class="wall-data">
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall3.width" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall3.height" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall3.doors" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall3.windows" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            </div>
        </div>
        <div class="float-child">
            <h2>PAREDE 4</h2>
            <div class="wall-data">
                <label for="width">Largura (em metros): </label>
                <input v-model="walls.wall4.width" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="height">Altura (em metros): </label>
                <input v-model="walls.wall4.height" type="number" step="0.5" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="door">Número de portas: </label>
                <input v-model="walls.wall4.doors" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
                <label for="window">Número de janelas: </label>
                <input v-model="walls.wall4.windows" type="number" step="1" min="0" default="0" onfocus="this.value=''" placeholder="0" size="5" required><br>
            </div>
        </div>
            <button class="button" @click="submit">Calcular</button>
        <br>
        <div v-if="response.paintArea && !response.errors">
            <Paint :paintArea="response.paintArea" :litersNeeded="response.litersNeeded" :paintCans="response.paintCans" />
        </div>
        <div v-else-if="response.errors">
            <Errors :errorMessages="response.errorMessages" />
        </div>
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
import axios from "axios"
import Paint from "./Paint.vue"
import Errors from "./Errors.vue"

const ENDPOINT = import.meta.env.VITE_API_ENDPOINT

export default {
    data() {
        return {
            walls: {
                wall1: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
                wall2: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
                wall3: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
                wall4: {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
            },
            response: {
                errors: false,
                errorMessages: [],
                paintArea: 0,
                litersNeeded: 0,
                paintCans: 0,
            },
        }
    },
    methods: {
        async submit() {
            try {
                await axios
                    .post(ENDPOINT + "/paintWalls", this.walls)
                    .then(response => this.response = response.data)
            } catch (error) {
                if(error.response.data[0]) {
                    this.response.errorMessages =[]
                    this.response.errors = true
                    error.response.data.shift()
                    error.response.data.forEach(errorMessage => {
                        if(errorMessage.errors) {
                            this.response.errorMessages.push(errorMessage.errorMessages[0])
                            console.log(errorMessage)
                        }
                    })
                } else {
                    console.log("Erro: " + error)
                }
            }
        }
    },
    components: {
        Paint,
        Errors,
    },
}
</script>

<style scoped>
.float-container {
    padding: 10px;
    width: 100%;
}

.float-child {
    align-items: center;
    border: 1px solid black;
    background-color: white;
    border-radius: 20px;
    float: left;
    padding: 10px;
    width: 25%;
}

.wall-data {
    text-align: center;
}

.button {
    background: linear-gradient(90deg, #616FFF 0%, #B4BDEF 100%);
    border: 1px solid black;
    border-radius: 20px;
    color: white;
    padding: 15px 32px;
    text-align: center;
    display: inline-block;
    margin: 20px;
    font-size: 18px;
    left: 45%;
}

.button:hover {
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);
}

.button:active {
    filter: brightness(60%);
}

input[type='number'] {
    width: 80px;
}

label{
    display: inline-block;
    width: 200px;
}

h2 {
    text-align: center;
    text-decoration: underline;
}
</style>