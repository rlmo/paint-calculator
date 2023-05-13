<template>
    <form @submit="sendForm()">

        <input v-model="walls[0].width" type="text">
        {{ sendForm() }}
    </form>
</template>

<script lang="ts">
import axios from "axios"

const ENDPOINT = import.meta.env.VITE_API_ENDPOINT

export default {
    data() {
        return {
            errors: [],
            walls: [{
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
                {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
                {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
                {
                    width: 0,
                    height: 0,
                    doors: 0,
                    windows: 0,
                },
            ]
        }
    },
    methods: {
        sendForm() {
            let wallNumber = 0;

            this.walls.forEach(wall => {
                wallNumber++;
                let totalArea = wall.width * wall.height

                if(totalArea < 1) {

                }
            });
        },
        async getDoorDimensions() {
            let doorDimensions = []

            try {
                await axios
                    .get(ENDPOINT + "/door/info")
                    .then(response => doorDimensions = response.data)
            } catch (error) {
                console.log("Erro ao consultar dimensões da porta: " + error)
            }
        },
        async getWindowDimensions() {
            let windowDimensions = []

            try {
                await axios
                    .get(ENDPOINT + "/window/info")
                    .then(response => windowDimensions = response.data)
            } catch (error) {
                console.log("Erro ao consultar dimensões da janela: " + error)
            }
        }
    }
}
</script>