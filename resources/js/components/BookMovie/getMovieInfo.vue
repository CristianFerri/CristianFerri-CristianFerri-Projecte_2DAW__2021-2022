<template>
  <div>
    <div class="infoMovie-banner" v-bind:style="{ 'background-image': 'url(' + movieObj.backdrop + ')' }">
      <div class="infoMovie-banner-lessGLow"></div>
      <div class="infoMovie-information">
        <div class="infoMovie-information-center">
          <img class="infoMovie-information-img" v-bind:src="movieObj.poster" v-bind:alt="movieObj.title"> 
          <h3 class="infoMovie-information-title">{{ movieObj.title }}</h3>
          <p class="infoMovie-information-overview">{{ movieObj.overview }}</p>
          <i class="infoMovie-information-release">{{ movieObj.releases }}</i>
          <b class="infoMovie-information-revenue">Recaudación: ${{ splitMoney(movieAdditionalInfo.revenue) }}</b>
          <p class="infoMovie-information-runtime text-danger">{{ movieAdditionalInfo.runtime }}min</p>
          <div class="infoMovie-information-votes text-warning fs-2">
            <font-awesome-icon icon="fa-solid fa-star"/>
            <b>{{ movieObj.votes }}</b>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <h1>Sesiones</h1>
      <p>Toca en una sesión para comprar</p>
      <div v-if="noSesions">
        No hay ninguna sesión todavia para esta pelicula, vuelve más tarde
      </div> 
      <div v-else class="sesiones">
        <div v-for="(s, i) in sesions" :key="i">
          {{ compareTime(s.sesion) }}
          <div class="sesionContainer" :class="{ 'bg-danger': !goodSesion, 'bg-success': goodSesion }">
            <div class="iconC">
              <i class="fas fa-plus"></i>
            </div>
            <div class="sesion" @click="goSesion(goodSesion, s)">
              {{ sesionTime }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import axios from 'axios';

  export default {
    data() {
      return {
        movieAdditionalInfo: {},
        movieObj: {},
        cineObj: {},
        sesions: [],
        noSesions: false, 
        currentTime: '',
        sesionTime: '',
        goodSesion: '',
      }
    },

    props: ['movie', 'cine'],

    async mounted() {
      this.movieObj = this.movie[0];
      this.cineObj = this.cine[0];
      await this.getMovieAdditionalInfo(this.movieObj.api_id);
      await this.getSesions(this.movieObj.id);
      this.currentTime = new Date().toLocaleString([], {
        hourCycle: 'h23',
        hour: '2-digit',
        minute: '2-digit',
      });
    },

    methods: {
      async getMovieAdditionalInfo(api_id) {
        try {
          let response = await axios.get(`https://api.themoviedb.org/3/movie/${api_id}?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es`)
          .then(response => response.data)
          .catch(function () {
          });

          this.movieAdditionalInfo = {
            revenue: response.revenue,
            runtime: response.runtime,
          }
        } catch (e) {
        }
      },

      async getSesions(idPeli) {
        try {
          let response = await axios.get(`http://localhost:8000/sesiones/get/${idPeli}`)
            .then (response => response.data)
            .catch(function () {
            })


            if (response.success === "false") {
              this.noSesions = true;
            } else {
              for (let i = 0; i < response.length; i++) {
                this.sesions.push(
                  {
                    id: response[i].id,
                    pelicula: response[i].pelicula_id,
                    sesion: response[i].hora_sesion
                  }
                )
              }
            }

            
        } catch (e) {

        }
      },

      splitMoney(dines) {
        try {
          let parts = dines.toString().split(".");
          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
          return parts.join(",");
        } catch (e) {

        }
      },

      compareTime(time) {
        let parts = time.split(":");
        parts.splice(2)
        this.sesionTime = parts.join(":");
        if (this.currentTime < this.sesionTime) {
          this.goodSesion = true;
        } else {
          this.goodSesion = false;
        }
      },

      goSesion(cuando, hora) {
        this.$cookies.set("horaSeleccionada", hora);
        this.$cookies.set("diaDespues", cuando);
        window.location.href = `http://localhost:8000/cinemas/${this.cineObj.id}/movie/${this.movieObj.api_id}/transaccion`;
      }
    }
  }
</script>

<style>

  @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Boogaloo&display=swap');

  body {
    overflow-x: hidden;
  }

  .infoMovie-banner {
    position: relative;
    height: 40vh;
    width: 100vw;
    background-position: center;
    background-size: cover;
  }

  .infoMovie-banner-lessGLow {
    height: 40vh;
    top: 0;
    position: absolute;
    width: 100%;
    background: rgba(0,0,0,0.7);
  }

  .infoMovie-information {
    position: relative;
    z-index: 10;
    height: 100%;
    width: 75%;
    font-family: 'Quicksand', serif;
    color: #fff;
    margin: auto;
  }

  .infoMovie-information-center {
    display: flex;
    position: relative;
    height: 90%;
    width: 100%;
    top: 50%;
    left: 50%;
    transform:translate(-50%, -50%);
  }

  .infoMovie-information-img {
    position: relative;
    height: 100%;
    border: 1px solid #ffffff;
    box-shadow: 0px 0px 15px #fff
  }

  .infoMovie-information-title {
    position: absolute;
    font-weight: bold;
    left: 275px;
    font-size: 3em;
    width: 100%;
    font-family: 'Boogaloo', cursive;
  }

  .infoMovie-information-overview {
    position: absolute;
    left: 275px;
    top: 14%;
    font-size: 1.3em;
    max-width: 60%;
  }

  .infoMovie-information-release {
    position: absolute;
    left: 275px;
    top: 80%;
    font-weight: bolder;
  }

  .infoMovie-information-revenue {
    position: absolute;
    left: 275px;
    top: 90%;
  }

  .infoMovie-information-runtime {
    position: absolute;
    left: 275px;
    top: 70%;
    font-weight: bold;
  }

  .infoMovie-information-votes {
    position: absolute;
    left: 80%;
  }

  .infoMovie-information-votes > b{
    font-size: 0.7em;
  }

  .sesion {
    position: relative;
    font-size: 2em;
    margin-top: 15px;
    cursor: pointer;
    transition: all .3s ease-in-out;
    background-color: #fff;
    width: 80%;
    top: 40%;
    left: 10%;
    text-align: center;
  }

  .sesionContainer {
    position: relative;
    width: 200px;
    height: 100px;
  }

  .sesiones {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
  }

  .iconC {
    position: absolute;
    left: 48%;
    top: 5%;
  }

  .iconC i {
    color: #fff;
  }
</style>
