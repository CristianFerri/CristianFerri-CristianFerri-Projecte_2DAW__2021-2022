<template>
    <div class="container">
        <div class="peli">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4 cine-mainInfo-img">
                        <img class="img-fluid rounded-start" :src="peliObj.poster" :alt="peliObj.title" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="cine-mainInfo-title card-title">{{ peliObj.title }}</h1>
                            <p class="cine-mainInfo-overview card-text">{{ acortarOverview(peliObj.overview) }}</p>
                            <h3>{{ day }} a las <span class="text-warning fw-bolder"> {{ returnHourMin(this.horaSelected.sesion) }}</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row customRow">
            <div class="col-md-5">
                <div id="butaques" v-show="butaquesCargando">
                    <span class="butacaRow" v-for="(b, i) in asientos" :key="i">
                        <span v-if="!checkIfReservado(b.id, i)">
                            <i class="fas fa-couch me-2 butacaIcon_d" @click="getButaca(b)" :id="'butaca-' + b.id" :title="'Butaca ' + b.sillon + ': Fila ' + b.row + ' - Asiento ' + b.col"></i>
                        </span>
                        <span v-else>
                            <i class="fas fa-couch me-2 butacaIcon_o"></i>
                        </span>
                    </span>
                </div>
                <div class="pantalla text-center">PANTALLA</div>
            </div>
            <div class="col-md-6">
                <div class="card butacasLista" >
                    <div class="card-header d-flex justify-content-between">
                        <span>Butacas seleccionadas</span>
                        <span v-if="maxButacs" class="text-danger fw-bold">Solo puedes elegir 16!</span>
                    </div>
                    <div v-if="butacasSelected.length == 0">
                        <pre>Todavía no has seleccionado ningun asiento</pre>
                    </div>
                    <div v-else style="overflow: scroll;">
                        <div v-for="(b, i) in butacasSelected" :key="i">
                            Butaca <span class="badge bg-info">{{ b.butaca }}</span>: Fila <b>{{ b.row }}</b> -
                            Columna <b>{{ b.col }}</b>
                        </div>
                    </div>
                </div>
                <div class="buttonsGroup">
                    <button class="btn btn-success comprar" @click="comprar()">Comprar entradas</button>
                    <p class="btn btn-dark contador">{{ butacasSelectedCnt }}</p>
                </div>
                <div v-if="showError" class="text-center mt-4 text-danger fw-bolder fs-4">
                    ¡Debes seleccionar almenos un asiento para realizar la compra!
                </div>

            </div>
        </div>
        <div class="leyenda text-center w-100 bg-dark text-light">
            <span><i class="fas fa-couch" style="color: lightgray;"></i> Disponible</span>
            <span><i class="fas fa-couch" style="color: green;"></i> Seleccionado</span>
            <span><i class="fas fa-couch" style="color: red;"></i> Ocupado</span>
            <span><i class="fas fa-couch" style="color: orange;"></i> No disponible</span>
        </div>

        <div class="cine-infoCine-right card p-4">
            <h3>{{ cineObj.nombre }} {{ cineObj.localidad }}</h3>
            <p> {{ cineObj.direccion }} </p>
            <h5> {{ cineObj.email }} </h5>
            <h4> {{ cineObj.telefono }} </h4>
            <div class="cine-infoCine-maps" v-if="setCoordsDone">
                <GmapMap :center="center" :zoom="16" map-type-id="terrain" style="width: 80%; height: 250px">
                    <GmapMarker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true"
                        :draggable="true" @click="center = m.position" />
                </GmapMap>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            horaSelected: '',
            despues: '',
            cineObj: {},
            peliObj: {},
            salasObj: {},
            butacasSelected: [],
            butacasSelectedCnt: 0,
            center: {},
            markers: [],
            setCoordsDone: false,
            day: '',
            showError: false,
            fechaFormatted: '',
            contProv: 0,
            butacasDone: false,
            maxButacs: false,
            butaquesCargando: false,
        }
    },

    props: ['cine', 'peli', 'salas', 'reservas', 'asientos'],

    async mounted() {
        this.cineObj = this.cine[0];
        this.peliObj = this.peli[0];
        this.horaSelected = this.$cookies.get('horaSeleccionada');
        this.despues = this.$cookies.get('diaDespues');
        this.salasObj = this.salas;
        this.center = {
            lat: parseFloat(this.cineObj.latitude),
            lng: parseFloat(this.cineObj.longitude)
        }
        this.markers.push({position: this.center});
        this.setCoordsDone = true;
        const dias = [
            'Domingo',
            'Lunes',
            'Martes',
            'Miércoles',
            'Jueves',
            'Viernes',
            'Sábado',
        ];
        let hoy = new Date();
        let hoyNombre = dias[hoy.getDay()] + " " + hoy.getUTCDate() + "/" + (hoy.getUTCMonth() + 1) + "/" + hoy.getUTCFullYear();
        let fechaHoy = hoy.getUTCDate() + "/" + (hoy.getUTCMonth() + 1) + "/" + hoy.getUTCFullYear();
        let mañana = new Date();
        mañana.setDate(hoy.getDate() + 1);
        let mañanaNombre = dias[mañana.getDay()] + " " + mañana.getUTCDate() + "/" + (mañana.getUTCMonth() + 1) + "/" + mañana.getUTCFullYear();
        let fechaMañana = mañana.getUTCDate() + "/" + (mañana.getUTCMonth() + 1) + "/" + mañana.getUTCFullYear();
        if (this.despues == "false") {
            this.day = mañanaNombre;
            this.fechaFormatted = fechaMañana;
        } else {
            this.day = hoyNombre;
            this.fechaFormatted = fechaHoy;
        }
        await window.setTimeout(()=>{
            this.butaquesCargando = true; 
            let butaques = document.getElementById('butaques');
            butaques.style = `grid-template-columns: repeat(${this.salasObj.rows}, 1fr);`;
        },500);
        
    },

    methods: {
        getButaca(b) { 
            let butaca = document.getElementById(`butaca-${b.id}`);
            if (butaca.classList.contains("selected")) {
                if (this.butacasSelected.length <= 16) {
                    this.maxButacs = false;
                }
                butaca.classList.remove("selected");
                for (let i = 0; i < this.butacasSelected.length; i++) {
                    if (this.butacasSelected[i].id == b.id) {
                        this.butacasSelected.splice(i, 1);
                    } else {
                    }
                }
                this.butacasSelectedCnt--;
            } else {
                if (this.butacasSelected.length >= 16) {
                    this.maxButacs = true;
                } else {
                    this.maxButacs = false;
                    butaca.classList.add("selected");
                    this.butacasSelected.push({
                        id: b.id,
                        butaca: b.sillon,
                        row: b.row,
                        col: b.col,
                        sala_id: b.sala_id,
                        precio: b.precio,
                    });
                    this.butacasSelectedCnt++;
                }
                
            }
        },

        acortarOverview(text) {
            try {
                let textToReturn = "";
                for (let i = 0; i < text.length; i++) {
                    if (textToReturn.length > 160) {
                        textToReturn += "...";
                        break;
                    } else {
                        textToReturn += text[i];
                    }
                }

                return textToReturn;
            } catch (e) {

            }
            
        },

        returnHourMin(time) {
            try {
                let parts = time.split(":");
                parts.splice(2)
                time = parts.join(":");
                return time;
            } catch (e) {

            }
            
        },

        comprar() {
            if (this.butacasSelectedCnt == 0 || this.butacasSelected.length == 0) {
                this.showError = true;
            } else {
                this.showError = false;
                this.$cookies.set("butacasSelected", JSON.stringify(this.butacasSelected), "20MIN", '/cart');
                this.$cookies.set("cineSelected", this.cineObj, "20MIN", '/cart');
                this.$cookies.set("movieSelected", this.peliObj, "20MIN", '/cart');
                this.$cookies.set("diaSelected", this.day, "20MIN", '/cart');
                this.$cookies.set("horaSelected", this.horaSelected, "20MIN", '/cart');
                this.$cookies.set("salaSelected", this.salasObj, "20MIN", '/cart');
                this.$cookies.set("numeroButacasSelected", this.butacasSelectedCnt, "20MIN", '/cart');
                this.$cookies.set("dayFormattedSelected", this.fechaFormatted, "20MIN", '/cart');
                window.location.href = "http://localhost:8000/cart";
            }
        },

        checkIfReservado(id, i) {
            for (let i = 0; i < this.reservas.length; i++) {
                if (this.reservas[i].id == id) {
                    return true;
                }
            }
            return false;
        },
    }
}
</script>

