<template>
    <div class="t-resumen" id="component">
        <div class="container">
            <loader object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" disableScrolling="true"
                objectbg="#999793" opacity="80" name="circular" v-if="!getSessionIdDone"></loader>
            <div class="row">
                <div class="col-md-6 infoCineMovie">
                    <div class="row border-bottom p-4">
                        <div class="col-md-5 infoCineMovie-img-parent m-auto text-center ">
                            <img :src="movieSelected.poster" :alt="movieSelected.overview" :title="movieSelected.title" />
                        </div>
                        <div class="col-md-7 infoCineMovie-text-parent">
                            <h3>{{ movieSelected.title }}</h3>
                            <h4>{{ cineSelected.nombre }} {{ cineSelected.localidad }}</h4>

                            <div><i class="fas fa-location-dot"></i> <span>{{ cineSelected.direccion }}</span></div>
                        </div>
                    </div>
                    <div class="row border-bottom p-4">
                        <div class="col-md-5 billingInfo text-center border-end">
                            <h3>Precio total</h3>
                            <h1 class="ms-5">{{ precioTotal.toFixed(2) }}<small class="fs-3"> €</small></h1>
                        </div>
                        <div class="col-md-7 text-end">
                            <h6>Precio de entradas: {{ precioEntradas.toFixed(2) }}<small> €</small></h6>
                            <h6>Descuento de cupones: {{ descuento.toFixed(2) }}<small> €</small></h6>
                            <img class="imgPagos" :src="rutaPagosImg" title="Pagos disponibles" />
                        </div>
                    </div>
                    <div class="row text-center text-light fw-bolder">
                        <h3 class="mt-5 mb-3 text-dark text-start">Resumen</h3>
                        <div class="col-md-4 fechaCon p-2">
                            {{ dayFormattedSelected }}
                        </div>
                        <div class="col-md-4 horaCon p-2">
                            {{ horaSelected }}
                        </div>
                        <div class="col-md-4 salaCon p-2">
                            Sala {{ this.salanum+1 }}
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="row ">
                            <div class="col-md-8 border-bottom border-top text-start fw-bolder p-2">
                                Duración: 
                            </div>
                            <div class="col-md-4 border-bottom border-top text-center bg-warning text-white fw-bolder p-2">
                                {{ time }} min
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 infoPago border-start">
                    <div class="mb-5">
                        <div><div class="paso text-center bg-success text-light fw-bold">1</div> <h1 class="d-inline">Cupones</h1></div>
                        <p class="mt-2">Si tienes un cupón de descuento introducelo aquí</p>
                        <div class="input-group">
                            <input class="form-control" type="text" v-model="cuponModel" :disabled="cuponValid" aria-describedby="button-addon2" />
                            <button class="btn btn-primary fw-bold" type="button" id="button-addon2" @click="revisarCupon(cuponModel)">APLICAR</button>
                        </div>
                        <p v-if="cuponValid" class="text-success fs-4">Codigo de descuento '{{ cuponUtilizado.cupon }}' canjeado satisfactoriamente!</p>
                        <p v-if="showNotValid" class="text-danger fs-4">El código de cupón que has introducido no existe!</p>
                    </div>
                    <div class="mb-5">
                        <div><div class="paso text-center bg-success text-light fw-bold">2</div> <h1 class="d-inline">Tus asientos {{ numeroButacasSelected }} <i class="edit ms-4 fas fa-pencil fs-3 text-primary" @click="editAsientos()"></i></h1></div>
                        <div class="mt-3" v-for="(b, i) in butacasSelected" :key="i">
                            <div class="bg-dark text-white p-3 fw-bolder">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>Butaca <span class="badge bg-info">{{ b.butaca }}</span></div>
                                    </div>
                                    <div class="col">
                                        Fila {{ b.row }}
                                    </div>
                                    <div class="col">
                                        Asiento {{ b.col }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="condiciones" class="form-check-input" id="flexSwitchCheckDefault" v-model="checked" />
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                He leído y acepto la <a href="#">Política de Privacidad</a> y las <a href="#">Condiciones de Compra</a>
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" name="overAge" class="form-check-input" id="flexSwitchCheckDefault" v-model="overAge" />
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                Confirmo expresamente que tengo más de 16 años 
                            </label>
                        </div>
                        <div class="mt-2">
                            <stripe-checkout ref="checkoutRef" :pk="publishableKey" :sessionId="sessionId" />
                            <button class="btn btn-success w-100 p-3" :disabled="!checked || !overAge" @click="comprar()">COMPRAR ENTRADAS</button>
                        </div>
                        <p v-if="showError" class="text-danger fw-bold fs-4">Debes aceptar las condiciones!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { StripeCheckout } from '@vue-stripe/vue-stripe';

    export default {
        data() {
            return {
                butacasSelected: '',
                cineSelected: '',
                movieSelected: '',
                horaSelected: '',
                salaSelected: '',
                numeroButacasSelected: '',
                precioEntradas: 0,
                rutaPagosImg: '../../../images/pagos.png',
                descuento: 0.00,
                dayFormattedSelected: '',
                cuponModel: '',
                showNotValid: false,
                precioTotal: 0,
                cuponValid: false,
                time: '',
                checked: false,
                overAge: false,
                showError: false,
                cuponUtilizado: null,

                publishableKey: 'pk_test_51L5mKBB6sVNhsTH58ElXxRTR0ymS9bfps0tnZnkIgKzoUbYnQDHNQImuJENofQDmPdE6N7ThaiSgGkdXKIVROJOJ00wAyK4dwW',
                sessionId: null,
                getSessionIdDone: true,
            }
        },

        components: {
            StripeCheckout,
        },

        props: ['info', 'cupons', 'salanum', 'sala'],

        async mounted() {
            this.butacasSelected = JSON.parse(this.$cookies.get('butacasSelected'));
            this.cineSelected = this.$cookies.get('cineSelected');
            this.movieSelected = this.$cookies.get('movieSelected');
            await this.getTimeMovie(this.movieSelected.api_id)
            this.horaSelected = this.$cookies.get('horaSelected');
            this.horaSelected = this.getHoraFormatted(this.horaSelected.sesion);
            this.salaSelected = this.$cookies.get('salaSelected');
            this.numeroButacasSelected = this.$cookies.get('numeroButacasSelected');
            this.dayFormattedSelected = this.$cookies.get('dayFormattedSelected');
            let precio = 0;
            for ( let i = 0; i < this.info.length; i++) {
                precio = parseFloat(this.info[i][0].precio) + precio;
            }
            this.precioEntradas = precio;
            this.precioTotal = this.precioEntradas;
        }, 

        methods: {
            submit() {
                this.$refs.checkoutRef.redirectToCheckout();
            },

            revisarCupon(cupon) {
                let posiblePrecio = 0;
                for(let i = 0; i < this.cupons.length; i++) {
                    if (this.cupons[i].cupon == cupon) {
                        posiblePrecio = this.precioEntradas * (parseFloat(this.cupons[i].descuento)/100);
                        this.descuento = -posiblePrecio;
                        this.precioTotal = (this.precioEntradas + this.descuento);
                        this.showNotValid = false;
                        this.cuponValid = true;
                        this.cuponUtilizado = this.cupons[i];
                    } else {
                        this.showNotValid = true;
                    }
                }
            }, 

            async getTimeMovie(api_id) {
                try {
                    let response = await axios.get(`https://api.themoviedb.org/3/movie/${api_id}?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es`)
                    .then (response => response.data)
                    .catch (function () {
                    })

                    this.time = response.runtime;
                } catch (e) {

                }
                
            },

            editAsientos() {
                history.go(-1);
            },

            getHoraFormatted(hora) {
                try {
                    let parts = hora.split(":");
                    parts.splice(2)
                    hora = parts.join(":");
                    return hora;
                }catch(e) {

                }
            },

            async getSession() {
                await axios.get('/cart/getSession')
                .then(res => {
                this.sessionId = res.data.id;
                this.getSessionIdDone = true;
                }).catch(err => { })
            },

            async comprar() {
                if (this.checked && this.overAge) {
                    this.getSessionIdDone = false;
                    this.showError = false;
                    await this.setSessions('salaSelected', "Sala " + this.salanum);
                    await this.setSessions('salaSelectedObj', this.sala);
                    await this.setSessions('butacasSelected', this.butacasSelected);
                    await this.setSessions('horaSelected', this.horaSelected);
                    await this.setSessions('cineSelected', this.cineSelected);
                    await this.setSessions('movieSelected', this.movieSelected);
                    await this.setSessions('numeroButacasSelected', this.numeroButacasSelected);
                    await this.setSessions('dayFormattedSelected', this.dayFormattedSelected);
                    await this.setSessions('precioTotal', this.precioTotal);
                    await this.setSessions('cuponSelected', this.cuponUtilizado);
                    await this.getSession();
                    this.submit();
                } else {
                    this.showError = true;
                }

            }, 

            async setSessions(myKey, myValue) {
                await axios.post('http://localhost:8000/setSessions', {
                        key: myKey,
                        value: myValue,
                    }).then ((res) => {
                        if(typeof myValue == 'object') {
                            myValue = JSON.stringify(myValue);
                        }
                        window.sessionStorage.setItem(myKey, myValue);
                    }).catch((err) => {
                    })
            }
        }
    }
</script>

<style>

    .infoCineMovie-img-parent {
        height: 200px;
    }

    .infoCineMovie-img-parent img {
        height: 100%;
        box-shadow: 0px 0px 10px #000;
    }

    .infoCineMovie-text-parent h3{
        font-weight: bolder;
        font-size: 2rem;
    }

    .infoCineMovie-text-parent div {
        margin-top: 5rem;
    }

    .imgPagos {
        width: 60%;
    }

    .paso {
        width: 50px;
        border-radius: 50%;
        display: inline-block;
        font-size: 2rem;
    }

    .edit {
        cursor: pointer;
        transition: all .25s ease-in-out;
    }

    .edit:hover {
        text-shadow: 0px 0px 10px #0b5dd7c7;
    }

    .fechaCon {
        background-color: rgb(197, 197, 197);
    }

    .horaCon {
        background-color: rgb(179, 0, 0);
    }

    .salaCon {
        background-color: rgb(0, 169, 0);
    }

</style>
