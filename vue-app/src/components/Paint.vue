<template>
    <center class="results">
        <h3>
            Resultados:
        </h3>
        <div v-if="paintArea">
            <p>Área a ser pintada: {{ paintArea }}m&sup2;</p>
            <p>Total de tinta: {{ litersNeeded }}L</p>
            <p>Latas de tinta: {{ createCansMsg() }}</p>
        </div>
    </center>
</template>

<script lang="ts">
    export default {
        data() {
            return {
                paintCansMsg: ""
            }
        },
        props: [
            "paintArea",
            "litersNeeded",
            "paintCans",
        ],
        methods: {
            createCansMsg(): String {
                this.paintCansMsg =''
                for(var key in this.paintCans) {
                    this.paintCans[key] > 0 ?
                    this.paintCansMsg += this.paintCans[key] + " lata(s) de " + key + "L, " :
                    '';
                }
                this.paintCansMsg = this.paintCansMsg.slice(0, -2).replaceAll(".", ",")
                
                return this.paintCansMsg
            }
        },
    }
</script>

<style scoped>
h3 {
    padding: 30px 30px 5px 30px;
}

div {
    padding: 5px 30px 30px 30px;
}

.results {
    align-items: center;
    border: 1px solid black;
    background-color: white;
    border-radius: 20px;
    text-align: center;
    padding: 3px;
}
</style>