<style>
.butacaIcon_d {
    color: lightgray;
    transition: all .3s ease-in-out;
    cursor: pointer;
    font-size: 1.5em;
}

.butacaIcon_o {
    color: #ff4444;
    transition: all .3s ease-in-out;
    cursor: not-allowed;
    font-size: 1.5em;
}

.butacaIcon_o:hover {
    color: #c43535;
}

.butacaIcon_d:hover {
    color: gray;
}

.selected {
    color: green !important;
}

#butaques {
    text-align: center;
    padding-bottom: 10px;
    display:grid;
}

.pantalla {
    margin: auto;
    width: 100%;
    border: 2px solid #000;
}

.customRow {
    justify-content: space-between;
}

.butacasLista {
    height: 250px;
}

.comprar {
    width: 100%;
    padding: 15px;
}

.contador {
    position: absolute;
    top: 15%;
    right: 30%;
}

.buttonsGroup {
    position: relative;
    display: flex;
    justify-content: space-between;
}

.leyenda {
    margin-top: 5rem;
    display: flex;
    justify-content: space-between;
    padding: 15px;
}

.leyenda span {
    font-weight: bold;
    font-size: 1.2em;
    margin-left: 3rem;
    margin-right: 3rem;
}

.peli .card {
    height: 200px;
    margin-bottom: 5rem;
}

.peli .cine-mainInfo-img {
    height: 200px;
    width: 175px;
}

.peli .cine-mainInfo-img img {
    height: 100%;
    width: 100%;
}

.cine-infoCine-right {
    margin-top: 3rem;
}
</style>
