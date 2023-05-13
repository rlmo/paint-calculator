<template>
    <center>
        <h3>
            Preencha as informa&ccedil;&otilde;es das 4 paredes abaixo para descobrir o quanto de tinta será gasto na pintura da sala.
        </h3>
    </center>
    <div class="float">
        <div class="info">
            Informa&ccedil;&otilde;es:
            <ul>
                <li v-for="i in info">{{ i }}</li>
            </ul>
        </div>
        <div class="rules">
            Regras:
            <ul>
                <li v-for="rule in rules">{{ rule }}</li>
            </ul>
        </div>
    </div>
</template>

<script lang="ts">
import axios from "axios"
const ENDPOINT = import.meta.env.VITE_API_ENDPOINT

export default {
    data() {
        return {
            info: [''],
            rules: [''],
        }
    },
    mounted() {
        this.info.splice(0)
        this.rules.splice(0)
        this.getDoorInfo()
        this.getWindowInfo()
        this.getPaintCanInfo()
        this.getWallRules()
    },
    methods: {
        async getDoorInfo() {
            let doorInfo: string[] = []

            try {
                await axios
                    .get(ENDPOINT + "/door/info")
                    .then(response => doorInfo = response.data)
            } catch (error) {
                console.log("Erro ao consultar dados da porta: " + error)
            }

            this.info.push("Dimensões da porta: " + doorInfo.width + "m x " + doorInfo.height + "m.")

            doorInfo.rules.forEach(rule => {
                this.rules.push(rule.description)
            })
        },
        async getWindowInfo() {
            let windowInfo: string[] = []

            try {
                await axios
                    .get(ENDPOINT + "/window/info")
                    .then(response => windowInfo = response.data)
            } catch (error) {
                console.log("Erro ao consultar dados da janela: " + error)
            }

            this.info.push("Dimensões da janela: " + windowInfo.width + "m x " + windowInfo.height + "m.")

            windowInfo.rules.forEach(rule => {
                this.rules.push(rule.description)
            })
        },
        async getPaintCanInfo() {
            let paintCanInfo: string[] = []
            let paintCanSizes = ''

            try {
                await axios
                    .get(ENDPOINT + "/paint-can/info")
                    .then(response => paintCanInfo = response.data)
            } catch (error) {
                console.log("Erro ao consultar dados das latas de tinta: " + error)
            }

            paintCanInfo.sizes.forEach(size => {
                paintCanSizes += size + "L, "
            })
            paintCanSizes = paintCanSizes.slice(0, -2).replaceAll(".", ",")

            this.info.push("Latas de tinta: " + paintCanSizes + ".", "Cada litro de tinta pode pintar " + paintCanInfo.metersPerLiter + " metros quadrados.")
        },
        async getWallRules() {
            let wallRules: string[] = []

            try {
                await axios
                    .get(ENDPOINT + "/wall/rules")
                    .then(response => wallRules = response.data)
            } catch (error) {
                console.log("Erro ao consultar dados da porta: " + error)
            }

            wallRules.forEach(rule => {
                this.rules.push(rule.description)
            })
        },
    }
}
</script>

<style scoped>
.float {
    padding: 30px;
}

</style>